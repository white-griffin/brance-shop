<?php

namespace Database\Seeders;

use App\Constants\Constant;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'id' => 1,
            'first_name' => 'محمدامین',
            'last_name' => 'زنگوئی',
            'mobile' =>'09391937554',
            'email' =>'mohamadamin.zanguee@gmail.com',
            'username' =>'admin',
            'password' => Hash::make('password'),
            'status' => Constant::ACTIVE,
        ]);
    }
}
