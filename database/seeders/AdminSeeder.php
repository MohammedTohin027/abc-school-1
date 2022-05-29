<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin =  [
            'name' => 'Admin Vai',
            'role_id' => 1,
            'isban' =>0,
            'image' => 'uploads/profile/avater.jpg',
            'email' => 'adminvai@gmail.com',
            'password' => Hash::make(00000000),
        ];
        User::insert($admin);
    }
}