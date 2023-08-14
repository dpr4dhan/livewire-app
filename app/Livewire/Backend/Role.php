<?php

namespace App\Livewire\Backend;

use App\Models\PermissionModel;
use App\Models\RoleHasPermissionModel;
use App\Models\RoleModel;
use App\Models\User as UserModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Role extends Component
{
    use WithPagination, AuthorizesRequests;


    public string $mode = 'create';
    public string $roleId = '';

    public string $title = '';
    public bool $status = false;

    public string $search = '';
    public string $sortColumn = 'name';
    public string $sortOrder = 'asc';

    public array $assignedPermissions = [];

    public Collection $permissions;

    /**
     * Resets Form Modal Fields
     * @return void
     */
    public function resetFormData(): void
    {
        $this->mode = 'create';
        $this->title = $this->status = '';
        $this->assignedPermissions = [];
    }

    /**
     * Store new Role
     * @return void
     * @throws \Exception
     */
    public function store(): void
    {

        $this->validate([
            'title' => 'required|unique:roles,name',
         ]);

        try{
            $role = new RoleModel();
            $role->name = $this->title;
            $role->status = $this->status ? 1 : 0;
            $role->save();

            $this->dispatch('notify-saved', status :true, msg: 'Role created successfully');

        }catch(\Exception $ex){
            Log::error($ex);
            $this->dispatch('notify-error', msg:'Error occurred while saving');
        }
    }

    /**
     * Fetches role and sets form fields
     * @param RoleModel $role
     * @return void
     */
    public function edit(RoleModel $role): void
    {
        $this->title = $role->name;
        $this->status = $role->status;
        $this->roleId = $role->id;
        $this->mode = 'edit';
    }

    /**
     * Updates role detail
     * @param RoleModel $role
     * @return void
     */
    public function update(RoleModel $role) :void
    {
        $this->validate([
            'title' => 'required|unique:roles,name,'.$role->id
        ]);

        try{
            $role->name = $this->title;
            $role->status = $this->status ? 1 : 0;
            $role->save();

            $this->dispatch('notify-saved', status:true, msg:'Role updated successfully');

        }catch(\Exception $ex){
            Log::error($ex);
            $this->dispatch('notify-error', msg:'Error occurred while updating');
        }
    }

    #[On('deleteRole')]
    public function deleteRole(RoleModel $role) :void
    {
        try{
            $role->delete();
            $this->dispatch('notify-success',msg:'Role deleted successfully');
        }catch(\Exception $ex){
            Log::error($ex);
            $this->dispatch('notify-error', msg:'Error occurred while deleting role');
        }
    }

    /**
     * Fetches assigned permission along with not assigned permissions
     * @param RoleModel $role
     * @return void
     */
    public function fetchAssignedPermissions(RoleModel $role) :void
    {
        $this->roleId = $role->id;
        $this->assignedPermissions = $role->permissions->pluck('id')->toArray();
        $this->permissions = PermissionModel::active()->get();
    }

    public function assignPermission(RoleModel $role): void
    {
        try{

            DB::beginTransaction();
            $assignedPermissions = array_map(function($k){
                return PermissionModel::find($k);
            }, $this->assignedPermissions);

            $role->syncPermissions($assignedPermissions);
            DB::commit();
            $this->dispatch('notify-success', msg:'Permission assigned successfully');
        }catch(\Exception $ex){
            dd($ex->getMessage());
            DB::rollBack();
            Log::error($ex);
            $this->dispatch('notify-error', msg:'Error occurred while assigning permissions');
        }
    }

    /**
     * SortBy logic for Listing page
     * @param $field
     * @return void
     */
    public function sortBy($field) :void
    {
        if($this->sortColumn === $field)
        {
            $this->sortOrder = $this->sortOrder == 'asc' ? 'desc' : 'asc';
        }else{
            $this->sortOrder = 'asc';
        }
        $this->sortColumn = $field;

    }

    /**
     * List view page
     * @return View
     */
    public function render(): View
    {
        $this->authorize('view_role_list');
        $roles = RoleModel::when($this->search,  function( Builder $query, string $search){
            return $query->where('name', 'like', '%'.$search.'%');
        })->orderBy($this->sortColumn, $this->sortOrder)->paginate(10);
        return view('livewire.backend.role.list', compact('roles'))->extends('layouts.app');
    }
}
