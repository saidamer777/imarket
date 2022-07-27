<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Wholesales;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    use GeneralTrait;
    //

    public function getRandomData(){

        /// getting all products in random way
    $products=Products::with('images')->select('id','name','count','description','total_price')->where('active',1)->inRandomOrder()->paginate(3);
//    $products=Products::with('images')->select('id','name','count','description','total_price')->where('active',1)->get();
        if(!$products)
        {
          return  $this->returnError('E222','هناك خطأ بجلب البيانات');
        }

          return $this->returnData('Products',$products) ;
    }

    public function getExtraProducts(){
    $products=Products::with('images')->select('id','name','count','description','total_price')->where('active',1)->OrderBy('times','desc')->take(7)->get();
        if(!$products)
        {
            return  $this->returnError('E222','هناك خطأ بجلب البيانات');
        }

        return $this->returnData('Products',$products) ;
    }




    public function getWholesalesRandomData(){

        /// getting all products in random way
        $products=Wholesales::with('images')->select('id','name','count','description','total_price')->where('active',1)->inRandomOrder()->paginate(3);
//    $products=Products::with('images')->select('id','name','count','description','total_price')->where('active',1)->get();
        if(!$products)
        {
            return  $this->returnError('E222','هناك خطأ بجلب البيانات');
        }

        return $this->returnData('Products',$products) ;
    }


    public function getWholesalesExtraProducts(){
        $products=Wholesales::with('images')->select('id','name','count','description','total_price')->where('active',1)->OrderBy('times','desc')->take(7)->get();
        if(!$products)
        {
            return  $this->returnError('E222','هناك خطأ بجلب البيانات');
        }

        return $this->returnData('Products',$products) ;
    }


}
