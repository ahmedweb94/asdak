<?php
namespace App\Repository;

abstract class Repository implements BaseRepository
{
    public function __call($method, $arguments)
    {
        return $this->model->{$method}(...$arguments);
    }
    public function getAll()
    {
        return $this->model->all();
    }
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }
    public function getByIdWithoutScope($id)
    {
        return $this->model->withoutGlobalScopes()->findOrFail($id);
    }
    public function update($id, array $attributes)
    {
        return tap($this->getById($id), function ($record) use ($attributes) {
            $record->update($attributes);
        });
    }

    public function updateWithoutScope($id, array $attributes)
    {
        return tap($this->getByIdWithoutScope($id), function ($record) use ($attributes) {
            $record->update($attributes);
        });
    }
    public function delete($id)
    {
        return $this->getByIdWithoutScope($id)->delete();
    }
}
