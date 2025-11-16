<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Exceptions\ExceptionJsonResponse;

class ApiController
{
    protected function errorHandler(string $message, Exception $error, int $statusCode){
        throw new ExceptionJsonResponse(
            message: $message,
            previous: $error,
            code: $statusCode,
        );
    }
}
