<?php

namespace App\Repositories\Contracts;

use App\Constants\ListDefaults;

interface BaseRepositoryInterface
{
    public function all(array $columns = ListDefaults::COLUMNS);
    public function paginate(
        int $perPage = ListDefaults::PER_PAGE,
        array $columns = ListDefaults::COLUMNS,
        array $filters = ListDefaults::FILTERS
    );
    public function find(int|string $id, array $columns = ListDefaults::COLUMNS);
    public function findBy(array $conditions, array $columns = ListDefaults::COLUMNS);
    public function create(array $data);
    public function update(int|string $id, array $data);
    public function delete(int|string $id);
}
