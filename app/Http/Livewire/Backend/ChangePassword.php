<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class ChangePassword extends Component
{

    public string $old_password;
    public string $password;
    public string $confirm_password;

    public function save(): void
    {
        $this->validate([
            'old_password' => ['required'],
            'password' => ['required', 'same:confirm_password', Password::min(8)->mixedCase()],
            'confirm_password' => ['required', Password::min(8)->mixedCase()],
        ]);

        try{
            $checkPassword = Hash::check($this->old_password, auth()->user()->password);
            if($checkPassword){
                $user = auth()->user();
                $user->update(
                    ['password' => Hash::make($this->password)]
                );
                $user->refresh();
                $this->emit('notify-success', 'Password updated successfully');
            }else{
                $this->emit('notify-error', 'Old Password didnot match');
            }

        }catch(Exception $ex){
            Log::error($ex);
            $this->emit('notify-error', 'Error occurred while saving');

        }
    }

    public function render()
    {
        return view('livewire.backend.user.change-password')->extends('layouts.app');
    }
}
