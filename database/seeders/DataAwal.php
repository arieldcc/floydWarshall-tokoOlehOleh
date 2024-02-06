<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataAwal extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "Administrator";
        $user->username = 'admin';
        $user->role = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('admin123');
        $user->save();
    }
}
