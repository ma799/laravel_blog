<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $user2 = User::where('email','mahessh357@gmail.com')->first();
        if (!$user2) {
           User::create([
            'name'=>'Mahmoud El Sayed Ahmed',
            'email'=>'mahessh357@gmail.com',
            'role'=>'admin',
            'password'=>Hash::make('mahessh357'),
           ]);
        }


        $user = User::where('email','admin1@gmail.com')->first();
        if (!$user) {
           User::create([
            'name'=>'admin',
            'email'=>'admin1@gmail.com',
            'role'=>'admin',
            'password'=>Hash::make('admin1@gmail.com'),
           ]);
        }

    }
}
