<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\SubCategoriesRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoriesController extends Controller


{
    public function index()
    {
         $cat=Category::child()->orderBy('id','DESC')->paginate(PAGINATION_COUNT);
         return view('dashboard.subcatogeries.index',compact('cat'));



    }

    public function creat()
    {
        $cat=Category::parent()->orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.subcatogeries.creat',compact('cat'));

    }


    public function store(SubCategoriesRequest $request)
    {


        try {
            if (!$request->has('is_active'))

                $request->request->add(['is_active' => 0]);
            else

                $request->request->add(['is_active' => 1]);

            DB::beginTransaction();

          $catt= Category::create($request->except('_token'));

             $catt->name = $request-> name ;
            $catt->save();

            DB::commit();

            return redirect()->route('admin.sub_categories')->with(['success' => ' تمت العمليه بنجاح']);


        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.sub_categories')->with(['error' => ' لم تتم العمليه']);

        }

    }


    public function edit($id)
    {

        try {

            $mainCategory=Category::find($id);

            if (!$mainCategory)
                return redirect()->route('admin.sub_categories')->with(['error' => 'هذا القسم غير موجود ']);

             $cat=Category::parent()->paginate(1000);





            return view('dashboard.subcatogeries.edit', compact('mainCategory','cat'));

        } catch (\Exception $ex) {
             DB::rollBack();
            return redirect()->route('admin.sub_categories')->with(['error' => 'هذا القسم غير موجود ']);

        }

    }

    public function update(SubCategoriesRequest $request ,$id){

        try {


            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $cat=Category::find($id);

            if (!$cat){

                return redirect()->route('admin.sub_categories')->with(['error' => 'هذا القسم غير موجود ']);
            }else{
                DB::beginTransaction();
                $cat->update($request->all());
                $cat->name=$request->name;
                $cat->save();
                DB::commit();
            }


            return redirect()->route('admin.sub_categories')->with(['success' => ' تمت العمليه بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.sub_categories')->with(['error' => 'هذا القسم غير موجود ']);

        }


    }


    public function delete($id)
    {

        try {

            $cat=Category::find($id);

            if (!$cat){

                return redirect()->route('admin.sub_categories')->with(['error' => 'هذا القسم غير موجود ']);
            }else{

                $cat->delete();
                return redirect()->route('admin.sub_categories')->with(['success' => ' تمت العمليه بنجاح']);
            }


        } catch (\Exception $ex) {

            return redirect()->route('admin.sub_categories')->with(['error' => 'هذا القسم غير موجود ']);

        }
    }

}
