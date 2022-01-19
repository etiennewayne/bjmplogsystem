<?php

namespace Database\Seeders;

use App\Models\Limiter;
use Illuminate\Database\Seeder;

class LimiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'am_limit'=> 50,
                'pm_limit' => 50,
            ],

        ];

        Limiter::insertOrIgnore($data);
    }
}
