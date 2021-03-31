<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->get()->count()==0) {
            DB::table('users')->insert([
            'created_at'=>now(),
            'updated_at'=>now(),
            'image'=>'logo.png',
            'first_name'=>'Ali',
            'last_name'=>'Maksoud',
            'birth'=>'1989/11/25',
            'weight'=>'95',
            'height'=>'175',
            'blood'=>'A+',
            /* 'gender_id'=>'1',
            'activity_id'=>'2',
            'status_id'=>'2', */
            'email'=>'ali.elmaksoud@gmail.com',
            'phone'=>'70627060',
            'password'=>bcrypt('admin123123'),
            ]);
            }
    }
}
