<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponse{

    protected function successResponse($data, $message = null, $statusCode = 200)
	{
        return response([
            'statusCode' => $statusCode,
            'status' => 'Success',
            'message' => $message,
            'data' => $data,
        ])->setStatusCode($statusCode);
	}

	protected function errorResponse( $data = null, $message = null, $statusCode = 500)
	{
		return response()->json([
            'statusCode' => $statusCode,
			'status'=> 'Error',
			'message' => $message,
			'data' => $data,
		])->setStatusCode($statusCode);
	}

}
