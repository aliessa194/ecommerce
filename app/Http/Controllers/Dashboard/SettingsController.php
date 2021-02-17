<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\shippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function editShippingMethod($type){

       if ($type ==='free'){
           $shipping=Setting::where('key','free_sipping_lable')->first();

       }
        elseif($type ==='inner'){
            $shipping=Setting::where('key','local_lable')->first();

        }

       elseif($type ==='outer'){
            $shipping=Setting::where('key','local_lable')->first();

        }
       else{
           $shipping=Setting::where('key','free_sipping_lable')->first();
       }


       return  view('dashboard/settings/shippings/edit',compact('shipping'));


    }

    public function updateShippingMethod(shippingsRequest $request ,$id){

        try {

            $shippingsmethode=Setting::find($id);
            DB::beginTransaction();
            $shippingsmethode->update(['plan_value' => $request -> plan_value]);
            $shippingsmethode->value =$request->value;
            $shippingsmethode->save();
            DB::commit();
            return redirect()->back()->with(['success'=>'تم التحديث بنجاح']);

            }catch (\Exception $exception){

            return redirect()->back()->with(['errors'=>'لم يتم التحديث بنجاح ' ]);
            DB::rollBack();

        }




    }
}
