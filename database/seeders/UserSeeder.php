<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $superAdmin = User::create([
            'name'     => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
