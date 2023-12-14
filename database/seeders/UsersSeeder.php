<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //insert data
        $factObj = new User();
        $factObj->insert([
            [
                'name' => "ADMIN",
                'email' => "admin@gmail.com",
                'password' => Hash::make("123456"),
                'user_role'=> 1,
            ]
        ]);
    }
}
