<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    //


    public function getProvinces(){
        $data = DB::table('provinces')
            ->orderBy('provDesc', 'asc')
            ->get();

        return $data;
    }
}
