<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

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

    public function updateShippingMethod(Request $request ,$id){




    }
}
