<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Constants\ListDefaults;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    protected function model(): string
    {
        return Permission::class;
    }

    public function applyFilters($query, array $filters = ListDefaults::FILTERS) {
        if (!empty($filters['search'])) {
            $query->where(fn($q) => $q
                ->where('name', 'like', "%{$filters['search']}%")
            );
        }

        if (isset($filters['status']) && $filters['status'] !== '') {
            $query->where('status', $filters['status']);
        }

        return $query;
    }
}
