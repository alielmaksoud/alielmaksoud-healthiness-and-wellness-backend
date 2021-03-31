<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['id' =>1, 'status' => 'Normal' ],
            ['id' =>2, 'status' => 'Premimum' ]

        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}