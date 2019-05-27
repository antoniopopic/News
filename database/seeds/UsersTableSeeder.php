<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::where('username', 'admin')->first();
        $roleUser = Role::where('username', 'user')->first();
        $roleEditor = Role::where('username', 'editor')->first();
        
        $admin = new User();
        $admin->username = 'Admin Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = 'admin';
        $admin->save();
        $admin->roles()->attach($roleAdmin);
        
        $user = new User();
        $user->username = 'User User';
        $user->email = 'user@user.com';
        $user->password = 'user';
        $user->save();
        $user->roles()->attach($roleUser);
        
        $editor = new User();
        $editor->username = 'Editor Editor';
        $editor->email = 'editor@editor.com';
        $editor->password = 'editor';
        $editor->save();
        $editor->roles()->attach($roleEditor);
    }
}
