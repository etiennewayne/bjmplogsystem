<?php

namespace Database\Seeders;

use App\Models\MaxCompanion;
use Illuminate\Database\Seeder;

class MaxCompanionSeeder extends Seeder
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
                'max_companion'=>4
            ]
        ];

        MaxCompanion::insertOrIgnore($data);
    }
}
