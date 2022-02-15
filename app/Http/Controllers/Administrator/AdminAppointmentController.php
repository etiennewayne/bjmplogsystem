<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
        return view('administrator.admin-appointments');
    }

    public function getAllAppointments(Request $req){

        $sort = explode('.', $req->sort_by);
        $date =  $req->appointment_date;
        $ndate = date("Y-m-d", strtotime($date));


        return Appointment::where('appointment_date', 'like', $ndate . '%')
            ->join('users', 'appointments.user_id', 'users.user_id')
            ->where('users.lname', 'like', $req->appointer . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function cancelAppointment($id){
        $data = Appointment::find($id);
        $data->is_approved = 0;
        $data->is_cancel = 1;
        $data->save();

        return response()->json([
            'status' => 'canceled'
        ]);
    }

    public function approveAppointment($id){
        $data = Appointment::find($id);
        $data->is_approved = 1;
        $data->is_cancel = 0;
        $data->save();

        return response()->json([
            'status' => 'approved'
        ]);
    }

}
