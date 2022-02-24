<?php

namespace App\Http\Controllers\BJMP;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class BJMPController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('bjmp');
    }


    public function index(){
        $ndate = date('Y-m-d');

        $count = Appointment::where('appointment_date', $ndate)
            ->where('status', 1)
            ->where('is_scanned', 1)
            ->count();

        return view('bjmp.bjmp-dashboard')
            ->with('count', $count);
    }



}
