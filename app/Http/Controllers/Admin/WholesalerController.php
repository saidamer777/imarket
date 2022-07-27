<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wholesalers;
use Illuminate\Http\Request;

class WholesalerController extends Controller
{
    //
    public function all(){
        $title="جميع المحلات التجارية";
       $wholesalers=Wholesalers::select('id','name','phone')->get();
       return view('admin.wholesalers.index',compact('wholesalers','title'));
    }

    public function vip(){
        $title="محلات تجارية VIP";
        $wholesalers=Wholesalers::select('id','name','phone')->where('vip',1)->get();
       return view('admin.wholesalers.vip',compact('wholesalers','title'));
    }

    public function create(){
        $title="إضافة محل";
     return view('admin.wholesalers.create',compact('title'));
    }
    public function store(Request $request){
        try{
            Wholesalers::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'password'=>bcrypt($request->password),
            ]);
            return redirect()->route('admin.wholesalers.create')->with(['success'=>'تمت الإضافة بنجاح']);
        }catch (\Exception $exception){
            return  redirect()->route('admin.wholesalers.create')->with(['error'=>'هناك خطأ بإضافة المحل']);
        }

    }
}
