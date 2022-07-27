<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Customer;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use Tymon\JWTAuth\Facades\JWTAuth;
use Auth;

class CustomerAuth extends Controller
{
    //
    use GeneralTrait;

    public function register(Request $request)
    {
        try {
            $exist_customer= Customer::where('phone_number',$request->phone_number)->first();
            /// create customer
            ///

            if($exist_customer && $exist_customer->active==1)
            {
                $token = $exist_customer->createToken('api_token', ['can:order']);
                $exist_customer->api_token = $token->plainTextToken;
                return $this->returnData('user', $exist_customer);

            }
            if($exist_customer && $exist_customer->active==0)
            {
                $exist_customer->active=1;
                $exist_customer->save();
                $token = $exist_customer->createToken('api_token', ['can:order']);
                $exist_customer->api_token = $token->plainTextToken;
                return $this->returnData('user', $exist_customer);

            }

            $user = Customer::create(['name' => $request->name,
                'phone_number' => $request->phone_number,
                'verification_code' => $request->verification_code
            ]);


            ///create customer address
            $address = Address::create([
                'region' => $request->region,
                'neighborhood' => $request->neighborhood,
                'lane' => $request->lane,
                'building' => $request->building,
                'floor' => $request->floor,
                'side' => $request->side,
                'details' => $request->details,
                'customer_id' => $user->id
            ]);

//            return $user;
            //// check if user is generated
            if (!$user || !$address) {
                $this->returnError('E444', 'خطأ بعملية تسجيل الدخول');
            }

            /// create token
            $token = $user->createToken('api_token', ['can:order']);


            // get all data customer and his address
            $customerData = Customer::with(['address'=>function($query){return $query->where('active',1);}])->find($user->id);

            //add api token to the response
            $customerData->api_token = $token->plainTextToken;
            return $this->returnData('user', $customerData);

        } catch (\Exception $ex) {

            return $this->returnError('E222', $ex->getMessage());
        }

    }
    public function editaccountwithnumber(Request $request)
    {
        try {
            $token = PersonalAccessToken::findToken($request->api_token);
            try {
                $customer = $token->tokenable;

            }catch (\Exception $exception){
                return  $this->returnError('E444','الرجاء تسجيل الدخول اولا ');
            }

            $customer_data=Customer::where('phone_number',$customer->phone_number)->first();

            if(!$customer_data)
            {
                return  $this->returnError('E444','عذرا هذا المستخدم غير موجود');

            }
            $customer_data->name=$request->name;
            $customer_data->phone_number=$request->phone_number;
            $customer_data->verification_code=$request->verification_code;
            $customer_data->save();
            $token = $customer_data->createToken('api_token', ['can:order']);
            $customer_data->api_token = $token->plainTextToken;

            $address=Address::where(['active'=>1,'customer_id'=>$customer_data->id])->first();

            if(!$address){
                return  $this->returnError('E444','عذرا هذا العنوان غير موجود');

            }
            $address->active=0;
            $address->save();
            $editedAddress=Address::create([
                'region' => $request->region,
                'neighborhood' => $request->neighborhood,
                'lane' => $request->lane,
                'building' => $request->building,
                'floor' => $request->floor,
                'side' => $request->side,
                'details' => $request->details,
                'customer_id' => $customer_data->id
            ]);
            $customer_data->address=$editedAddress;
            return $this->returnData('user', $customer_data);

        } catch (\Exception $ex) {

            return $this->returnError('E222', $ex->getMessage());
        }

    }
    public function editaccountwithoutnumber(Request $request)
    {
        try {
            $token = PersonalAccessToken::findToken($request->api_token);
            try {
                $customer = $token->tokenable;

            }catch (\Exception $exception){
                return  $this->returnError('E444','الرجاء تسجيل الدخول اولا ');
            }

            $customer_data=Customer::where('phone_number',$customer->phone_number)->first();

            if(!$customer_data)
            {
                return  $this->returnError('E444','عذرا هذا المستخدم غير موجود');

            }
            $customer_data->name=$request->name;
            $customer_data->save();
            $token = $customer_data->createToken('api_token', ['can:order']);
            $customer_data->api_token = $token->plainTextToken;

            $address=Address::where(['active'=>1,'customer_id'=>$customer_data->id])->first();

            if(!$address){
                return  $this->returnError('E444','عذرا هذا العنوان غير موجود');

            }
            $address->active=0;
            $address->save();
            $editedAddress=Address::create([
                'region' => $request->region,
                'neighborhood' => $request->neighborhood,
                'lane' => $request->lane,
                'building' => $request->building,
                'floor' => $request->floor,
                'side' => $request->side,
                'details' => $request->details,
                'customer_id' => $customer_data->id
            ]);
            $customer_data->address=$editedAddress;
            return $this->returnData('user', $customer_data);

        } catch (\Exception $ex) {

            return $this->returnError('E222', $ex->getMessage());
        }

    }

    public function logout(Request $request){
        try {
            $token = PersonalAccessToken::findToken($request->api_token);
            $customer = $token->tokenable;
            $token->delete();
            $customer->active=0;
            $customer->save();

            return $this->returnSuccessMessage('تم تسجيل الخروج بنجاح');

        }catch (\Exception $exception)
        {
           return $this->returnError('404',"هذاالمستخدم غير موجود");
        }

    }

    public function edit_account(Request $request){


    }
    public function delete_account(Request $request){
        try {
            $token = PersonalAccessToken::findToken($request->api_token);
            $customer = $token->tokenable;

            if(!$customer)
            {
                return $this->returnError('E000','حدث خطأ أثناء حذف الحساب');
            }

            $token->delete();
            $customer->delete();
            return $this->returnSuccessMessage("تم حذف الحساب بنجاح");
        }catch (\Exception $exception){
            return $this->returnError('',$exception->getMessage());

        }


    }


}
