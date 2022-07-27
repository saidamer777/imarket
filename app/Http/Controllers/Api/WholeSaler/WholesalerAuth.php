<?php

namespace App\Http\Controllers\Api\WholeSaler;

use App\Http\Controllers\Controller;
use App\Models\Wholesalers;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class WholesalerAuth extends Controller
{
    use GeneralTrait;
    //

 public function login(Request $request){
     try {
         if(!$request){
             return $this->returnError('Error','خطأ بعملية تسجيل الدخول ');
         }

        $credintials=$request->only(['phone','password']);

       $token=Auth::guard('wholesaler-api')->attempt($credintials);

         if(!$token)
         {
             return $this->returnError('E000','بيانات الدخول غير صحيحة');

         }
         $wholesaler =  Auth::guard('wholesaler-api')->user();
         $alldata= Wholesalers::with('marketplace')->find($wholesaler->id);
         $alldata ->api_token = $token;
         return $this->returnData('wholesaler',$alldata);
     }catch (\Exception $ex){
        return $this->returnError('Error',$ex->getMessage());
     }

 }

    public function logout(Request $request){
        $token= $request->api_token;
        if($token)
        {
            try {
                JWTAuth::setToken($token)->invalidate();
                return $this->returnSuccessMessage('تم تسجيل الخروج بنجاح');
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $ex)
            {
                return $this->returnError('','خطأ بتسجيل الخروج ');
            }

        }
        else{
            return $this->returnError('E001','خطأ بتسجيل الخروج ');
        }




    }


}
