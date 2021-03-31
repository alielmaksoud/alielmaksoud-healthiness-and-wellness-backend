<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('admins')->get()->count()==0) {
            DB::table('admins')->insert([
                'created_at'=>now(),
                'updated_at'=>now(),
                'first_name'=>'Ali',
                'last_name'=>'Maksoud',
                'email'=>'ali.elmaksoud@gmail.com',
                'phone'=>'70627060',
                'password'=>bcrypt('admin123123'),
            ]);
        }
    }
}

