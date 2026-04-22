<?php

namespace App\Interfaces;

use App\Models\Hunter;
use App\Models\Material;
use Illuminate\Database\Eloquent\Model;

/**
 * Hunter-specific service interface.
 *
 * Extends generic CRUD operations and can define Hunter-specific methods.
 *
 * @extends ICrudService<Hunter>
 */
interface IHunterService extends ICrudService
{
    public function craft(Hunter $hunter, string $craftableType, string $craftableId): Model;

    public function getCraftables(Hunter $hunter): array;

    public function addLoot(Hunter $hunter, string $materialId, int $quantity): Hunter;

    public function decreaseLoot(Hunter $hunter, Material $material, int $quantity): Hunter;

    public function removeLoot(Hunter $hunter, Material $material): Hunter;

    public function equip(Hunter $hunter, string $slot, string $equippableId): Hunter;
}
