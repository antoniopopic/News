<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = new Role();
        $roleAdmin->username = 'admin';
        $roleAdmin->description = 'This is an Admin user';
        $roleAdmin->save();

        $roleUser = new Role();
        $roleUser->username = 'user';
        $roleUser->description = 'This is a standard User';
        $roleUser->save();

        $roleEditor = new Role();
        $roleEditor->username = 'editor';
        $roleEditor->description = 'This is an Editor user';
        $roleEditor->save();
    }
}
