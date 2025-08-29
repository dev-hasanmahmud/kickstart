<?php

namespace App\Services;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Constants\ListDefaults;

class RoleService
{
    public function __construct(protected RoleRepositoryInterface $repo) {}

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function all(array $columns = ListDefaults::COLUMNS)
    {
        return $this->repo->all($columns);
    }

    public function paginate(
        int $perPage = ListDefaults::PER_PAGE, 
        array $columns = ListDefaults::COLUMNS, 
        array $filters = ListDefaults::FILTERS
    ) {
        return $this->repo->paginate($perPage, $columns, $filters)->withQueryString();
    }
}
