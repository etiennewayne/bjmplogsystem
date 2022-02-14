<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
        return view('administrator.user');
    }

    public function getUsers(Request $req){
        $sortkey = explode(".",$req->sort_by);

        return DB::table('users as a')
            ->join('provinces as b', '.a.province', 'b.provCode')
            ->join('cities as c', 'a.city', 'c.citymunCode')
            ->join('barangays as d', 'a.barangay', 'd.brgyCode')
            ->select('user_id', 'username', 'lname', 'fname', 'mname', 'email', 'role', 'sex', 'img_path', 'b.provCode', 'b.provDesc')
            ->where('lname', 'like', '%'. $req->lname . '%')
            ->orderBy($sortkey[0], $sortkey[1])
            ->paginate($req->perpage);
    }


    public function show($id){
        return User::find($id);
    }


    public function store(Request $req){

        $validate = $req->validate([
            'username' => ['required', 'string', 'unique:users'],
            'lname' => ['required', 'string', 'max:100'],
            'fname' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string', 'max:20'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'role' => ['required', 'string'],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'barangay' => ['required', 'string'],
            'img_path' =>  ['mimes:jpg,png,bmp', 'file', 'max:800'],
        ], $message = [
            'img_path.mimes' => 'Your uploaded image must be a file of jpg, png or bmp.',
        ]);

        $qr_code = substr(md5(time() . $req->lname . $req->fname), -8);

        //upload image b permit
        $imgId = $req->file('img_path');
        if($imgId){
            $pathFile = $imgId->store('public/imgs'); //get path of the file
            $n = explode('/', $pathFile); //split into array using /
        }


        User::create([
            'qr_ref' => $qr_code,
            'username' => $req->username,
            'password' => Hash::make($req->password),
            'img_path' => $imgId != null ? $n : null,
            'email' => $req->email,
            'lname' => strtoupper($req->lname),
            'fname' => strtoupper($req->fname),
            'mname' => strtoupper($req->mname),
            'sex' => $req->sex,
            'contact_no' => $req->contact_no,
            'role' => $req->role,
            'province' => $req->province,
            'city' => $req->city,
            'barangay' => $req->barangay,
            'street' => strtoupper($req->street)
        ]);

        return response()->json([
            'status' => 'saved'
        ],200);

    }

    public function update(Request $req, $id){

        $validate = $req->validate([
            'username' => ['required', 'string', 'unique:users,username,' .$id. ',user_id'],
            'lname' => ['required', 'string', 'max:100'],
            'fname' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string', 'max:20'],
            'email' => ['required', 'unique:users,email,' .$id. ',user_id'],
            'role' => ['required', 'string'],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'barangay' => ['required', 'string'],
        ]);

        $data = User::find($id);
        $data->username = $req->username;
        $data->lname = strtoupper($req->lname);
        $data->fname = strtoupper($req->fname);
        $data->mname = strtoupper($req->mname);
        $data->sex = $req->sex;
        $data->contact_no = $req->contact_no;
        $data->email = $req->email;
        $data->role = $req->role;
        $data->province = $req->province;
        $data->city = $req->city;
        $data->barangay = $req->barangay;
        $data->street = strtoupper($req->street);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ]);

    }



    public function destroy($id){
        $exist = Appointment::where('user_id', $id)
            ->exists();
        if($exist){

            return response()->json([
                'errors' => [
                    'exist' => ['User already have an appointment, user cannot be deleted.']
                ]
            ], 422);
        }
        User::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);
    }


    public function resetPassword(Request $req, $id){

        $req->validate([
            'password' => ['required',  'confirmed', 'min:4']
        ]);

        $data = User::find($id);
        $data->password = Hash::make($req->password);
        $data->save();

        return response()->json([
            'status' => 'reseted'
        ]);
    }

}
