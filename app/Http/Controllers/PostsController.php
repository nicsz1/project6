<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use App\Post;

use App\Image;
use Intervention\Image\Facades\Image as ImageInt;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Session;

// Пакет UploadImage
use Dan\UploadImage\Exceptions\UploadImageException;

use App\Http\Controllers\Controller;

//use App\File;

use App\Http\Controllers\File;

use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;


class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {

        $this->validate(request(), [
            'title' => 'required|min:2',
            'intro' => 'required|max:35',
            'body' => 'required',
        ]);

        $post = new Post;
        $post->title = request('title');
        $post->slug = request('slug');
        $post->intro = request('intro');

        if ($request->hasFile('files')) {
            $images = array();
            $images[] = $request->file('files');
            foreach ($images as $image) {
                $imageName = time() . '.' . $image->extension();
                $img = ImageInt::make($image);
                $destinationPath = public_path() . '/uploads/';
                $img->resize(100, 100)->save($destinationPath . $imageName);

                $post->img = $imageName;
            }
        }

        $post->body = request('body');

        $post->save();

        return redirect('/');
    }

    public function image(Request $request)
    {
        $imageName = $request->file->getClientOriginalName();
        $request->file->move(public_path('uploads'), $imageName);
        return response()->json(['uploaded' => '/uploads/' . $imageName]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|min:2|max:25',
            'intro' => 'required|max:200',
            'body' => 'required|max:5000',
        ]);

        $post->title = request('title');
        $post->slug = request('slug');
        $post->intro = request('intro');

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $image) {
                $imageName = uniqid(time()). '.' . $image->getClientOriginalExtension();
                $img = ImageInt::make($image);
                $destinationPath = public_path(). '/uploads/';
                $img->resize(100, 100)->save($destinationPath . $imageName);

                $post->img = $imageName;
            }
        }
        $post->body = request('body');

        $post->update();

        return redirect('/');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/');
    }

    public function export()
    {
        $headers = [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0'
            , 'Content-type' => 'text/csv'
            , 'Content-Disposition' => 'attachment; filename=db.csv'
            , 'Expires' => '0'
            , 'Pragma' => 'public'
        ];

        $post = Post::all()->toArray();

        # add headers for each column in the CSV download
        array_unshift($post, array_keys($post[0]));

        $callback = function () use ($post) {
            $FH = fopen('php://output', 'w');
            foreach ($post as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers);

    }

    public function import(Request $request)
    {
        $fileD = fopen('//home/vladyslav/Загрузки/db.csv', "r");
        $column = fgetcsv($fileD);
        while (!feof($fileD)) {
            $rowData[] = fgetcsv($fileD);
        }
        foreach ($rowData as $key => $value) {

            $inserted_data = array(
                'id' => $value[0],
                'title' => $value[1],
                'intro' => $value[2],
                'body' => $value[3],
                'slug' => $value[4],
                'img' => $value[5],
            );

            Post::create($inserted_data);
        }
        return redirect('/');
    }
}