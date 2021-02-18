<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\adminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function login(){
        return view('dashboard/auth/login');
    }

    public function postLogin(adminLoginRequest $request){

        //return $request;

        $remember_me = $request -> has('remember_me') ? true : false ;

        if (auth()->guard('admin')->attempt(['email'=> $request->input('email'),'password'=>$request->input('password')],$remember_me)){

            return redirect()->route('admin.dashboard');

        };

        return redirect()->back()->with(['error'=>'the data is false']);


        /*

        $admin=Admin::select()->where('email',$request->input('email'))->first();
      //  return $admin;



        if($admin){
            if (Hash::check($request->password,$admin->password)){

                $request->session()->put(['LoggedAdmin'=>$admin->id]);

                return redirect()->route('admin.dashboard');

            }

            else{
                return redirect()->back()->with(['error'=>'your password invalid']);
               }
        }
        else{
            return redirect()->back()->with(['error'=>'your email invalid']);
        }

*/
   }






}
