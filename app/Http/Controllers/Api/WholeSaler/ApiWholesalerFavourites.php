<?php

namespace App\Http\Controllers\Api\WholeSaler;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Wholesalers;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class ApiWholesalerFavourites extends Controller
{
    use GeneralTrait;

    //
    public function getList(Request $request)
    {
        try {
//            $token = PersonalAccessToken::findToken($request->api_token);
//            $customer = $token->tokenable;

            $wholesaler = Auth::guard('wholesaler-api')->user();


            if (!$wholesaler) {
                return $this->returnError('E222', 'عذرا هذا المستخدم غير موجود');
            }

            $user_with_fav = Wholesalers::with(['favourites' => function ($query) {
                return $query->with('images');
            }])->find($wholesaler->id);

            return $this->returnData('user', $user_with_fav);
        } catch (\Exception $exception) {
            return $this->returnError('00', $exception->getMessage());
        }


    }


    public function addproducttolist(Request $request)
    {
        try {
            $wholesaler = Auth::guard('wholesaler-api')->user();


            if (!$wholesaler) {
                return $this->returnError('E222', 'عذرا هذا المستخدم غير موجود');
            }

            $wholesaler->favourites()->attach($request->wholesales_product_id);


            $user_with_fav = Wholesalers::with(['favourites' => function ($query) {
                return $query->with('images');
            }])->find($wholesaler->id);


            return $this->returnData('user', $user_with_fav);
        } catch (\Exception $exception) {
            return $this->returnError('00', $exception->getMessage());
        }

    }


    public function deleteproductfromlist(Request $request)
    {
        try {
            $wholesaler = Auth::guard('wholesaler-api')->user();

            if (!$wholesaler) {
                return $this->returnError('E222', 'عذرا هذا المستخدم غير موجود');
            }

            $wholesaler->favourites()->detach($request->wholesales_product_id);
            $user_with_fav = Wholesalers::with(['favourites' => function ($query) {
                return $query->with('images');
            }])->find($wholesaler->id);
            return $this->returnData('user', $user_with_fav);
        } catch (\Exception $exception) {
            return $this->returnError('00', $exception->getMessage());
        }

    }

}
