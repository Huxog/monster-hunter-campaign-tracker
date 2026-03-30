<?php

namespace App\Exceptions;

use App\Traits\FormatExceptionResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecipeNotFoundException extends Exception
{
    use FormatExceptionResponse;

    public function __construct(string $craftableId)
    {
        parent::__construct('No recipe found for the requested item.');
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(
            static::formatMessage($this->message, 'HUN-0306-0001'),
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
