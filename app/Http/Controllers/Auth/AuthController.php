<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin\TransModel\UserTranslation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
//use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use JWTAuth;



class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register','login']]);
    }

    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('name', 'email', 'password');
//        $validator = Validator::make($data, [
//            'name' => 'required|string',
//            'email' => 'required|email|unique:users',
//            'password' => 'required|string|min:6|max:50'
//        ]);

        //Send failed response if request is not valid
//        if ($validator->fails()) {
//            return response()->json(['error' => $validator->messages()], 200);
//        }

        //Request is valid, create new user
        DB::beginTransaction();

        $user=User::create([
            'age' => $request->age,
            'location_id' => $request->location_id,
            'social_media_id' => $request->social_media_id,
            'is_active' => $request->is_active,
            'image' => $request->image,
            'email' => $request->email,
            'password' =>bcrypt($request->password)
        ]);
        $userid=$user->id;
        if (isset($allusers) && count($allusers)) {
            //insert other traslations for users
            foreach ($allusers as $alluser) {
                $transUser_arr[] = [
                    'first_name' => $alluser ['first_name'],
                    'last_name' => $alluser ['last_name'],
                    'local' => $alluser['local'],
                    'user_id' => $userid
                ];
            }
            UserTranslation::insert($transUser_arr);
        }
        $token =JWTAuth::fromUser($user);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => [$token,$user]
        ], Response::HTTP_OK);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'email' => 'required|string',
//            'password' => 'required|string',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json($validator->errors(), 422);
//        }
        $credentials = $request->only('email', 'password');
         return $user =User::where([
            'users.email' => $request->email,
            'users.password' => $request->password
        ])->get();

        if (! $credentials ) return response()->json([ 'email' => ['Unauthorized'] ], 401);

        if (! $token = auth('api')->attempt( $credentials ) ) {
            return response()->json([ 'email' => ['Unauthorized'] ], 401);
        }

        return $this->respondWithToken($token);



//        $credentials = $request->only('email', 'password');
//
//        //valid credential
//        $validator = Validator::make($credentials, [
//            'email' => 'required|email',
//            'password' => 'required|string|min:6|max:50'
//        ]);
//
//        //Send failed response if request is not valid
//        if ($validator->fails()) {
//            return response()->json(['error' => $validator->messages()], 200);
//        }
//
//        //Request is validated
//        //Crean token
//        try {
//            if (! $token = auth('api')->attempt($credentials)) {
//                return response()->json([
//                    'success' => false,
//                    'message' => 'Login credentials are invalid.',
//                ], 400);
//            }
//        } catch (JWTException $e) {
////            return $credentials;
//            return response()->json([
//                'success' => false,
//                'message' => 'Could not create token.',
//            ], 500);
//        }


//        $credentials = request(['email', 'password']);
////         bcrypt('password');
//
//        if (! $token = auth('api')->attempt($credentials)) {
//            return response()->json(['error' => 'Unauthorized'], 401);
//        }
//
//        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
