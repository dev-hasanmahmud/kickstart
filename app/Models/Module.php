<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];
    
    public function subModules()
    {
        return $this->hasMany(SubModule::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
