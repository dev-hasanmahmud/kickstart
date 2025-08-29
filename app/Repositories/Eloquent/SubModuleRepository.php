<?php

namespace App\Repositories\Eloquent;

use App\Models\SubModule;
use App\Repositories\Contracts\SubModuleRepositoryInterface;
use App\Constants\ListDefaults;
use Carbon\Carbon;

class SubModuleRepository extends BaseRepository implements SubModuleRepositoryInterface
{
    protected function model(): string
    {
        return SubModule::class;
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
