<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class EmployeeAuthController extends Controller
{
    use GeneralTrait;
    public function __construct()
    {
        $this->middleware('auth:employees', ['except' => ['login','register']]);
    }
    public function login(Request $request)
    {
        try{
        //validation
//        $rules = [
//            "email"=>"required",
////            "password"=>"required"
//        ];
//        $validator=Validator::make($request->email,$rules) ;
//        if ($validator->fails()){
//            $code = $this->returnCodeAccordingToInput($validator);
//            return $this->returnValidationError($code, $validator);
//        }

//             $credentials = $request->email;
//            $token =Auth::attempt([$credentials]);
//            if (!$token) {
////                return $token;
//                return response()->json(['error' => 'Unauthorized'], 401);
//            }

//            return $this->respondWithToken($token);
//        //login
        $credentials = $request->only(['email', 'password']);

           $token =  auth()->attempt($credentials);

        if (!$token)
            return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

        $employee = Auth::guard('employees')->user();
            $employee->api_token = $token;
        //return token
        return $this->returnData('employee', $employee,'');

        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
            }

    }
}
