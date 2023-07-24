<?php

namespace App\Http\Livewire\Backend;

use App\Models\PermissionModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Permission extends Component
{
    use WithPagination;

    protected $listeners = ['deletePermission' => 'delete'];

    public string $mode = 'create';
    public string $permissionId = '';

    public string $title = '';
    public string $description = '';

    public string $search = '';
    public string $sortColumn = 'title';
    public string $sortOrder = 'asc';

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
            $permission = new PermissionModel();
            $permission->title = $this->title;
            $permission->description = $this->description;
            $permission->save();

            $this->emitSelf('notify-saved', ['status' => true, 'msg' => 'Permission created successfully']);

        }catch(\Exception $ex){
            Log::error($ex);
            $this->emit('notify-error', 'Error occurred while saving');
        }
    }

    /**
     * Fetches permission and sets form fields
     * @param PermissionModel $permission
     * @return void
     */
    public function edit(PermissionModel $permission): void
    {
        $this->title = $permission->title;
        $this->description = $permission->description;
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
            $permission->title = $this->title;
            $permission->description = $this->description;
            $permission->save();

            $this->emitSelf('notify-saved', ['status' => true, 'msg' => 'Permission updated successfully']);

        }catch(\Exception $ex){
            Log::error($ex);
            $this->emit('notify-error', 'Error occurred while updating');
        }
    }

    public function delete(PermissionModel $permission) :void
    {
        try{
            $permission->delete();
            $this->emit('notify-success','Permission deleted successfully');
        }catch(\Exception $ex){
            Log::error($ex);
            $this->emit('notify-error', 'Error occurred while deleting permission');
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

        $permissions = PermissionModel::when($this->search,  function( Builder $query, string $search){
            return $query->where('title', 'like', '%'.$search.'%');
        })->orderBy($this->sortColumn, $this->sortOrder)->paginate(10);
        return view('livewire.backend.permission.list', compact('permissions'))->extends('layouts.app');
    }
}
