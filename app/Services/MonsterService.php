<?php

namespace App\Services;

use App\Interfaces\IMonsterRepository;
use App\Interfaces\IMonsterService;
use App\Models\Monster;
use Illuminate\Database\Eloquent\Model;

class MonsterService extends CrudService implements IMonsterService
{
    protected array $defaultRelations = ['materials'];

    public function __construct(IMonsterRepository $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data): Model
    {
        $materialIds = $data['materials'] ?? [];
        unset($data['materials']);

        /** @var Monster $monster */
        $monster = $this->repository->create($data);
        $monster->materials()->sync($materialIds);

        return $monster->load($this->defaultRelations);
    }

    public function update(array $data, string $id): Model
    {
        $materialIds = array_key_exists('materials', $data) ? $data['materials'] : null;
        unset($data['materials']);

        /** @var Monster $monster */
        $monster = parent::update($data, $id);

        if ($materialIds !== null) {
            $monster->materials()->sync($materialIds);
        }

        return $monster->load($this->defaultRelations);
    }
}
