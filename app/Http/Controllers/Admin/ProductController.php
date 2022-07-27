<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\ProductRequest;
use App\Models\MainCategory;
use App\Models\Product_images;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function getproducts($id)
    {

        $cat = MainCategory::find($id);

        return view('admin.products.index', compact('cat',));
    }

    public function getproductsData($id)
    {

        $products = Products::with('category')->where('cat_id', $id)->get();
        return view('admin.products.index', compact(['products', 'id']));
    }

    public function create($id)
    {
        return view('admin.products.create', compact('id'));


    }

    public function store(ProductRequest $request, $cat_id)
    {
        try {

            if (!$request->has('active')) {
                $request->request->add(['active' => 0]);
            }
            $request->request->add(['name' => $request->name, 'price' => $request->price, 'count' => $request->count, 'profit' => $request->profit,'description'=>$request->description,'total_price'=>($request->price+($request->price*$request->profit/100)), 'times'=>0,'cat_id' => $cat_id]);
            Products::create($request->except(['_token']));
            return redirect()->route('admin.products', $cat_id)->with(['success' => 'تم إضافة منتج بنجاح ']);


        } catch (\Exception $ex) {
            return redirect()->route('admin.products', $cat_id)->with(['error' => 'هناك خطأ في إضافة النتج ']);

        }
    }

    public function edit($id)
    {
        $product = Products::select()->find($id);
        if (!$product) {
            redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجودة']);
        }
        return view('admin.products.edit', compact('product'));

    }

    public function update(ProductRequest $request, $id)
    {
        try {

            $product = Products::find($id);
            if (!$product) {
                return redirect()->route('admin.products.edit', $id)->with(['error' => 'خطأ بتحديث معلومات المنتج']);
            }
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            // here update to DB
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'count' => $request->count,
                'profit' => $request->profit,
                'description' => $request->description,
                'total_price' =>($request->price+($request->price*$request->profit/100)),
                'active' => $request->active
            ]);
            return redirect()->route('admin.products', $product->cat_id)->with(['success' => 'تم التحديث بنجاح']);


        } catch (\Exception $exception) {
            return redirect()->route('admin.products', $product->cat_id)->with(['error' => 'هناك خطأ في حفظ النتج ']);

        }

    }

    public function delete($id)
    {
        try {
            $product = Products::find($id);
            $images=Product_images::where('product_id',$id)->get();
            if (!$product) {
                return redirect()->route('admin.products', $product->cat_id)->with(['error' => 'لا يوجد هذا المنتج']);
            }

            $product->delete();
            return redirect()->route('admin.products', $product->cat_id)->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'خطأ بعملية حذف المنتج  ']);
        }
    }

    public function show_product_images($id)
    {

        $images = Product_images::where('product_id', $id)->get();
        return view('admin.products_images.index', compact(['images', 'id']));

    }

    public function add_image($id)
    {
        try {
            $images = Product_images::where('product_id', $id)->get();
            if ($images->count() == 4) {
                return redirect()->route('admin.products_images', $id)->with(['error' => 'لا يمكنك اضافة المزيد من الصور ']);

            }
            return view('admin.products_images.create', compact(['id']));
        } catch (\Exception $ex) {
            return redirect()->route('admin.products_images', $id)->with(['error' => 'لا يمكنك اضافة المزيد من الصور ']);
        }


    }

    public function edit_image($id)
    {
        $product_image = Product_images::find($id);
        $product_id=$product_image->product_id;
        return view('admin.products_images.edit',compact(['product_image','product_id']));
//////////////
//after determine image we delete old one from a certain path and save the new one

    }

    public function update_image(Request $request,$id){

        if(!$request->hasFile('path'))
        {
           $image=Product_images::find($id);
           if(!$image)
           {
               return redirect()->route('admin.products_images', $image->product_id)->with(['error' => 'عذرا حدث خطأ أثناء التعديل']);
               'error';

           }
           $image->orientation = $request->orientation;
           $image->save();
            return redirect()->route('admin.products_images', $image->product_id)->with(['success' => 'تم اضافة الصورة بنجاح ']);
        }


     else{
         $image=Product_images::find($id);

         if(!$image)
         {
             return redirect()->route('admin.products_images', $image->product_id)->with(['error' => 'عذرا حدث خطأ أثناء التعديل ']);

         }
         $product=Products::find($image->product_id);
         $image->orientation = $request->orientation;
         if(file_exists($image->path))
         {
             \File::delete($image->path);
         }

         $filepath = uploadImageToMainCategories('/asset/images/products/' . $product->name, $request->file('path'));
         $image->path = $filepath;
         $image->save();
         return redirect()->route('admin.products_images', $image->product_id)->with(['success' => 'تم اضافة الصورة بنجاح ']);


     }


    }

    public function store_image(Request $request, $id)
    {

        try {


            $images = Product_images::where('product_id', $id)->get();
            $product = Products::find($id);
            if ($images->count() == 4) {
                return redirect()->route('admin.products_images', $id)->with(['error' => 'لا يمكنك اضافة المزيد من الصور ']);
            }
            $product_image = new Product_images();

            if (!$request->hasFile('path')) {
                return redirect()->route('admin.products.addimage', $id)->with(['error' => 'هناك خطأ في حفظ القسم ']);
            }
            $product_image->orientation = $request->orientation;
            $filepath = uploadImageToMainCategories('/asset/images/products/'. $product->name, $request->file('path'));
            $product_image->path = $filepath;
            $product_image->product_id = $id;
            $product_image->save();
            return redirect()->route('admin.products_images', $id)->with(['success' => 'تم اضافة الصورة بنجاح ']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.products.addimage', $id)->with(['error' => 'هناك خطأ في حفظ القسم ']);

        }
    }

    public function delete_image($id)
    {
        $photo = Product_images::find($id);
        if(!$photo)
        {
            return redirect()->route('admin.products_images', $photo->product_id)->with(['error' => 'عذرا حدث خطأ ما ']);
        }
        if(file_exists($photo->path))
        {
            \File::delete($photo->path);
        }

        $photo->delete();
        return redirect()->route('admin.products_images', $photo->product_id)->with(['success' => 'تم حذف الصورة بنجاح']);
    }
    public function getextra(){
        $products=Products::select('id','name','times','count','cat_id')->OrderBy('times','desc')->take('7')->get();

        return view('admin.extra_products.index',compact('products'));

    }
}
