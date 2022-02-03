<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;


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
            ->leftJoin('provinces as b', '.a.province', 'b.provCode')
            ->leftJoin('cities as c', 'a.city', 'c.citymunCode')
            ->leftJoin('barangays as d', 'a.barangay', 'd.brgyCode')
            ->select('a.user_id', 'a.qr_ref', 'a.username', 'a.lname', 'a.fname', 'a.mname', 'a.email', 'a.role', 'a.sex', 'a.street', 'img_path', 'b.provCode', 'b.provDesc', 'c.citymunCode', 'c.citymunDesc',
                'd.brgyCode', 'd.brgyDesc')
            ->where('a.user_id', $userid)
            ->first();
    }



    public function update(Request $req, $id){

        $req->validate([
            'email' => ['required', 'unique:users,email,'.$id.',user_id'],
            'lname' => ['required'],
            'fname' => ['required'],
            'sex' => ['required'],
            'contact_no' => ['required'],
            'province' => ['required'],
            'city' => ['required'],
            'barangay' => ['required'],
           
        ]);

        $data = User::find($id);

        $data->lname = strtoupper($req->lname);
        $data->fname = strtoupper($req->fname);
        $data->mname = strtoupper($req->mname);
        $data->sex = strtoupper($req->sex);
        $data->email = $req->email;
        $data->contact_no = $req->contact_no;

        $data->province = $req->province;
        $data->city = $req->city;
        $data->barangay = $req->barangay;
        $data->save();


        return response()->json([
            'status' => 'updated'
        ],200);


    }
}
