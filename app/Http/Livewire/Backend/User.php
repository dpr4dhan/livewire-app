<?php

namespace App\Http\Livewire\Backend;

use App\Models\Transaction as TransactionModel;
use App\Models\User as UserModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;

    public string $name = '';
    public string $username = '';
    public string $email = '';

    public string $search = '';
    public string $sortColumn = 'name';
    public string $sortOrder = 'asc';


    public function createUser()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required|max:25',
            'email' => 'required|email',
        ]);
    }


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

    public function render(): View
    {
        $users = UserModel::when($this->search,  function( Builder $query, string $search){
        return $query->where('name', 'like', '%'.$search.'%');
        })->orderBy($this->sortColumn, $this->sortOrder)->paginate(10);
        return view('livewire.backend.user.list', compact('users'))->extends('layouts.app');
    }
}
