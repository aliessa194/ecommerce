<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\BrandsRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    public function index()
    {
        $brand=Brand::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.brands.index',compact('brand'));



    }

    public function creat()
    {

        return view('dashboard.brands.creat');

    }


    public function store(BrandsRequest $request)
    {




            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $filename='';

            if ($request->has('photo')) {

                $filename = uploadImage('brands', $request->photo);
            }

            DB::beginTransaction();

            $brand= Brand::create($request->except('_token','photo'));

            $brand->name = $request->name;
            $brand->photo=$filename;
            $brand->save();

            DB::commit();

            return redirect()->route('admin.brands')->with(['success' => ' تمت العمليه بنجاح']);




    }


    public function edit($id)
    {

        try {



            $brands=Brand::find($id);

            if (!$brands)
                return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);



            return view('dashboard.brands.edit', compact('brands'));

        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);

        }

    }

    public function update(BrandsRequest $request ,$id){

        try {


            $brands=Brand::find($id);
            if (!$brands)
                return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);


            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);




            DB::beginTransaction();
            $filename='';
            if ($request->has('photo')) {

                $filename = uploadImage('brands', $request->photo);
                Brand::where('id',$id)->update(['photo'=>$filename]);

            }

                $brands->update($request->all());
                $brands->name=$request->name;
                $brands->save();
                DB::commit();



            return redirect()->route('admin.brands')->with(['success' => ' تمت العمليه بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);

        }


    }




    public function delete($id)
    {

        try {

            $brands = Brand::find($id);

            if (!$brands) {

                return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);
            } else {

                $brands->delete();
                return redirect()->route('admin.brands')->with(['success' => ' تمت العمليه بنجاح']);


            }


        } catch (\Exception $ex) {

            return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);

        }
    }
}
