<?php

namespace App\Traits;

use App\Models\User;
use Error;
use http\Env\Request;
use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

trait GeneralTrait
{

    public function author($perm,$user){
        $roles=$user->roles()->with('Permission')->get();
        foreach ($roles as $role){
             $permission = $role->permission->where('slug',$perm)->first();
        }
        if (isset($permission)) {
            return true;
        } else
            return false;
    }

    public function returnValidationError($code, $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }


    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input)
    {
        if ($input == "name")
            return 'E0011';

        else if ($input == "password")
            return 'E002';

        else if ($input == "mobile")
            return 'E003';

        else if ($input == "id_number")
            return 'E004';

        else if ($input == "birth_date")
            return 'E005';

        else if ($input == "agreement")
            return 'E006';

        else if ($input == "email")
            return 'E007';

        else if ($input == "city_id")
            return 'E008';

        else if ($input == "insurance_company_id")
            return 'E009';

        else if ($input == "activation_code")
            return 'E010';

        else if ($input == "longitude")
            return 'E011';

        else if ($input == "latitude")
            return 'E012';

        else if ($input == "id")
            return 'E013';

        else if ($input == "promocode")
            return 'E014';

        else if ($input == "doctor_id")
            return 'E015';

        else if ($input == "payment_method" || $input == "payment_method_id")
            return 'E016';

        else if ($input == "day_date")
            return 'E017';

        else if ($input == "specification_id")
            return 'E018';

        else if ($input == "importance")
            return 'E019';

        else if ($input == "type")
            return 'E020';

        else if ($input == "message")
            return 'E021';

        else if ($input == "reservation_no")
            return 'E022';

        else if ($input == "reason")
            return 'E023';

        else if ($input == "branch_no")
            return 'E024';

        else if ($input == "name_en")
            return 'E025';

        else if ($input == "name_ar")
            return 'E026';

        else if ($input == "gender")
            return 'E027';

        else if ($input == "nickname_en")
            return 'E028';

        else if ($input == "nickname_ar")
            return 'E029';

        else if ($input == "rate")
            return 'E030';

        else if ($input == "price")
            return 'E031';

        else if ($input == "information_en")
            return 'E032';

        else if ($input == "information_ar")
            return 'E033';

        else if ($input == "street")
            return 'E034';

        else if ($input == "branch_id")
            return 'E035';

        else if ($input == "insurance_companies")
            return 'E036';

        else if ($input == "photo")
            return 'E037';

        else if ($input == "logo")
            return 'E038';

        else if ($input == "working_days")
            return 'E039';

        else if ($input == "insurance_companies")
            return 'E040';

        else if ($input == "reservation_period")
            return 'E041';

        else if ($input == "nationality_id")
            return 'E042';

        else if ($input == "commercial_no")
            return 'E043';

        else if ($input == "nickname_id")
            return 'E044';

        else if ($input == "reservation_id")
            return 'E045';

        else if ($input == "attachments")
            return 'E046';

        else if ($input == "summary")
            return 'E047';

        else if ($input == "user_id")
            return 'E048';

        else if ($input == "mobile_id")
            return 'E049';

        else if ($input == "paid")
            return 'E050';

        else if ($input == "use_insurance")
            return 'E051';

        else if ($input == "doctor_rate")
            return 'E052';

        else if ($input == "provider_rate")
            return 'E053';

        else if ($input == "message_id")
            return 'E054';

        else if ($input == "hide")
            return 'E055';

        else if ($input == "checkoutId")
            return 'E056';

        else
            return "";
    }
	/**
     * @param JsonResource $resource
     * @param null $message
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondWithResource(JsonResource $resource, $message = null, $statusCode = 200, $headers = [])
    {
        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource

        return $this->apiResponse(
            [
                'success' => true,
                'result' => $resource,
                'message' => $message
            ], $statusCode, $headers
        );
    }
    /**
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     * @return array
     */
    public function parseGivenData($data = [], $statusCode = 200, $headers = [])
    {
        $responseStructure = [
            'success' => $data['success'],
            'message' => $data['message'] ?? null,
            'result' => $data['result'] ?? null,
        ];
        if (isset($data['errors'])) {
            $responseStructure['errors'] = $data['errors'];
        }
        if (isset($data['status'])) {
            $statusCode = $data['status'];
        }


        if (isset($data['exception']) && ($data['exception'] instanceof Error || $data['exception'] instanceof Exception)) {
            if (config('app.env') !== 'production') {
                $responseStructure['exception'] = [
                    'message' => $data['exception']->getMessage(),
                    'file' => $data['exception']->getFile(),
                    'line' => $data['exception']->getLine(),
                    'code' => $data['exception']->getCode(),
                    'trace' => $data['exception']->getTrace(),
                ];
            }

            if ($statusCode === 200) {
                $statusCode = 500;
            }
        }
        if ($data['success'] === false) {
            if (isset($data['error_code'])) {
                $responseStructure['error_code'] = $data['error_code'];
            } else {
                $responseStructure['error_code'] = 1;
            }
        }
        return ["content" => $responseStructure, "statusCode" => $statusCode, "headers" => $headers];
    }
    /*
     *
     * Just a wrapper to facilitate abstract
     */
    /**
     * Return generic json response with the given data.
     *
     * @param       $data
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function apiResponse($data = [], $statusCode = 200, $headers = [])
    {
        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource

        $result = $this->parseGivenData($data, $statusCode, $headers);


        return response()->json(
            $result['content'], $result['statusCode'], $result['headers']
        );
    }
    /*
     *
     * Just a wrapper to facilitate abstract
     */
    /**
     * @param ResourceCollection $resourceCollection
     * @param null $message
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondWithResourceCollection(ResourceCollection $resourceCollection, $message = null, $statusCode = 200, $headers = [])
    {

        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource

        return $this->apiResponse(
            [
                'success' => true,
                'result' => $resourceCollection->response()->getData()
            ], $statusCode, $headers
        );
    }
    /**
     * Respond with success.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondSuccess($message = '')
    {
        return $this->apiResponse(['success' => true, 'message' => $message]);
    }
    /**
     * Respond with created.
     *
     * @param $data
     *
     * @return JsonResponse
     */
    protected function respondCreated($data)
    {
        return $this->apiResponse($data, 201);
    }
    /**
     * Respond with no content.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNoContent($message = 'No Content Found')
    {
        return $this->apiResponse(['success' => false, 'message' => $message], 200);
    }
    /**
     * Respond with no content.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNoContentResource($message = 'No Content Found')
    {
        return $this->respondWithResource(new EmptyResource([]), $message);
    }
    /**
     * Respond with no content.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNoContentResourceCollection($message = 'No Content Found')
    {
        return $this->respondWithResourceCollection(new EmptyResourceCollection([]), $message);
    }
    /**
     * Respond with unauthorized.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondUnAuthorized($message = 'Unauthorized')
    {
        return $this->respondError($message, 401);
    }
    /**
     * Respond with error.
     *
     * @param $message
     * @param int $statusCode
     *
     * @param Exception|null $exception
     * @param bool|null $error_code
     * @return JsonResponse
     */
    protected function respondError($message, int $statusCode = 400, Exception $exception = null, int $error_code = 1)
    {

        return $this->apiResponse(
            [
                'success' => false,
                'message' => $message ?? 'There was an internal error, Pls try again later',
                'exception' => $exception,
                'error_code' => $error_code
            ], $statusCode
        );
    }
    /**
     * Respond with forbidden.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondForbidden($message = 'Forbidden')
    {
        return $this->respondError($message, 403);
    }
    /**
     * Respond with not found.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNotFound($message = 'Not Found')
    {
        return $this->respondError($message, 404);
    }
    // /**
    //  * Respond with failed login.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // protected function respondFailedLogin()
    // {
    //     return $this->apiResponse([
    //         'errors' => [
    //             'email or password' => 'is invalid',
    //         ]
    //     ], 422);
    // }
    /**
     * Respond with internal error.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondInternalError($message = 'Internal Error')
    {
        return $this->respondError($message, 500);
    }
    protected function respondValidationErrors(ValidationException $exception)
    {
        return $this->apiResponse(
            [
                'success' => false,
                'message' => $exception->getMessage(),
                'errors' => $exception->errors()
            ],
            422
        );
    }
    public function returnError($stateNum, $msg)
    {
        return response()->json([
            'status' => false,
            'stateNum' => $stateNum,
            'msg' => $msg
        ])->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function returnSuccessMessage($msg, $stateNum )
    {
        return response()->json(
            ['status' => true,
            'stateNum' => $stateNum,
            'msg' => $msg
        ])->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function returnData( $key,$value, $msg )
    {
        return response()->json(
            [
                $key=>$value
                ,'status' => true,
                'stateNum' => '201',
                'msg' => $msg
            ]
        )->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
        }

    public function insert1($model1, $Arr1 )
    {
        $this->model1 = $model1;
        $int = $this->model1::insertGetId($Arr1);
        return $int;
    }
    public function insert2($model1,$model2, $Arr1 ,$values,$values2)
    {
        $this->model2=$model2;
        $id=$this->insert1($model1 , $Arr1 );
        foreach ($values as $value)
            {
                foreach ($values2 as $value2) {
                    $Arr2[] = [
                        $value => $value2
                    ];
                }
            }
        $trans=$this->model2::insert($Arr2 );


//        for ( $i =1 ; $i<count($col);$i++){
//            for($j=0; $j<count($Arr2);$j++){
//
//                $i=$j;
//            }

        //check the category and request
//        if(isset($Arr2) && count($Arr2))
//        {
//            //insert other traslations for products
//            foreach ($Arr2 as $Arr)
//            {
//                $Arr2[]=[
//                    'local'=>$Arr['local'],
//                    'title' =>$Arr['title'],
//                    'store_id'=>$int
//                ];
//            }
//            $this->model2->insert($Arr2);
//        }
        return $this->returnData('Store', $Arr1,'done');
    }

    //trait for handler Exception......//
    public function dataResponse($data): JsonResponse
    {
        return response()->json(['content' => $data], Response::HTTP_OK);
    }

    /**
     * Success Response
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse(string $message, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['success' => $message, 'code' => $code], $code);
    }

    /**
     * Error Response
     * @param $message
     * @param int $code
     * @return JsonResponse
     *
     */
    public function errorResponse($message, $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    public function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}
}

    // protected $statusCode = 200;
	// 	/**
	// 	 * Gets the value of statusCode.
	// 	 *
	// 	 * @return integer
	// 	 */
	// 	public function getStatusCode()
	// 	{
	// 		return $this->statusCode;
	// 	}
	// 	/**
	// 	 * Sets the value of statusCode.
	// 	 *
	// 	 * @param integer $statusCode the status code
	// 	 *
	// 	 * @return self
	// 	 */
	// 	protected function setStatusCode($statusCode)
	// 	{
	// 		$this->statusCode = $statusCode;
	// 		return $this;
	// 	}
	// 	/**
	// 	 * Returns a JSON response
	// 	 *
	// 	 * @param array $data
	// 	 * @param array $headers
	// 	 *
	// 	 * @return JsonResponse
	// 	 */
	// 	public function response($data, $headers = [])
	// 	{
	// 		return new JsonResponse($data, $this->getStatusCode(), $headers);
	// 	}
	// 	/**
	// 	 * Sets an error message and returns a JSON response
	// 	 *
	// 	 * @param string $errors
	// 	 * @param $headers
	// 	 * @return JsonResponse
	// 	 */
	// 	public function respondWithErrors($errors, $headers = [])
	// 	{
	// 		$data = [
	// 			'status' => $this->getStatusCode(),
	// 			'errors' => $errors,
	// 		];
	// 		return new JsonResponse($data, $this->getStatusCode(), $headers);
	// 	}
	// 	/**
	// 	 * Sets an error message and returns a JSON response
	// 	 *
	// 	 * @param string $success
	// 	 * @param $headers
	// 	 * @return JsonResponse
	// 	 */
	// 	public function respondWithSuccess($success, $headers = [])
	// 	{
	// 		$data = [
	// 			'status' => $this->getStatusCode(),
	// 			'success' => $success,
	// 		];
	// 		return new JsonResponse($data, $this->getStatusCode(), $headers);
	// 	}
	// 	/**
	// 	 * Returns a 401 Unauthorized http response
	// 	 *
	// 	 * @param string $message
	// 	 *
	// 	 * @return JsonResponse
	// 	 */
	// 	public function respondUnauthorized($message = 'Not authorized!')
	// 	{
	// 		return $this->setStatusCode(401)->respondWithErrors($message);
	// 	}
	// 	/**
	// 	 * Returns a 422 Unprocessable Entity
	// 	 *
	// 	 * @param string $message
	// 	 *
	// 	 * @return JsonResponse
	// 	 */
	// 	public function respondValidationError($message = 'Validation errors')
	// 	{
	// 		return $this->setStatusCode(422)->respondWithErrors($message);
	// 	}
	// 	/**
	// 	 * Returns a 404 Not Found
	// 	 *
	// 	 * @param string $message
	// 	 *
	// 	 * @return JsonResponse
	// 	 */
	// 	public function respondNotFound($message = 'Not found!')
	// 	{
	// 		return $this->setStatusCode(404)->respondWithErrors($message);
	// 	}
	// 	/**
	// 	 * Returns a 201 Created
	// 	 *
	// 	 * @param array $data
	// 	 *
	// 	 * @return JsonResponse
	// 	 */
	// 	public function respondCreated($data = [])
	// 	{
	// 		return $this->setStatusCode(201)->response($data);
	// 	}
	// 	// this method allows us to accept JSON payloads in POST requests
	// 	// since Symfony 4 doesn’t handle that automatically:
	// 	protected function transformJsonBody(\Symfony\Component\HttpFoundation\Request $request)
	// 	{
	// 		$data = json_decode($request->getContent(), true);
	// 		if ($data === null) {
	// 			return $request;
	// 		}
	// 		$request->request->replace($data);
	// 		return $request;
	// 	}
