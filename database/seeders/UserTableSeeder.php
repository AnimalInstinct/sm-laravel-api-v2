<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'Administrator';
        $admin->email = 'admin@yourdomain.com';
        $admin->password = Hash::make('administrator');
        $admin->activation_token = '';
        $admin->save();
        $admin->assignRole('Administrator', 'Author');
    }
}
