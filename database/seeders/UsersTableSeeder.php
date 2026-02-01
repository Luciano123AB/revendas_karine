<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                "password" => Hash::make("admin123456"),
                "telefone" => "55999999999",
                "email_verified_at" => Carbon::now(),
                "created_at" => Carbon::now()
            ],

            [
                "name" => "Luciano123AB",
                "email" => "luciano@gmail.com",
                "password" => Hash::make("luciano123456"),
                "telefone" => "55999999998",
                "email_verified_at" => Carbon::now(),
                "created_at" => Carbon::now()
            ]
        ]);
    }
}