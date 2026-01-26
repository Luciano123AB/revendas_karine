<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => bcrypt("admin123456"),
                "phone" => "55999999999",
                "email_verified_at" => now(),
                "created_at" => now()
            ]
        ]);
    }
}
