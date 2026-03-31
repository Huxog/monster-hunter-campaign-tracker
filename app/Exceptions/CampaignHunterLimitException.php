<?php

namespace App\Exceptions;

use App\Traits\FormatExceptionResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CampaignHunterLimitException extends Exception
{
    use FormatExceptionResponse;

    public function __construct()
    {
        parent::__construct('A campaign cannot have more than 4 hunters.');
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(
            static::formatMessage($this->message, 'HUN-0306-0003'),
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
