<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ApiMainCategoryController extends Controller
{
    //
    use GeneralTrait;

    public function getMainCategories(){
        $categories=MainCategory::query()->with(['products'=>function ($query){
            return $query->with('images')->select('cat_id','id','name','count','description','total_price');
        }])->select('id','name','slug')->where('active',1)->get();
        if(!$categories)
        {
            return  $this->returnError('E222','هناك خطأ بجلب البيانات');
        }

        return $this->returnData('Categories',$categories) ;
    }
    public function getWholesalesMainCategories(){
        $categories=MainCategory::query()->with(['wholesales'=>function ($query){
            return $query->with('images')->select('cat_id','id','name','count','description','total_price');
        }])->select('id','name','slug')->where('active',1)->get();
        if(!$categories)
        {
            return  $this->returnError('E222','هناك خطأ بجلب البيانات');
        }

        return $this->returnData('Categories',$categories) ;
    }
}
