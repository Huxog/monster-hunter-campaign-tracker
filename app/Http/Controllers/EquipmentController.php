<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentStore;
use App\Http\Requests\EquipmentUpdate;
use App\Models\Equipment;
use App\Traits\FormatExceptionResponse;

/**
 * @group Equipments
 *
 * Endpoints for managing equipments
 */
class EquipmentController extends Controller
{
    use FormatExceptionResponse;

    /**
     * Display a listing of the equipments.
     *
     * @authenticated
     */
    public function index()
    {
        try {
            return response()->json(Equipment::getAll())->setStatusCode(JsonResponse::HTTP_OK);
        } catch (\Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))
                ->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created equipment in storage.
     *
     * @authenticated
     */
    public function store(EquipmentStore $request): JsonResponse
    {
        try {
            return response()->json(Equipment::create($request->validated()))
                ->setStatusCode(JsonResponse::HTTP_CREATED);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))
                ->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified equipment.
     *
     * @authenticated
     */
    public function show(Equipment $equipment): JsonResponse
    {
        try {
            return response()->json(Equipment::getById($equipment->id))
                ->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))
                ->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))
                ->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified equipment in storage.
     *
     * @authenticated
     */
    public function update(EquipmentUpdate $request, Equipment $equipment): JsonResponse
    {
        try {
            return response()->json(Equipment::update($request->validated(), $equipment->id))
                ->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))
                ->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))
                ->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified equipment from storage.
     *
     * @authenticated
     */
    public function destroy(Equipment $equipment): JsonResponse
    {
        try {
            return response()->json(Equipment::delete($equipment->id))
                ->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))
                ->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))
                ->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
