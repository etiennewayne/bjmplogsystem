<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Request $req){

        return $req;

        $validate = $req->validate([
            'appointment_date' => ['required'],
            'meridian' => ['required'],
            'inmate' => ['inmate'],
        ]);

        Appointment::create([
            'appointment_date' => $req->appointment_date,
            'meridian' => $req->meridian,
            'inmate' => $req->inmate
        ]);


    }
}
