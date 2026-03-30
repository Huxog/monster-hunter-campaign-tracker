<?php

namespace App\Services;

use App\Interfaces\IMaterialRepository;
use App\Interfaces\IMaterialService;
use Illuminate\Database\Eloquent\Model;

/**
 * Material service implementation.
 */
class MaterialService extends CrudService implements IMaterialService
{
    public function __construct(IMaterialRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Load hunters, weapons, and equipment relations on show only.
     * Avoids loading nested data on index listings.
     */
    public function getById(string $id): Model
    {
        return $this->repository->findOrFail($id, ['hunters', 'weapons', 'equipment', 'monsters']);
    }
}
