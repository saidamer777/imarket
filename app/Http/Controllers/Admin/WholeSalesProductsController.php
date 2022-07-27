<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product_images;
use App\Models\Products;
use App\Models\Wholesales;
use App\Models\WholeSalesProductsImages;
use Illuminate\Http\Request;

class WholeSalesProductsController extends Controller
{
    //
    public function  getproductsData($id){

        $wholesales=Wholesales::with('category')->where('cat_id',$id)->get();
        return view('admin.wholesales.index',compact(['wholesales','id']));
    }
    public function create($id){
        return view('admin.wholesales.create',compact('id'));


    }
    public function store(ProductRequest $request,$cat_id){
        try {

            if(!$request->has('active'))
            {
                $request ->request->add(['active'=>0]);
            }
            $request->request->add(['name' => $request->name, 'price' => $request->price, 'count' => $request->count, 'profit' => $request->profit,'description'=>$request->description,'total_price'=>($request->price+($request->price*$request->profit/100)), 'times'=>0,'cat_id' => $cat_id]);
            Wholesales::create($request->except(['_token']));
            return redirect()->route('admin.wholesales',$cat_id)->with(['success'=>'تم إضافة منتج بنجاح ']);


        }catch (\Exception $ex){
            return redirect()->route('admin.wholesales',$cat_id)->with(['error'=>'هناك خطأ في إضافة المنتج ']);

        }
    }
    public function edit($id){
        $wholesale=Wholesales::select()->find($id);
        if(!$wholesale)
        {
            redirect()->route('admin.wholesales')->with(['error'=>'هذا المنتج غير موجودة']);
        }
        return view('admin.wholesales.edit',compact('wholesale'));

    }
    public function update(ProductRequest $request,$id){
        try {

            $wholesale=Wholesales::find($id);
            if(!$wholesale)
            {
                return redirect()->route('admin.wholesales.edit',$id)->with(['error'=>'خطأ بتحديث معلومات المنتج']);
            }
            if(!$request ->has('active'))
                $request ->request->add(['active'=>0]);
            // here update to DB
            $wholesale ->update([
                'name'=>$request->name,
                'price'=>$request->price,
                'count'=>$request->count,
                'profit'=>$request->profit,
                'description' => $request->description,
                'total_price' =>($request->price+($request->price*$request->profit/100)),
                'active'=>$request->active
            ]);
            return redirect()->route('admin.wholesales',$wholesale->cat_id)->with(['success'=>'تم التحديث بنجاح']);


        }catch (\Exception $exception)
        {
            return redirect()->route('admin.wholesales',$wholesale->cat_id)->with(['error'=>'هناك خطأ في حفظ النتج ']);

        }

    }

    public function delete($id){
        try {
            $wholesale = Wholesales::find($id);
            if(!$wholesale)
            {
                return redirect()->route('admin.wholesales',$wholesale->cat_id)->with(['error'=>'لا يوجد هذا المنتج']);
            }
            $wholesale ->delete();
            return redirect()->route('admin.wholesales',$wholesale->cat_id)->with(['success'=>'تم الحذف بنجاح']);

        }catch (\Exception $ex){
            return redirect()->route('admin.wholesales')->with(['error'=>'خطأ بعملية حذف المنتج  ']);
        }
    }


    public function show_product_images($id)
    {

        $images = WholeSalesProductsImages::where('wholesale_product_id', $id)->get();
        return view('admin.wholesales_products_images.index', compact(['images', 'id']));

    }

    public function add_image($id)
    {
        try {
            $images = WholeSalesProductsImages::where('wholesale_product_id', $id)->get();
            if ($images->count() == 4) {
                return redirect()->route('admin.wholesales_products_images', $id)->with(['error' => 'لا يمكنك اضافة المزيد من الصور ']);

            }
            return view('admin.wholesales_products_images.create', compact(['id']));
        } catch (\Exception $ex) {
            return redirect()->route('admin.wholesales_products_images', $id)->with(['error' => 'لا يمكنك اضافة المزيد من الصور ']);
        }


    }

    public function edit_image($id)
    {
        $product_image = WholeSalesProductsImages::find($id);
        $product_id=$product_image->wholesale_product_id;
        return view('admin.wholesales_products_images.edit',compact(['product_image','product_id']));
//////////////
//after determine image we delete old one from a certain path and save the new one

    }

    public function update_image(Request $request,$id){

        if(!$request->hasFile('path'))
        {
            $image=WholeSalesProductsImages::find($id);
            if(!$image)
            {
                return redirect()->route('admin.wholesales_products_images', $image->wholesale_product_id)->with(['error' => 'عذرا حدث خطأ أثناء التعديل']);

            }
            $image->orientation = $request->orientation;
            $image->save();
            return redirect()->route('admin.wholesales_products_images', $image->wholesale_product_id)->with(['success' => 'تم اضافة الصورة بنجاح ']);
        }


        else{
            $image=WholeSalesProductsImages::find($id);

            if(!$image)
            {
                return redirect()->route('admin.wholesales_products_images', $image->wholesale_product_id)->with(['error' => 'عذرا حدث خطأ أثناء التعديل ']);

            }
            $product=Wholesales::find($image->wholesale_product_id);
            $image->orientation = $request->orientation;
            if(file_exists($image->path))
            {
                \File::delete($image->path);
            }

            $filepath = uploadImageToMainCategories('/asset/images/wholesales_products/' . $product->name, $request->file('path'));
            $image->path = $filepath;
            $image->save();
            return redirect()->route('admin.wholesales_products_images', $image->wholesale_product_id)->with(['success' => 'تم اضافة الصورة بنجاح ']);


        }


    }

    public function store_image(Request $request, $id)
    {

        try {


            $images = WholeSalesProductsImages::where('wholesale_product_id', $id)->get();
            $product = Wholesales::find($id);
            if ($images->count() == 4) {
                return redirect()->route('admin.wholesales_products_images', $id)->with(['error' => 'لا يمكنك اضافة المزيد من الصور ']);
            }
            $product_image = new WholeSalesProductsImages();

            if (!$request->hasFile('path')) {
                return redirect()->route('admin.wholesales_products.addimage', $id)->with(['error' => 'هناك خطأ في حفظ المنتج ']);
            }
            $product_image->orientation = $request->orientation;
            $filepath = uploadImageToMainCategories('/asset/images/wholesales_products/'. $product->name, $request->file('path'));
            $product_image->path = $filepath;
            $product_image->wholesale_product_id = $id;
            $product_image->save();
            return redirect()->route('admin.wholesales_products_images', $id)->with(['success' => 'تم اضافة الصورة بنجاح ']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.wholesales_products.addimage', $id)->with(['error' => 'هناك خطأ في حفظ القسم ']);

        }
    }

    public function delete_image($id)
    {
        $photo = WholeSalesProductsImages::find($id);
        if(!$photo)
        {
            return redirect()->route('admin.wholesales_products_images', $photo->wholesale_product_id)->with(['error' => 'عذرا حدث خطأ ما ']);
        }
        if(file_exists($photo->path))
        {
            \File::delete($photo->path);
        }

        $photo->delete();
        return redirect()->route('admin.wholesales_products_images', $photo->wholesale_product_id)->with(['success' => 'تم حذف الصورة بنجاح']);
    }


}
