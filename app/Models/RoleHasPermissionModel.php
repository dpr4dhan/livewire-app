<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermissionModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'role_has_permissions';

    protected  $fillable = ['role_id', 'permission_id'];
}
