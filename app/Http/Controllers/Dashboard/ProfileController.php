<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\profileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{


    public function editprofile(){

        $admin=Admin::find(auth('admin')->user()->id);
        return view('dashboard.profile.editprofile',compact('admin'));

    }

    public function updateprofile(profileRequest $request){

        try {
            if ($request->filled('password')){
                 $request->merge(['password'=>bcrypt($request->password)]);
            }

            unset($request['id']);
            unset($request['password_confirmation']);



            $admin=Admin::find(auth('admin')->user()->id);




            $admin->update($request->all());
            return redirect()->back()->with(['success'=>'تم التحديث بنجاح']);

        }catch (\Exception $exception){

            return redirect()->back()->with(['errors'=>'لم يتم التحديث بنجاح ' ]);


        }

    }


    public function updateprofilepassword(profileRequest $request){






    }


}
