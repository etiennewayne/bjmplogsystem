<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Companion;
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

        $data = Appointment::create([
            'appointment_date' => $ndate,
            'meridian' => $req->meridian,
            'inmate' => strtoupper($req->inmate),
            'purpose' => strtoupper($req->purpose),
            'inmate_relationship' => $req->inmate_relationship,
            'user_id' => $id
        ]);

        $id = $data->appointment_id;

        $countCompanions = count($req->companions);

        if($countCompanions > 0){
            //if naa sulod
            foreach($req->companions as $item){
                Companion::create([
                    'appointment_id' => $id,
                    'fullname' => $item['fullname'],
                    'inmate_relationship' => $item['inmate_relationship']
                ]);
            }
        }

        return response()->json([
            'status' => 'saved'
        ], 200);
    }
}
