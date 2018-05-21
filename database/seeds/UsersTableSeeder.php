<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Durand',
            'email' => 'durand@chezlui.fr',
            'role' => 'admin',
            'password' => bcrypt('admin'),
            'settings' => 8,
        ]);
        
        User::create([
            'name' => 'Dupont',
            'email' => 'dupont@chezlui.fr',
            'password' => bcrypt('user'),
            'settings' => 8,
        ]);
        
        User::create([
            'name' => 'Kolio',
            'email' => 'ekayupe@yahoo.fr',
            'role' => 'admin',
            'password' => bcrypt('kayupekiwila'),
            'settings' => 8,
        ]);
    }
}
