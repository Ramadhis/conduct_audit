<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin_tes1',
            'email' => 'admin@mail.com',
            'name_slug' => 'admin',
            'password' => Hash::make('12345678'),
            'role' => '3',
            'profile_picture' => 'default.png',
            'created_at'=> date("Y-m-d H:i:s")
        ]);
    }
}