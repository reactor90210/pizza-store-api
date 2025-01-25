<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceResponse;

class ApiResponse extends JsonResource
{
    public array | null $errors;
    public int $status;

    public function __construct($resource, $status = 200, $errors = null)
    {
        $this->status = $status;
        $this->errors = $errors;
        parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->resource,
            'status' => $this->status,
            'errors' => $this->errors
        ];
    }

    public function toResponse($request): JsonResponse
    {
        return (new ResourceResponse($this))->toResponse($request)->setStatusCode( $this->status);
    }
}
