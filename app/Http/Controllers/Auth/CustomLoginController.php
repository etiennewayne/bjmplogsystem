<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    //

    public function showLoginForm (){
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return Auth::user();
        }

        return response()->json([
            'errors' => [
                'username' => 'The provided credentials do not match our records.',
            ]
        ], 422);
    }

    public function logout(Request $req){
        Auth::logout();

        $req->session()->invalidate();

        $req->session()->regenerateToken();

        return redirect('/');
    }

}
