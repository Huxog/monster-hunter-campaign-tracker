<?php

namespace App\Exceptions;

use App\Models\Material;
use App\Traits\FormatExceptionResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InsufficientMaterialsException extends Exception
{
    use FormatExceptionResponse;

    public function __construct(
        private readonly Material $material,
        private readonly int $required,
        private readonly int $held,
    ) {
        parent::__construct('Not enough materials to craft this item.');
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(
            array_merge(
                static::formatMessage($this->message, 'HUN-0306-0002'),
                [
                    'details' => [
                        'materialId' => $this->material->id,
                        'materialName' => $this->material->name,
                        'required' => $this->required,
                        'held' => $this->held,
                    ],
                ]
            ),
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
