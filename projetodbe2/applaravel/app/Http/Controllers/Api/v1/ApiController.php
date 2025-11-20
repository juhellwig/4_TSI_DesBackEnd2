<?php

namespace App\Http\Controllers\Api\v1;

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
