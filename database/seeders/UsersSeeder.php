<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\DB;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $timestamps = true;

    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin_tes1',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
            'role' => '3',
            'created_at'=> date("Y-m-d H:i:s")
        ]);
    }
}