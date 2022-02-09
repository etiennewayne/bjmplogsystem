<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogReportController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('bjmp');
    }

    public function index(){
        return view('report.log-report');
    }

    public function getLogReport(Request $req){
      
        $dateFrom = date('Y-m-d', strtotime($req->datefrom));
        $dateTo = date('Y-m-d', strtotime($req->dateto));

        $data = \DB::table('appointments as a')
            ->join('users as b', 'a.user_id', 'b.user_id')
            ->where('is_cancel', 0)
            ->whereBetween('a.appointment_date', [$dateFrom, $dateTo])
            ->get();
        
        return $data;
    }

}
