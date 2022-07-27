<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function all(){
        $title="جميع المستخدمين";
       $customers= Customer::with(['address'=>function($query){
           return $query->where('active',1);

        }])->select('id','name','phone_number','active')->get();


       return view('admin.customers.index',compact('customers','title'));
    }

    public function vip(){
        $title=" VIP مستخدمين";
       $customers= Customer::with(['address'=>function($query){
           return $query->where('active',1);

        }])->select('id','name','phone_number','active')->where(['active'=>1,'vip'=>1])->get();


       return view('admin.customers.vip',compact('customers','title'));
    }
}
