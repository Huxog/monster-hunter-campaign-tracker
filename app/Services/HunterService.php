<?php

namespace App\Services;

use App\Models\Hunter;
use App\Traits\ApiResponse;

class HunterService
{
    use ApiResponse;
    /**
    * Function description
    * @return array
    */
    public static function getAll(): array
    {
       return self::arrayResponse(Hunter::with('campaign')->get());
    }
    /**
    * Function description
    * @param int $id
    * @return array
    */
    public static function getById($id): array
    {
       return self::arrayResponse(Hunter::with('campaign')->findOrFail($id));
    }
    /**
    * Function description
    * @param array $data
    * @return array
    */
    public static function create($data): array
    {
        $newHunter = Hunter::create($data);
        return self::arrayResponse($newHunter);
    }
    /**
    * Function description
    * @param array $data
    * @param array $id
    * @return array
    */
    public static function update($data, $id): array
    {
        $updatedHunter = Hunter::findOrFail($id);
        $updatedHunter = Hunter::update($data);
        return self::arrayResponse($updatedHunter);
    }
    /**
    * Function description
    * @param array $id
    * @return array
    */
    public static function delete($id): array
    {
        $deletedHunter = Hunter::findOrFail($id);
        Hunter::delete($id);
        return self::arrayResponse($deletedHunter);
    }
}
