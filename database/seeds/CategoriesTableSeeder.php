<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorySport = new Category();
        $categorySport->name = 'News';
        $categorySport->created_at = now();
        $categorySport->save();

        $categorySport = new Category();
        $categorySport->name = 'Sport';
        $categorySport->created_at = now();
        $categorySport->save();

        $categorySport = new Category();
        $categorySport->name = 'Weather';
        $categorySport->created_at = now();
        $categorySport->save();

        $categorySport = new Category();
        $categorySport->name = 'Tech';
        $categorySport->created_at = now();
        $categorySport->save();

        $categorySport = new Category();
        $categorySport->name = 'Fun';
        $categorySport->created_at = now();
        $categorySport->save();
    }
}
