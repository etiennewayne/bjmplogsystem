<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
                'email' => 'et@yahoo.com',
                'password' => Hash::make('1234'),
                'qr_ref' => 'QRSAMPLE01',
                'lname' => 'AMPARADO',
                'fname' => 'ETIENNE',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'contact_no' => '9167789585',
                'province' => '1042',
                'city' => '104215',
                'barangay' => '104215025',
                'street' => 'P-BOUGAINVILLA',
                'role' => 'ADMINISTRATOR'
            ]
        ];
    }
}
