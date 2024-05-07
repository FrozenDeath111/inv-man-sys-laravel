<?php

namespace App\Http\Controllers;

use App\Models\Invuser;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    //
    public function index(){
        if(session()->has("username")){
            return view("welcome",[
                "username"=>session()->get("username")
            ]);
        }
        
        return view("login");
    }

    public function login(){
        if(session()->has("username")){
            return view("welcome",[
                "username"=>session()->get("username")
            ]);
        }

        return view("login");
    }

    public function logout(){
        session()->flush();
        return redirect("/login");
    }

    public function authenticate(Request $request){
        $user = Invuser::where("username",$request->username)->first();

        if($user->password != $request->password){
            return view("login", [
                'error'=>'Invalid Password',
                'code'=>400,
            ]);
        }

        session()->put("username",$user->username);
        session()->put("id",$user->id);
        return view("welcome",[
            "username"=>session()->get("username")
        ]);
    }

    public function dashboard(){
        $username = '';
        if(session()->has("username")){
            $username = session()->get("username");
        }

        $user = Invuser::where("username", $username)->first();
        if($user->role == 1){
            return redirect("/admin/dashboard");
        } else if($user->role == 2){
            return redirect("/warehouse-staff/dashboard");
        } else if($user->role == 3){
            return redirect("/store/dashboard");
        } else {
            return view('errorpage');
        }
    }
}
