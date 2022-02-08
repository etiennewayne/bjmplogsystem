<?php

namespace App\Http\Controllers\BJMP;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BjmpChangePasswordController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('bjmp');
    }


    public function update(Request $req){

        $req->validate([
            'password' => ['required', 'confirmed', 'min:4'],
            'old_password' => ['required']
        ]);

        $user = Auth::user();

        if(Hash::check($req->old_password, $user->password)){
            $data = User::find($user->user_id);
            $data->password = Hash::make($req->password);
            $data->save();

            return response()->json([
                'status' => 'updated'
            ],200);
        }else{
            return response()->json([
                'errors'=> [
                    'old_password' => [
                        "Password does not match with the old one."
                    ],
                ]
            ], 422);
        }
    }

}
