<?php

use App\User;
use App\Role;
//use DB;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
        ]);

        $user->roles()->attach(Role::where('name', 'admin')->first());
    }
}
