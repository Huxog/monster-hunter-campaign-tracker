<?php

namespace App\Exceptions;

use App\Traits\FormatExceptionResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemNotInInventoryException extends Exception
{
    use FormatExceptionResponse;

    public function __construct()
    {
        parent::__construct('The item is not available in your inventory for this slot.');
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(
            static::formatMessage($this->message, 'HUN-0306-0004'),
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
