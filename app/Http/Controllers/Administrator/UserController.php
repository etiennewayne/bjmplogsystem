<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
        return view('administrator.user');
    }

    public function fetchUsers(Request $req){
        $sortkey = explode(".",$req->sort_by);

        return DB::table('users as a')
            ->where('lname', 'like', '%'. $req->lname . '%')
            ->select('user_id', 'username', 'lname', 'fname', 'mname', 'email', 'role', 'sex')
            ->orderBy($sortkey[0], $sortkey[1])
            ->paginate($req->perpage);
    }



}
