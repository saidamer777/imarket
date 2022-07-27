<?php

namespace App\Http\Controllers\Api\Customer;

use App\Events\Confirmation;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Bills;
use App\Models\Customer;
use App\Models\Notification;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class ApiCustomerOrder extends Controller
{
    use GeneralTrait;
    //

    public function createorder(Request $request){
        try {
            $token = PersonalAccessToken::findToken($request->api_token);
            try {
                $customer = $token->tokenable;

            }catch (\Exception $exception){
                return  $this->returnError('E444','الرجاء تسجيل الدخول اولا ');
            }


            $orders = $request->only('order');
            if(!$orders){
                return $this->returnError("E222",'حدث خطأ بالطلب');
            }
            $request->request->add(['customer_id' => $customer->id]);
            $firstorder = Bills::create($request->except(['api_token', 'order','api_password']));
            $address_id=Address::where(['active'=>1,'customer_id'=>$customer->id])->first()->id;
            $firstorder->address_id=$address_id;
            $firstorder->save();
            $products = collect($request->input('order', []))->map(function ($product) {
                return ['products_count' => $product];
            });

            $firstorder->productsOrder()->sync(
                $products);
            Notification::create(['bill_id' => $firstorder->id]);
            $orderandProducts = Bills::with('productsOrder')->find($firstorder->id);
            event(new Confirmation($orderandProducts));
            return $this->returnData("customer_order",$orderandProducts , 'تم الطلب بنجاح');

        }catch (\Exception $ex){
            return $this->returnError('00','حدث خطأ بالطلب ');
        }

    }

    public function getallorders(Request $request){
        try {
            $token = PersonalAccessToken::findToken($request->api_token);
            try {
                $customer = $token->tokenable;

            }catch (\Exception $exception){
                return  $this->returnError('E444','الرجاء تسجيل الدخول اولا ');
            }

            if(!$customer)
            {
                return $this->returnError('E222','عذرا هذا المستخدم غير موجود');
            }

            if($customer->active==0)
            {
                return $this->returnError('E222','عذرا هذا المستخدم غير مفعل');
            }

          $bills = Bills::orderBy('created_at','DESC')->with(['address','productsOrder'])->where('customer_id',$customer->id)->get();
            if(!$bills){
                return $this->returnError('E222','هذا الطلب غير موجودة');

            }
            foreach ($bills as $bill)
            {
                $total_value=0;
                foreach ($bill->productsOrder as $product){
                    $product->products_count = $product->pivot->products_count;
                    $product->total_value=$product->products_count*$product->total_price;
                    $total_value+=$product->total_value;
                }
                $bill->total_value=$total_value;

            }

            return $this->returnData('orders',$bills);
        }catch (\Exception $exception){
//            return $this->returnError('','خطـأ بجلب الطلبات ');
            return $this->returnError('',$exception->getMessage());
        }

    }
}
