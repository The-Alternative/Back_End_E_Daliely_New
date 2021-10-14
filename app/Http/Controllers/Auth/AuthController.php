<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Role;
use App\Models\Admin\TransModel\UserTranslation;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    use GeneralTrait;

    private $userModel;
    private $roleModel;
    private $userTranslation;
    public function __construct(User $userModel , Role $roleModel
        , UserTranslation $userTranslation)
    {
        $this->userModel=$userModel;
        $this->roleModel=$roleModel;
        $this->userTranslation=$userTranslation;
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        try{
             $credentials = $request->only('email', 'password');
            $token = auth()->attempt($credentials);
            if (! $token ) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return $this->respondWithToken($token);
        }catch(\Exception $ex){
            return $this->returnError('400',$ex->getMessage());
        }

    }
    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    public function register(Request $request)
    {
        $user=$this->userModel->create([
            'name' => $request->name,
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
            $this->userTranslation->insert($transUser_arr);
        }
        $token = JWTAuth::fromUser($user);

        return $this->respondWithToken($token);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
