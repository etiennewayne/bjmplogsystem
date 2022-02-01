<?php

namespace App\Http\Controllers\BJMP;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QRScannerController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('bjmp');
    }


    public function index(){
        return view('bjmp.qr-scanner');
    }


    public function validateQR($qr){



        $ndate = date('Y-m-d');
        $meridian = date('A');

//        $data = DB::table('appointments as a')
//            ->join('users as b', 'a.user_id', 'b.user_id')
//            ->where('b.qr_ref', $qr)
//            ->where('a.appointment_date', $ndate)
//            ->where('a.meridian', $meridian)
//            ->where('a.is_cancel', 0)
//            ->where('a.is_scanned', 0)
//            ->select('a.*', 'b.qr_ref', 'b.lname', 'b.fname', 'b.mname', 'b.sex', 'b.img_path', 'a.is_scanned')
//            ->first();

        $data = Appointment::with(['user', 'companions'])
            ->whereHas('user', function ($query) use ($qr){ //(Builder $query)
                $query->where('qr_ref', $qr);
            })
            ->where('appointment_date', $ndate)
            ->where('meridian', $meridian)
            ->where('is_cancel', 0)
            ->where('is_scanned', 0)
            ->first();

        if($data){
            if($data->is_scanned < 1){
                $a = Appointment::find($data->appointment_id);
                $a->is_scanned = 1;
                $a->save();
            }
        }

        return $data;
    }
}
