<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = 'Gomin';
        $user->email = 'admin@gmail.com';
        $user->address = '1548/1417 Elio del moss พหลโยธิน34 แขวงเสนานิคม';
        $user->phone_number = '0958654531';
        $user->role = 'admin';
        $user->password = Hash::make(1234);
        $user->save();


        $user = new \App\User();
        $user->name = 'Gomin';
        $user->email = 'user1@gmail.com';
        $user->address = '1548/1417 Elio del moss พหลโยธิน34 แขวงเสนานิคม';
        $user->phone_number = '0958654531';
        $user->role = 'user';
        $user->password = Hash::make(1234);
        $user->save();



    }

}
