<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\GeneralProductRequest;
use App\Http\Requests\Request\GeneralStockRequest;
use App\Http\Requests\Request\ProductImagesRequest;
use App\Http\Requests\Request\ProductPriceRequest;
use App\Models\Brand;
use App\Models\Category;
use App\models\Product;
use App\models\Image;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(){




        $products = Product::select('id','slug','price', 'created_at')->paginate(PAGINATION_COUNT);
        return view('dashboard.products.generale.index', compact('products'));

    }


    public function create(){

       $data=[];

        $data['brands']=Brand::Active()->select('id')->get();
        $data['tags']=Tag::select('id')->get();
        $data['categories']=Category::Active()->select('id')->get();



        return view('dashboard.products.generale.create',$data);

    }

    public function store( GeneralProductRequest  $request ){


        try {



        DB::beginTransaction();

        //validation

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);

        $product = Product::create([
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,
            'is_active' => $request->is_active,
        ]);
        //save translations
        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->save();

        //save product categories

        $product->categories()->attach($request->categories);

        //save product tags
        $product->tags()->attach($request->tags);
        DB::commit();
        return redirect()->route('admin.products')->with(['success' => 'تم ألاضافة بنجاح']);
        }

        catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.main_categories')->with(['error' => ' لم تتم العمليه']);

        }
    }

    public function getPrice($id){

        return view('dashboard.products.price.create',compact('id'))  ;
    }

    public function saveProductPrice(ProductPriceRequest $request){

        try{

            Product::whereId($request -> product_id) -> update($request -> only(['price','special_price','special_price_type','special_price_start','special_price_end']));

            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);
        }catch(\Exception $ex){

            return redirect()->route('admin.main_categories')->with(['error' => ' لم تتم العمليه']);
        }
    }



    public function getStock($product_id){

        return view('dashboard.products.inventory.create') -> with('id',$product_id) ;
    }

    public function saveProductStock (GeneralStockRequest $request){


        Product::whereId($request -> product_id) -> update($request -> except(['_token','product_id']));

        return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);

    }


    public function addImages($product_id){
        return view('dashboard.products.images.create')->withId($product_id);
    }



    public function saveProductImages(Request $request ){

        $file = $request->file('dzfile');
        $filename = uploadImage('products', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function saveProductImagesDB(ProductImagesRequest $request){


        try {
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Image::create([
                        'product_id' => $request->product_id,
                        'photo' => $image,
                    ]);
                }
            }

            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);

        }catch(\Exception $ex){

        }
    }





}
