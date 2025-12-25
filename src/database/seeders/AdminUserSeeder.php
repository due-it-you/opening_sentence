<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminUser::factory()->count(1)->create();

        DB::table('admin_users')->insert([
            'name' => '管理',
            'email' => 'example@example.com',
            'password' => Hash::make('password')
        ]);
    }
}
