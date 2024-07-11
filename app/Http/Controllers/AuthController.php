<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class AuthController extends Controller
{
    function kelogin(){
        return redirect('/login');
    }
    function loginin(){
        return view('welcome');
    }

    function login (Request $request){

        $user = Users::where('name','=',$request->name)->first();
        if($user && $request->password == $user->password){
            Auth::login($user);
            // if(Auth::check()){
            //     if(Auth::user()->roles == 'wargalokal'){
            //         return redirect('/warlok');
            //     }elseif (Auth::user()->roles == 'pengantar'){
            //         return redirect('/pengantar');
            //     }elseif (Auth::user()->roles == 'pemilikbank'){
            //         return redirect('/pemilik');
            //     }
            // }else{
            //     return "not logged in";
            // }
           // return "Success";
           return redirect('/dashboard');
          }else{
            return redirect()->back()->with(['error' => 'Invalid credentials']);
          }
     
    
    }

    function logout(){
        Auth::logout();
        return redirect('/');
    }
}
