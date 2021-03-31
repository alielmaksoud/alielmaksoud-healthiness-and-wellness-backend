<?php

use Illuminate\Database\Seeder;
use App\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = [
            ['id' =>1, 'activity' => 'Normal' ],
            ['id' =>2, 'activity' => 'Moderate' ],
            ['id' =>3, 'activity' => 'active' ],

        ];

        foreach ($activities as $activity) {
            Activity::create($activity);
        }
    }
}
