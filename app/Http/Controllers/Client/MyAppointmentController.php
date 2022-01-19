<?php

namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class MyAppointmentController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('client.my-appointment');
    }

    public function getAppointments(Request $req){
        $ndate = $req->appointment_date;

        return Appointment::orderBy('appointment_id', 'desc')->get();
    }


    public function show($id){
        return Appointment::find($id);
    }

    public function store(Request $req){

    }

    public function cancelAppointment($id){
        $data = Appointment::find($id);
        $data->is_cancel = 1;
        $data->save();

        return response()->json([
            'status' => 'canceled'
        ]);
    }
}
