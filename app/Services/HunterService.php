<?php

namespace App\Services;

use App\Interfaces\IHunterRepository;
use App\Interfaces\IHunterService;
use Illuminate\Database\Eloquent\Model;

/**
 * Hunter service implementation.
 *
 * Inherits CRUD operations from base class.
 * Add Hunter-specific business logic here if needed.
 */
class HunterService extends CrudService implements IHunterService
{
    protected array $defaultRelations = ['campaign', 'helmet', 'vest', 'trousers', 'weapon'];

    public function __construct(IHunterRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Load loot and inventory relations on show only.
     * Avoids loading collection data on index listings.
     */
    public function getById(string $id): Model
    {
        return $this->repository->findOrFail($id, [
            'campaign', 'helmet', 'vest', 'trousers', 'weapon',
            'loot', 'inventoryWeapons', 'inventoryEquipment',
        ]);
    }
}
