<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceResponse;
use App\Http\Resources\Api\ApiResponse;

class JsonApiResource extends JsonResource
{
    public array | null $errors;
    public int $status;

    public function __construct($resource, $status = 200, $errors = null)
    {
        $this->status = $status;
        $this->errors = $errors;
        parent::__construct($resource);
    }

    public function toResponse($request): JsonResponse
    {
        return (new ApiResponse($this))->toResponse($request)->setStatusCode( $this->status);
    }
}
