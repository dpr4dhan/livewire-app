<?php

namespace App\Http\Livewire\Backend;

use App\Models\PermissionModel;
use App\Models\RoleModel;
use App\Models\User as UserModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Role extends Component
{
    use WithPagination;

    protected $listeners = ['deleteRole' => 'deleteRole'];

    public string $mode = 'create';
    public string $roleId = '';

    public string $title = '';
    public string $description = '';

    public string $search = '';
    public string $sortColumn = 'title';
    public string $sortOrder = 'asc';

    public Collection $permissions;

    /**
     * Resets Form Modal Fields
     * @return void
     */
    public function resetFormData(): void
    {
        $this->mode = 'create';
        $this->title = $this->description = '';
    }

    /**
     * Store new Role
     * @return void
     * @throws \Exception
     */
    public function store(): void
    {

        $this->validate([
            'title' => 'required',
         ]);

        try{
            $role = new RoleModel();
            $role->title = $this->title;
            $role->description = $this->description;
            $role->save();

            $this->emitSelf('notify-saved', ['status' => true, 'msg' => 'Role created successfully']);

        }catch(\Exception $ex){
            Log::error($ex);
            $this->emit('notify-error', 'Error occurred while saving');
        }
    }

    /**
     * Fetches role and sets form fields
     * @param RoleModel $role
     * @return void
     */
    public function edit(RoleModel $role): void
    {
        $this->title = $role->title;
        $this->description = $role->description;
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
            'title' => 'required'
        ]);

        try{
            $role->title = $this->title;
            $role->description = $this->description;
            $role->save();

            $this->emitSelf('notify-saved', ['status' => true, 'msg' => 'Role updated successfully']);

        }catch(\Exception $ex){
            Log::error($ex);
            $this->emit('notify-error', 'Error occurred while updating');
        }
    }

    public function deleteRole(RoleModel $role) :void
    {
        try{
            $role->delete();
            $this->emit('notify-success','Role deleted successfully');
        }catch(\Exception $ex){
            Log::error($ex);
            $this->emit('notify-error', 'Error occurred while deleting role');
        }
    }


    public function fetchAssignedPermissions() :void
    {
        $this->permissions = PermissionModel::get();
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

        $roles = RoleModel::when($this->search,  function( Builder $query, string $search){
            return $query->where('title', 'like', '%'.$search.'%');
        })->orderBy($this->sortColumn, $this->sortOrder)->paginate(10);
        return view('livewire.backend.role.list', compact('roles'))->extends('layouts.app');
    }
}
