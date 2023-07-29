<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\Permission\Models\Role;

class RoleModel extends Role
{
    use HasFactory, HasUuids;
    protected $table = 'roles';
    protected $fillable = ['name', 'status'];
    protected $keyType = 'string';
    public $incrementing = false;

//    public function assignedPermissions() : Relation
//    {
//        return $this->belongsToMany(PermissionModel::class, 'role_has_permissions', 'role_id', 'permission_id');
//    }
//
//    public function roleHasPermissions(): Relation
//    {
//        return $this->hasMany(RoleHasPermissionModel::class, 'role_id', 'id');
//    }
}
