<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class RegisterPageController extends Controller
{
    //

    public function index(){
        return view('register');
    }


    public function store(Request $req){
        

        $req->validate([
            'username' => ['required', 'max:50'],
            'password' => ['required', 'min:4', 'confirmed'],
            'email' => ['required', 'max:100', 'unique:users'],
            'lname' => ['required', 'max:100'],
            'fname' => ['required', 'max:100'],
            'sex' => ['required', 'max:10'],
            'province' => ['required'],
            'city' => ['required'],  
            'barangay' => ['required'],  
        ]);


        $n = time() . $req->lname . $req->fname;
        $refcode = substr(md5($n), -8);

        User::create([
            'qr_ref' => strtoupper($refcode),
            'username' => $req->username,
            'password' => Hash::make($req->password),
            'email' => $req->email,
            'lname' => strtoupper($req->lname),
            'fname' => strtoupper($req->fname),

            'mname' => strtoupper($req->mname),
            'suffix' => strtoupper($req->suffix),

            'sex' => strtoupper($req->sex),
            'province' => strtoupper($req->province),
            'city' => strtoupper($req->city),
            'barangay' => strtoupper($req->barangay),

            'street' => $req->street,
            'role' => 'USER'
        ]);


        return response()->json([
            'status' => 'saved'
        ]);
        return $req;
    }







}
