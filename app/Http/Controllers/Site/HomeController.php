<?php

namespace App\Http\Controllers\Site;


use App\Models\Attribute;
use App\Models\Category;
use App\models\Product;
use App\Models\Slider;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function home()
    {
        $data = [];
         $data['sliders'] = Slider::get(['photo']);
         $data['categories'] = Category::Parent()->select('id', 'slug')->with(['childrens' => function ($q) {
            $q->select('id', 'parent_id', 'slug');
            $q->with(['childrens' => function ($qq) {
                $qq->select('id', 'parent_id', 'slug');
            }]);
        }])->get();



        return view('front.home', $data);
    }
}
