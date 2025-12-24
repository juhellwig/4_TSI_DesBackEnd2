<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ExceptionJsonResponse extends Exception
{
    public function render(Request $request): JsonResponse
    {
        $previous = $this->getPrevious();
        $statusHttp = $this->getCode() ?: 500;

        $responseError = [
            'message' => $this->getMessage(),
        ];

        if (env('APP_DEBUG') && $previous) {
            $responseError['exception'] = get_class($previous);
            $responseError['error'] = $previous->getMessage();
            $responseError['trace'] = $previous->getTrace();
        }

        return response()
            ->json($responseError, $statusHttp);
    }
}
