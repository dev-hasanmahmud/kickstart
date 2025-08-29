<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Constants\ListDefaults;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    abstract protected function model(): string;

    protected function resolveModel()
    {
        return app()->make($this->model());
    }

    public function newQuery()
    {
        return $this->model->newQuery();
    }

    public function all(array $columns = ListDefaults::COLUMNS)
    {
        return $this->model->all($columns);
    }

    public function paginate(
        int $perPage = ListDefaults::PER_PAGE, 
        array $columns = ListDefaults::COLUMNS, 
        array $filters = ListDefaults::FILTERS
    ) {
        $query = $this->model->newQuery();

        if (method_exists($this, 'applyFilters')) {
            $query = $this->applyFilters($query, $filters);
        }

        return $query->paginate($perPage, $columns);
    }

    public function find($id, array $columns = ListDefaults::COLUMNS)
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function findBy(array $conditions, array $columns = ListDefaults::COLUMNS)
    {
        return $this->model->where($conditions)->get($columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->find($id);
        $model->update($data);

        return $model;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
