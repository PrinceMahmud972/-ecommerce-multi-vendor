<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin@gmail.com'),
            'first_name' => 'Prince',
            'last_name' => 'Mahmud',
            'mobile' => '748929',
            'profile_image' => 'profile.jpg',
            'status' => 1,
        ]);
    }
}
