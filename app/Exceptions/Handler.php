<?php

namespace App\Exceptions;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Throwable;
use Exception;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $exception) {
            //
        });
    }
    // public function render($request, Exception $e)
    // {
    //     // if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
    //     //          // Your stuff here
    //     //     return response()->view('errors.'.$e->getStatusCode(), [], $e->getStatusCode());
    //     // }
    //     // return parent::render($request, $e);
    // }
}