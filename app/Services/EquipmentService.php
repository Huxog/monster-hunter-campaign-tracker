<?php

namespace App\Services;

use App\Models\Equipment;
use App\Traits\ApiResponse;

class EquipmentService
{
    use ApiResponse;
    /**
    * Function description
    * @return array
    */
    public static function getAll(): array
    {
       return self::arrayResponse(Equipment::all());
    }
    /**
    * Function description
    * @param int $id
    * @return array
    */
    public static function getById($id): array
    {
        return self::arrayResponse(Equipment::findOrFail($id));;
    }
    /**
    * Function description
    * @param array $data
    * @return array
    */
    public static function create($data): array
    {
        $newEquipment = Equipment::create($data);

        return self::arrayResponse($newEquipment);;
    }
    /**
    * Function description
    * @param array $data
    * @param array $id
    * @return array
    */
    public static function update($data, $id): array
    {
        $updatedEquipment = Equipment::findOrFail($id);
        $updatedEquipment->update($data);

        return self::arrayResponse($updatedEquipment);;
    }
    /**
    * Function description
    * @param array $id
    * @return array
    */
    public static function delete($id): array
    {
        $deletedEquipment = Equipment::findOrFail($id);
        Equipment::delete($id);

        return self::arrayResponse($deletedEquipment);;
    }
}
