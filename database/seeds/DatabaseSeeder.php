<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        
        $tags = factory('App\Tag', 8)->create();

        factory('App\Post', 30)->create()->each(function($post) use ($tags){
            $post->comments()->save(factory('App\Comment')->make());
            $post->categories()->attach(mt_rand(1,5));
            $post->tags()->attach($tags->random(mt_rand(1,4))->pluck('id')->toArray());
        });
    }
}
