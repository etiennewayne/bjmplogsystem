<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InmateRelationshipSeeder extends Seeder
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
                'inmate_relationship'=>'FAMILY'
            ],
            [
                'inmate_relationship'=>'FRIEND'
            ],
            [
                'inmate_relationship'=>'DOCTOR'
            ],
            [
                'inmate_relationship'=>'PRIEST'
            ],
            [
                'inmate_relationship'=>'COUNCIL'
            ]
        ];
    }
}
