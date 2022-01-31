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
                'role' => 'ADMINISTRATOR',
                'is_approved' => 1
            ],
            [
                'username' => 'user01',
                'email' => 'user01@yahoo.com',
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
                'is_approved' => 0
            ]
        ];

        User::insert($user);
    }
}
