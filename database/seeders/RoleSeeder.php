<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'Super Admin',
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1,
            ],
            [
                'name' => 'Admin',
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1,
            ],
        ]);
    }
}
