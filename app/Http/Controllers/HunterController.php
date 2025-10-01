<?php

namespace App\Http\Controllers;

use App\Http\Requests\HunterStore;
use App\Http\Requests\HunterUpdate;
use App\Models\Hunter;
use App\Services\HunterService;
use App\Traits\FormatExceptionResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

/**
 * @group Equipments
 *
 * Endpoints for managing hunters
 */
class HunterController extends Controller
{
    use FormatExceptionResponse;

    /**
     * Display a listing of the hunters.
     *
     * @authenticated
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(HunterService::getAll())->setStatusCode(JsonResponse::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created hunter in storage.
     *
     * @authenticated
     */
    public function store(HunterStore $request): JsonResponse
    {
        try {
            return response()->json(HunterService::create($request->validated()))->setStatusCode(JsonResponse::HTTP_CREATED);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified hunter.
     *
     * @authenticated
     */
    public function show(Hunter $hunter): JsonResponse
    {
        try {
            return response()->json(HunterService::getById($hunter->id))->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified hunter in storage.
     *
     * @authenticated
     */
    public function update(HunterUpdate $request, Hunter $hunter): JsonResponse
    {
        try {
            return response()->json(HunterService::update($request->validated(), $hunter->id))->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified hunter from storage.
     *
     * @authenticated
     */
    public function destroy(Hunter $hunter): JsonResponse
    {
        try {
            return response()->json(HunterService::delete($hunter->id))->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
