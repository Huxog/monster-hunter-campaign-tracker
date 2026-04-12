<?php

namespace App\Repositories;

use App\Interfaces\IMonsterRepository;
use App\Models\Monster;

class MonsterRepository extends CrudRepository implements IMonsterRepository
{
    protected array $filterable = ['stars'];

    public function __construct(Monster $model)
    {
        parent::__construct($model);
    }
}
