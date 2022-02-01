<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyDashboardController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('client');

    }


    public function index(){
        return view('client.my-dashboard');
    }

    public function getUserInfo(){
        $userid = Auth::user()->user_id;

        return DB::table('users as a')
            ->join('provinces as b', '.a.province', 'b.provCode')
            ->join('cities as c', 'a.city', 'c.citymunCode')
            ->join('barangays as d', 'a.barangay', 'd.brgyCode')
            ->select('a.user_id', 'a.qr_ref', 'a.username', 'a.lname', 'a.fname', 'a.mname', 'a.email', 'a.role', 'a.sex', 'a.street', 'img_path', 'b.provCode', 'b.provDesc', 'c.citymunCode', 'c.citymunDesc',
                'd.brgyCode', 'd.brgyDesc')
            ->where('a.user_id', $userid)
            ->first();
    }
}
