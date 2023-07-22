<?php

namespace App\Http\Livewire\Backend;

use App\Models\Transaction as TransactionModel;
use App\Models\User as UserModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;

    protected $listeners = ['deleteUser' => 'deleteUser'];

    public string $mode = 'create';
    public string $userId = '';

    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';

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
        $this->name = $this->username = $this->password = $this->email = $this->userId = '';
    }

    /**
     * Store new User
     * @return void
     * @throws \Exception
     */
    public function storeUser(): void
    {

        $this->validate([
            'name' => 'required',
            'username' => 'required|max:25|unique:users,username|alpha_num:ascii',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::min(8)->mixedCase()],
        ]);

        try{
            $user = new UserModel();
            $user->name = $this->name;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->password = Hash::make($this->password);
            $user->save();

            $this->emitSelf('notify-saved', ['status' => true, 'msg' => 'User created successfully']);

        }catch(\Exception $ex){
            Log::error($ex);
            $this->emit('notify-error', 'Error occurred while saving');
        }
    }

    /**
     * Fetches user and sets form fields
     * @param UserModel $user
     * @return void
     */
    public function editUser(UserModel $user): void
    {
        $this->username = $user->username;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->userId = $user->id;
        $this->mode = 'edit';
    }

    /**
     * Updates user detail
     * @param UserModel $user
     * @return void
     */
    public function updateUser(UserModel $user) :void
    {
        $this->validate([
            'name' => 'required',
            'username' => ['required', 'min:5', 'max:25', Rule::unique('users', 'username')->ignore($user), 'alpha_num:ascii'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
        ]);

        try{
            $user->name = $this->name;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->save();

            $this->emitSelf('notify-saved', ['status' => true, 'msg' => 'User updated successfully']);

        }catch(\Exception $ex){
            Log::error($ex);
            $this->emit('notify-error', 'Error occurred while updating');
        }
    }

    public function deleteUser(UserModel $user) :void
    {
        try{
            $user->delete();
            $this->emit('notify-success','User deleted successfully');
        }catch(\Exception $ex){
            Log::error($ex);
            $this->emit('notify-error', 'Error occurred while deleting user');
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
        $users = UserModel::when($this->search,  function( Builder $query, string $search){
        return $query->where('name', 'like', '%'.$search.'%');
        })->orderBy($this->sortColumn, $this->sortOrder)->paginate(10);

        $formMode = $this->mode;
        $userId = $this->userId;
        return view('livewire.backend.user.list', compact('users'))->extends('layouts.app');
    }
}
