<?php

namespace App\Repositories;

use App\Interfaces\IQuestRepository;
use App\Models\Quest;

class QuestRepository extends CrudRepository implements IQuestRepository
{
    public function __construct(Quest $model)
    {
        parent::__construct($model);
    }
}
