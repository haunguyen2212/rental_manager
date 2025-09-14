<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'role_id' => 1,
                'email' => 'superadmin@gmail.com',
                'status' => 1,
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1,
            ],
            [
                'name' => 'Admin',
                'role_id' => 2,
                'email' => 'admin@gmail.com',
                'status' => 1,
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1,
            ],
        ]);
    }
}
