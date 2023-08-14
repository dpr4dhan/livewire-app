<?php

namespace App\Livewire\Backend;

use App\Models\PermissionModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Guard;

class Permission extends Component
{
    use WithPagination, AuthorizesRequests;


    public string $mode = 'create';
    public string $permissionId = '';

    public string $title = '';
    public bool $status = false;

    public string $search = '';
    public string $sortColumn = 'name';
    public string $sortOrder = 'asc';

    /**
     * Resets Form Modal Fields
     * @return void
     */
    public function resetFormData(): void
    {
        $this->mode = 'create';
        $this->title = $this->status = '';
    }

    /**
     * Store new Permission
     * @return void
     * @throws \Exception
     */
    public function store(): void
    {

        $this->validate([
            'title' => 'required',
        ]);

        try{
            PermissionModel::create(
                [
                    'name' => $this->title,
                    'status' => $this->status ? 1 : 0,
                ]
            );

            $this->dispatch('notify-saved', status: true, msg: 'Permission created successfully');

        }catch(\Exception $ex){
            Log::error($ex);
            $this->dispatch('notify-error', msg:'Error occurred while saving');
        }
    }

    /**
     * Fetches permission and sets form fields
     * @param PermissionModel $permission
     * @return void
     */
    public function edit(PermissionModel $permission): void
    {
        $this->title = $permission->name;
        $this->status = $permission->status;
        $this->permissionId = $permission->id;
        $this->mode = 'edit';
    }

    /**
     * Updates permission detail
     * @param PermissionModel $permission
     * @return void
     */
    public function update(PermissionModel $permission) :void
    {
        $this->validate([
            'title' => 'required'
        ]);

        try{
            $permission->name = $this->title;
            $permission->status = $this->status ?  1 : 0;
            $permission->save();

            $this->dispatch('notify-saved', status: true, msg: 'Permission updated successfully');

        }catch(\Exception $ex){
            Log::error($ex);
            $this->dispatch('notify-error', msg: 'Error occurred while updating');
        }
    }

    #[On('deletePermission')]
    public function delete(PermissionModel $permission) :void
    {
        try{
            $permission->delete();
            $this->dispatch('notify-success',msg: 'Permission deleted successfully');
        }catch(\Exception $ex){
            Log::error($ex);
            $this->dispatch('notify-error', msg: 'Error occurred while deleting permission');
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
        $this->authorize('view_permission_list');
        $permissions = PermissionModel::when($this->search,  function( Builder $query, string $search){
            return $query->where('name', 'like', '%'.$search.'%');
        })->orderBy($this->sortColumn, $this->sortOrder)->paginate(10);
        return view('livewire.backend.permission.list', compact('permissions'))->extends('layouts.app');
    }
}
