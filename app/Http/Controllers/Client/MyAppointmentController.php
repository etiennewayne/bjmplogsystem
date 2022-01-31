<?php

namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Auth;

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
        
        $sort = explode('.', $req->sort_by);
        $date =  $req->appointment_date;
        $ndate = date("Y-m-d", strtotime($date));
        
        $userid = Auth::user()->user_id;

        return Appointment::where('appointment_date', 'like', $ndate . '%')
            ->where('user_id', $userid)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
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
