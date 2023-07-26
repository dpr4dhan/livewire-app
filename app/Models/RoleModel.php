<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class RoleModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'roles';

    public function assignedPermissions() : Relation
    {
        return $this->belongsToMany(PermissionModel::class, 'role_has_permissions', 'role_id', 'permission_id');
    }

    public function roleHasPermissions(): Relation
    {
        return $this->hasMany(RoleHasPermissionModel::class, 'role_id', 'id');
    }
}
