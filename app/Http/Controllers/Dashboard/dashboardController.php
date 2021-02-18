<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{


    public function index(){


        return view('dashboard.index');

    }

    public function logout(){

        $guard=$this->getGaurd();
        $guard->logout();
        return redirect()->route('admin.login');

    }

    private function getGaurd(){

        return auth('admin');

}


}
