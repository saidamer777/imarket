<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class ApiCustomerFavourites extends Controller
{
    use GeneralTrait;
    //

    public function getList(Request $request){
        try {
            $token = PersonalAccessToken::findToken($request->api_token);
            $customer = $token->tokenable;

            if(!$customer)
            {
                return $this->returnError('E222','عذرا هذا المستخدم غير موجود');
            }
            if($customer->active==0)
            {
                return $this->returnError('E222','عذرا هذا المستخدم غير مفعل');
            }
            $user_with_fav =Customer::with(['favourites'=>function ($query){
                return $query->with('images');
            }])->find($customer->id);

            return $this->returnData('user',$user_with_fav);
        }catch (\Exception $exception){
            return $this->returnError('00',$exception->getMessage());
        }


    }

    public function addproducttolist(Request $request){
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

            $customer->favourites()->sync($request->product_id);


            $user_with_fav =Customer::with(['favourites'=>function ($query){
                return $query->with('images');
            }])->find($customer->id);


            return $this->returnData('user',$user_with_fav);
        }catch (\Exception $exception){
            return $this->returnError('00',$exception->getMessage());
        }

    }
    public function deleteproductfromlist(Request $request){
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
            $customer->favourites()->detach($request->product_id);
            $user_with_fav =Customer::with(['favourites'=>function ($query){
                return $query->with('images');
            }])->find($customer->id);
            return $this->returnData('user',$user_with_fav);
        }catch (\Exception $exception){
            return $this->returnError('00',$exception->getMessage());
        }

    }
}
