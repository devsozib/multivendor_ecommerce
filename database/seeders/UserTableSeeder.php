<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        DB::table('users')->insert([
            //Admin

            [
                    'full_name'=>'Farabi Sajib',
                    'username'=>'admin',
                    'email'=>'admin@gmail.com',
                    'password'=>Hash::make('111'),
                    'role'=>'admin',
                    'status'=>'active'
            ],

            //Vendor
            [
                    'full_name'=>'Farabi Sajib',
                    'username'=>'vendor',
                    'email'=>'vendor@gmail.com',
                    'password'=>Hash::make('111'),
                    'role'=>'vendor',
                    'status'=>'active'
            ],
            
            //Customer
            [
                    'full_name'=>'Farabi Sajib',
                    'username'=>'customer',
                    'email'=>'customer@gmail.com',
                    'password'=>Hash::make('111'),
                    'role'=>'customer',
                    'status'=>'active'
            ],
            ]);
    }
}
