<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model::all();
    }

    public function create($input)
    {
        $model = $this->model;
        $model->fill($input);
        $model->save();
    }
}