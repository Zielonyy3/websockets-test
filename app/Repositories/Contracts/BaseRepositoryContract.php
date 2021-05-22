<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryContract
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param Model $model
     * @param array $attributes
     * @return bool
     */
    public function update(Model $model, array $attributes): bool;

    /**
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;

    /**
     * @return Collection
     */
    public function all(): Collection;
}
