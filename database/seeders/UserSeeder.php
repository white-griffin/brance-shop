<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'محمدامین',
            'last_name' => 'زنگوئی',
            'email' => 'mohamadamin@gmail.com',
            'mobile' => '09391937554',
            'birth_date' => Date::now(),
            'national_code' => '0924231602',
            'address' => 'خیابان بهار',

        ]);
    }
}
