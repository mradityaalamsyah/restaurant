<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('rest.login');
    } 

    public function authenticate(Request $request){
        $validator= Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if ($validator->passes()){
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('order.crudorder');
            }else{
                return redirect()->route('admin.login')->with('error','password or email is incorrect');
            }
        }else{
            return redirect()->route('admin.login')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function register(){
        return view('rest.register');
    }

    public function processRegister(Request $request){
        $validator= Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if ($validator->passes()){
            $user = new User();
            $user ->name = $request->name;
            $user ->email = $request->email;
            $user ->password = Hash::make($request->password);
            $user ->role ='admin';
            $user ->save();

            return redirect()->route('admin.login')->with('success','success register');
        }else{
            return redirect()->route('admin.register')
            ->withInput()
            ->withErrors($validator);
        }
    }
}