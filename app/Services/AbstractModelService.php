<?php

namespace App\Services;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModelService
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->setModel($model);
    }

    /**
     * Model attribute setter
     *
     * @param Model $model
     */
    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    /**
     * Returns entry by id
     *
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function find(int $id): Model|Collection|Builder|array|null
    {
       return $this->model->query()->find($id);
    }
}
