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

        $validate = $req->validate([
            'username' => ['required', 'string', 'unique:users'],
            'lname' => ['required', 'string', 'max:100'],
            'fname' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string', 'max:20'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'barangay' => ['required', 'string'],
            'img_path' =>  ['required', 'mimes:jpg,png,bmp', 'file', 'max:800'],
        ], $message = [
            'img_path.mimes' => 'Your uploaded image must be a file of jpg, png or bmp.',
        ]);


        $n = time() . $req->lname . $req->fname;
        $refcode = substr(md5($n), -8);

        $imgId = $req->file('img_path');
        if($imgId){
            $pathFile = $imgId->store('public/imgs'); //get path of the file
            $n = explode('/', $pathFile); //split into array using /
        }

        User::create([
            'qr_ref' => strtoupper($refcode),
            'username' => $req->username,
            'password' => Hash::make($req->password),
            'img_path' => $n[2],
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
    }







}
