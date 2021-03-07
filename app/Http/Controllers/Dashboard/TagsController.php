<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\BrandsRequest;
use App\Http\Requests\Request\TagsRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    public function index()
    {
        $tags=Tag::orderBy('id','DESC')->paginate(PAGINATION_COUNT);

        return view('dashboard.tags.index',compact('tags'));

    }

    public function creat()
    {

        return view('dashboard.tags.creat');

    }


    public function store(TagsRequest $request)
    {



            DB::beginTransaction();

            $tag= Tag::create($request->only('slug'));

            $tag->name = $request->name;

            $tag->save();

            DB::commit();

            return redirect()->route('admin.tags')->with(['success' => ' تمت العمليه بنجاح']);




    }


    public function edit($id)
    {

        try {



            $tags=Tag::find($id);

            if (!$tags)
                return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود ']);



            return view('dashboard.tags.edit', compact('tags'));

        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود ']);

        }

    }

    public function update(TagsRequest $request ,$id){

        try {


            $tags=Tag::find($id);
            if (!$tags)
                return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود ']);



            DB::beginTransaction();

            $tags->update($request->only('slug'));
            $tags->name=$request->name;
            $tags->save();
            DB::commit();



            return redirect()->route('admin.tags')->with(['success' => ' تمت العمليه بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود ']);

        }


    }




    public function delete($id)
    {

        try {

            $brands = Tag::find($id);

            if (!$brands) {

                return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود ']);
            } else {

                $brands->delete();
                return redirect()->route('admin.tags')->with(['success' => ' تمت العمليه بنجاح']);


            }


        } catch (\Exception $ex) {

            return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);

        }
    }
}
