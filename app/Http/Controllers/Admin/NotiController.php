<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Wholesales_bills;
use App\Models\Wholesales_Notification;
use Illuminate\Http\Request;

class NotiController extends Controller
{
    //

    public function getUnconfirmedNotification(){

        $totalprice=0;
       $notifications= Notification::orderBy('created_at','DESC')->where(['confirmed'=>0])->get();
//       return \App\Models\Bills::with('productsOrder')->find(1);
//      return $notifications;
        $title="بيانات الطلبات";
       return view('admin.notifications.orders',compact('notifications','totalprice','title'));



    }
    public function getUnconfirmedWholesalesNotification(){

        $totalprice=0;
        $notifications= Wholesales_Notification::orderBy('created_at','DESC')->where(['confirmed'=>0])->get();

//       return \App\Models\Bills::with('productsOrder')->find(1);
//      return $notifications;
        $title="بيانات طلبات الجملة";
        return view('admin.notifications.wholesales_orders',compact('notifications','totalprice','title'));


    }
    public function update($id)
    {
        try {

            $order = Notification::find($id);
            if(!$order)
            {
                return redirect()->route('admin.notifications')->with(['error'=>'خطأ بعملية تأكيد الطلب ']);
            }
            $order->confirmed=1;
            $order->save();
            return redirect()->route('admin.notifications')->with(['success'=>'تمت عملية التأكيد بنجاح ']);

        }catch (\Exception $eq)
        {
            return redirect()->route('admin.notifications')->with(['error'=>'خطأ بعملية تأكيد الطلب ']);

        }


    }
    public function Wholesalesorderupdate($id)
    {
        try {

            $order = Wholesales_Notification::find($id);
            if(!$order)
            {
                return redirect()->route('admin.wholesales_notifications')->with(['error'=>'خطأ بعملية تأكيد الطلب ']);
            }
            $order->confirmed=1;
            $order->save();
            return redirect()->route('admin.wholesales_notifications')->with(['success'=>'تمت عملية التأكيد بنجاح ']);

        }catch (\Exception $eq)
        {
            return redirect()->route('admin.wholesales_notifications')->with(['error'=>'خطأ بعملية تأكيد الطلب ']);

        }


    }
    public function delete($id)
    {
        try {

            $order = Notification::find($id);
            if(!$order)
            {
                return redirect()->route('admin.notifications')->with(['error'=>'خطأ بعملية حذف الطلب ']);
            }
            $order->delete();
            return redirect()->route('admin.notifications')->with(['success'=>'تمت عملية الحذف بنجاح ']);

        }catch (\Exception $eq)
        {
            return redirect()->route('admin.notifications')->with(['error'=>'خطأ بعملية تأكيد الطلب ']);

        }


    }
    public function Wholesalesorderdelete($id)
    {
        try {

            $order = Wholesales_Notification::find($id);
            if(!$order)
            {
                return redirect()->route('admin.wholesales_notifications')->with(['error'=>'خطأ بعملية حذف الطلب ']);
            }
            $order->delete();
            return redirect()->route('admin.wholesales_notifications')->with(['success'=>'تمت عملية الحذف بنجاح ']);

        }catch (\Exception $eq)
        {
            return redirect()->route('admin.wholesales_notifications')->with(['error'=>'خطأ بعملية تأكيد الطلب ']);

        }


    }
}
