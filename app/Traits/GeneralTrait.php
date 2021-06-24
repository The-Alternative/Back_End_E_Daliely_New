<?php

namespace App\Traits;

use Error;
use http\Env\Request;
use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

trait GeneralTrait
{
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
        ]);
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
    }
    public function returnSuccessMessage($msg, $stateNum )
    {
        return response()->json(
            ['status' => true,
            'stateNum' => $stateNum,
            'msg' => $msg
        ]);
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
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
        );
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
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
