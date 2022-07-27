<?php

namespace App\Http\Controllers\Api\WholeSaler;

use App\Events\Confirmation;
use App\Events\WholesalerOrder;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Bills;
use App\Models\MarketPlace;
use App\Models\Notification;
use App\Models\Wholesales_bills;
use App\Models\Wholesales_Notification;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class ApiWholeSalerOrder extends Controller
{
    //
    use GeneralTrait;

    public function createorder(Request $request){
        try {
            $wholesaler = Auth::guard('wholesaler-api')->user();
            if (!$wholesaler) {
                return $this->returnError('E222', 'عذرا هذا المستخدم غير موجود');
            }


            $orders = $request->only('order');
            if(!$orders){
                return $this->returnError("E222",'حدث خطأ بالطلب');
            }
            $request->request->add(['wholesaler_id' => $wholesaler->id]);
            $firstorder = Wholesales_bills::create($request->except(['order','api_password']));
            $marketplace_id=MarketPlace::where(['active'=>1,'wholesaler_id'=>$wholesaler->id])->first()->id;
            $firstorder->marketplace_id=$marketplace_id;
            $firstorder->save();
            $products = collect($request->input('order', []))->map(function ($product) {
                return ['products_count' => $product];
            });

            $firstorder->wholesalesProductOrder()->sync(
                $products);
            Wholesales_Notification::create(['wholesales_bill_id' => $firstorder->id]);
            $orderandProducts = Wholesales_bills::with('wholesalesProductOrder')->find($firstorder->id);
            event(new WholesalerOrder($orderandProducts));
            return $this->returnData("wholesaler_order",$orderandProducts , 'تم الطلب بنجاح');

        }catch (\Exception $ex){
            return $this->returnError('00','حدث خطأ بالطلب ');
//            return $this->returnError('00',$ex->getMessage());
        }

    }
    public function getallorders(Request $request){

        try {
            $wholesaler = Auth::guard('wholesaler-api')->user();
            if (!$wholesaler) {
                return $this->returnError('E222', 'عذرا هذا المستخدم غير موجود');
            }

            $bills = Wholesales_bills::orderBy('created_at','DESC')->with(['marketplace','wholesalesProductOrder'])->where('wholesaler_id',$wholesaler->id)->get();
            if(!$bills){
                return $this->returnError('E222','هذا الطلب غير موجودة');

            }
            foreach ($bills as $bill)
            {
                $total_value=0;
                foreach ($bill->wholesalesProductOrder as $product){
                    $product->products_count = $product->pivot->products_count;
                    $product->total_value=$product->products_count*$product->total_price;
                    $total_value+=$product->total_value;
                }
                $bill->total_value=$total_value;

            }

            return $this->returnData('orders',$bills);


        }catch (\Exception $exception){
            return $this->returnError('','خطـأ بجلب الطلبات ');
        }
    }
}
