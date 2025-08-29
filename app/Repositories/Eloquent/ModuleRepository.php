<?php

namespace App\Repositories\Eloquent;

use App\Models\Module;
use App\Repositories\Contracts\ModuleRepositoryInterface;
use App\Constants\ListDefaults;
use Carbon\Carbon;

class ModuleRepository extends BaseRepository implements ModuleRepositoryInterface
{
    protected function model(): string
    {
        return Module::class;
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
