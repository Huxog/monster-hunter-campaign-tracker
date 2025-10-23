<?php

namespace App\Services;

use App\Models\Equipment;
use App\Traits\ApiResponse;

class EquipmentService
{
    use ApiResponse;

    /**
     * Function to get all equipments list
     */
    public static function getAll(): array
    {
        return self::arrayResponse(Equipment::all());
    }

    /**
     * Function to get a single equipment by its ID
     *
     * @param  int  $id
     */
    public static function getById($id): array
    {
        return self::arrayResponse(Equipment::findOrFail($id));
    }

    /**
     * Function for creating a new equipment
     *
     * @param  array  $data
     */
    public static function create($data): array
    {
        $newEquipment = Equipment::create($data);

        return self::arrayResponse($newEquipment);
    }

    /**
     * Function for updating an existing equipment using its ID
     *
     * @param  array  $data
     * @param  array  $id
     */
    public static function update($data, $id): array
    {
        $updatedEquipment = Equipment::findOrFail($id);
        $updatedEquipment->update($data);

        return self::arrayResponse($updatedEquipment);
    }

    /**
     * Function for deleting an equipment using its ID
     *
     * @param  array  $id
     */
    public static function delete($id): array
    {
        $deletedEquipment = Equipment::findOrFail($id);
        Equipment::delete($id);

        return self::arrayResponse($deletedEquipment);
    }
}
