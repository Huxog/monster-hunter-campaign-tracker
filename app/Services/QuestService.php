<?php

namespace App\Services;

use App\Interfaces\IQuestRepository;
use App\Interfaces\IQuestService;
use App\Models\Quest;
use Illuminate\Database\Eloquent\Model;

class QuestService extends CrudService implements IQuestService
{
    protected array $defaultRelations = ['campaign', 'monster', 'hunters'];

    public function __construct(IQuestRepository $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data): Model
    {
        $hunterIds = $data['hunterIds'] ?? [];
        unset($data['hunterIds']);

        /** @var Quest $quest */
        $quest = $this->repository->create($data);
        $quest->hunters()->sync($hunterIds);

        return $quest->load($this->defaultRelations);
    }

    public function update(array $data, string $id): Model
    {
        $hunterIds = array_key_exists('hunterIds', $data) ? $data['hunterIds'] : null;
        unset($data['hunterIds']);

        /** @var Quest $quest */
        $quest = parent::update($data, $id);

        if ($hunterIds !== null) {
            $quest->hunters()->sync($hunterIds);
        }

        return $quest->load($this->defaultRelations);
    }
}
