<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { //
        DB::table('posts')->insert(
        	array(
        		[
        			'title' => "Php is awesome",
                    'slug' => "php_is_awesome",
        			'intro' => "Какое-то интро",
        			'body' => "Какое-то тело.",
        		],
        		[
        			'title' => "Laravel 5.8",
                    'slug' => "laravel_5.8",
        			'intro' => "Какое-то интро",
        			'body' => "Какое-то тело.",
        		],
        		[
        			'title' => "Thanks to seeds",
                    'slug' => "seeds",
        			'intro' => "Какое-то интро",
        			'body' => "Какое-то тело.",
        		]
        	)
        );
    }
}
