<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FriskItemReportController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('bjmp');
    }


    public function index(){
        return view('report.frisk-log-report');
    }

    public function getLogFriskItemReport(Request $req){
        $dateFrom = date('Y-m-d', strtotime($req->datefrom));
        $dateTo = date('Y-m-d', strtotime($req->dateto));

        $data = \DB::table('appointments as a')
            ->join('users as b', 'a.user_id', 'b.user_id')
            ->join('frisk_items as c', 'a.appointment_id', 'c.appointment_id')
            ->where('status', 1)
            ->where('is_scanned', 1)
            ->whereBetween('a.appointment_date', [$dateFrom, $dateTo])
            ->get();

        return $data;
    }
}
