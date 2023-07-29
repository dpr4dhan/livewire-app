<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionModel extends Permission
{
    use HasUuids;

    protected $table = 'permissions';
    protected $fillable = ['name', 'status'];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function scopeActive(Builder $query) :void
    {
        $query->where('status', 1);
    }
}
