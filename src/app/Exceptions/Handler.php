<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;
use App\Http\Resources\Api\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    public function render($request, Throwable $e): ApiResponse | Response
    {
        if ($request->expectsJson()) {
            if($e instanceof NotFoundHttpException) {
                return new ApiResponse(null, 404, ['message' => $e->getMessage()]);
            }
            elseif ($e instanceof ValidationException){
                return new ApiResponse(null, 422, $e->errors());
            }
            else {
                return new ApiResponse(null, 500, ['message' => 'Internal server error']);
            }
        }

        return parent::render($request, $e);
    }
}
