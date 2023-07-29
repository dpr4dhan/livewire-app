<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//        'username',
//        'about'
//    ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatarUrl() :string
    {
        return $this->avatar
            ? Storage::disk('avatars')->url($this->avatar)
            : 'https://www.gravatar.com/avatar/'.md5(trim($this->email));

    }

//    public function assignedRoles() :Relation
//    {
//        return $this->belongsToMany(RoleModel::class, 'user_has_roles', 'user_id', 'role_id');
//    }
//
//    public function userHasRoles() :Relation
//    {
//        return $this->hasMany(UserHasRoleModel::class, 'user_id', 'id');
//    }
//
//    public function hasPermission(string $permission) :bool
//    {
//        $roles = $this->assignedRoles;
//        foreach($roles as $role)
//        {
//            $rolePermission = $role->assignedPermissions()->where('title', $permission)->first();
//            if($rolePermission){
//               return true;
//            }
//        }
//        return false;
//    }
}
