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
            //Customer
            [
                    'full_name'=>'Farabi Sajib',
                    'username'=>'customer',
                    'email'=>'customer@gmail.com',
                    'password'=>Hash::make('1111'),
                    'status'=>'active'
            ],
            ]);
             //Admin
            DB::table('admins')->insert([  
                //Customer
                [
                        'full_name'=>'Admin',
                        'email'=>'admin@gmail.com',
                        'password'=>Hash::make('1111'),
                        'status'=>'active'
                ],
                ]);
            //Seller

            DB::table('sellers')->insert([  
                //Customer
                [
                        'full_name'=>'Seller',
                        'email'=>'sellers@gmail.com',
                        'password'=>Hash::make('1111'),
                        'status'=>'active'
                ],
                ]);
    }
}
