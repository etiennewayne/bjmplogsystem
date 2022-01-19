<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $req){

        $date =  $req->appointment_date;
        $ndate = date("Y-m-d", strtotime($date));

        $id = Auth::user()->user_id;

        $validate = $req->validate([
            'appointment_date' => ['required'],
            'meridian' => ['required'],
            'inmate' => ['required'],
            'inmate_relationship' => ['required']
        ]);

        Appointment::create([
            'appointment_date' => $ndate,
            'meridian' => $req->meridian,
            'inmate' => $req->inmate,
            'inmate_relationship' => $req->inmate_relationship,
            'user_id' => $id
        ]);

        return response()->json([
            'status' => 'saved'
        ]);

    }
}
