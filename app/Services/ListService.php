<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\{
    Role,
    Module,
    SubModule,
};

class ListService
{
    public function __construct() {}

    public function statusList()
    {
        return Status::options();
    }

    public function roleList()
    {
        return Role::select('id', 'name')->where('status', 1)->get();
    }

    public function moduleList()
    {
        return Module::select('id', 'name')->where('status', 1)->get();
    }

    public function subModuleList()
    {
        return SubModule::select('id', 'name')->where('status', 1)->get();
    }

    public function moduleWithSubmoduleList()
    {
        return Module::with(['subModules.permissions'])->where('status', 1)->get();
    }
}
