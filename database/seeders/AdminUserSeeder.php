<?php

namespace Database\Seeders;

use App\Enums\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'mobile' => '01500000002',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role_as' => Status::Admin->value,
                'status' => Status::Active->value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Office Staff',
                'mobile' => '01500000003',
                'email' => 'accountant@gmail.com',
                'password' => Hash::make('password'),
                'role_as' => Status::OfficeStaff->value,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'marketing officer',
                'mobile' => '01500000004',
                'email' => 'marketingofficer@gmail.com',
                'password' => Hash::make('password'),
                'role_as' => Status::MarketingStaff->value,
                'status' => Status::Active->value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'User',
                'mobile' => '01500000005',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role_as' => Status::User->value,
                'status' => Status::Active->value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

    }
}
