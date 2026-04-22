<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait SyncsMaterials
{
    public function create(array $data): Model
    {
        $materials = $data['materials'] ?? [];
        unset($data['materials']);

        $model = $this->repository->create($data);

        $model->materials()->sync(
            collect($materials)->mapWithKeys(fn ($m) => [$m['id'] => ['quantity' => $m['quantity']]])
        );

        return $model->load($this->defaultRelations);
    }

    public function update(array $data, string $id): Model
    {
        $materials = array_key_exists('materials', $data) ? $data['materials'] : null;
        unset($data['materials']);

        $model = parent::update($data, $id);

        if ($materials !== null) {
            $model->materials()->sync(
                collect($materials)->mapWithKeys(fn ($m) => [$m['id'] => ['quantity' => $m['quantity']]])
            );
        }

        return $model->load($this->defaultRelations);
    }
}
