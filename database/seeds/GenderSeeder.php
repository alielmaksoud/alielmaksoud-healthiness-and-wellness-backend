<?php

use Illuminate\Database\Seeder;
use App\Genders;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            ['id' =>1, 'gender' => 'Male' ],
            ['id' =>2, 'gender' => 'Female' ]

        ];

        foreach ($genders as $gender) {
            Genders::create($gender);
        }
    }
}
