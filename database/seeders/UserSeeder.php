<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

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
                'username' => 'admin',
                'email' => 'admin@yahoo.com',
                'password' => Hash::make('a'),
                'qr_ref' => 'QRSAMPLE01',
                'lname' => 'HIBAYA',
                'fname' => 'NIMCHIE',
                'mname' => 'LUTAW',
                'suffix' => '',
                'sex' => 'FEMALE',
                'contact_no' => '09207872400',
                'province' => '1042',
                'city' => '104215',
                'barangay' => '104215025',
                'street' => 'P-BOUGAINVILLA',
                'role' => 'ADMINISTRATOR',
                'img_path' => '',
                'is_approve' => 1
            ],
            [
                'username' => 'kimchie',
                'email' => 'kimchie@yahoo.com',
                'password' => Hash::make('a'),
                'qr_ref' => 'QRUSER02',
                'lname' => 'HIBAYA',
                'fname' => 'NIMCHIE',
                'mname' => '',
                'suffix' => '',
                'sex' => 'FEMALE',
                'contact_no' => '9167789585',
                'province' => '1042',
                'city' => '104215',
                'barangay' => '104215025',
                'street' => 'P-BOUGAINVILLA',
                'role' => 'USER',
                'img_path' => 'WDDeiTE1YAebJzjWcNItNamEp9vH1GzruB1qvr2F.jpg',
                'is_approve' => 0
            ],

            [
                'username' => 'noe',
                'email' => 'noe@yahoo.com',
                'password' => Hash::make('a'),
                'qr_ref' => 'QRUSER03',
                'lname' => 'TENORIO',
                'fname' => 'NOE',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'contact_no' => '09058616744',
                'province' => '1042',
                'city' => '104215',
                'barangay' => '104215025',
                'street' => 'P-VANDA',
                'role' => 'USER',
                'img_path' => '3t0sdeLTQDOkmOPhZKWqai5HXqcXflA9XqIhaQi3.jpg',
                'is_approve' => 0
            ],

            [
                'username' => 'nimchie',
                'email' => 'nimchie@yahoo.com',
                'password' => Hash::make('a'),
                'qr_ref' => 'QRUSER04',
                'lname' => 'HIBAYA',
                'fname' => 'NIMCHIE',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'contact_no' => '09058616745',
                'province' => '1042',
                'city' => '104215',
                'barangay' => '104215025',
                'street' => 'P-2',
                'role' => 'USER',
                'img_path' => 'fz04cuM1JpNdgr8onkX4xJymgY49gFxDB8pndRRq.jpg',
                'is_approve' => 0
            ],

            [
                'username' => 'bjmp',
                'email' => 'bjmp@yahoo.com',
                'password' => Hash::make('a'),
                'qr_ref' => 'BJMP1234',
                'lname' => 'BJMP',
                'fname' => 'BJMP',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'contact_no' => '9267846913',
                'province' => '1042',
                'city' => '104215',
                'barangay' => '104215025',
                'street' => 'P-BOUGAINVILLA',
                'role' => 'BJMP',
                'img_path' => '',
                'is_approve' => 0
            ],
        ];

        User::insert($user);
    }
}
