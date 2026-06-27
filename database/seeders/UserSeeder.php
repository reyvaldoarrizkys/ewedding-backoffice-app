<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@ewedding.test',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('Admin');

        $staff = User::create([
            'name' => 'Staff Wedding Organizer',
            'email' => 'staff@ewedding.test',
            'password' => Hash::make('password'),
        ]);
        $staff->assignRole('Staff WO');
    }
}
