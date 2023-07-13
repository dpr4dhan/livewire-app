<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use http\Env\Response;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function updatedEmail()
    {
        $this->validate(['email' => 'email|unique:users']);
    }

    public function updatedPassword()
    {
        $this->validate(['password' => 'min:6']);
    }

    public function register()
    {
        $data = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:confirmPassword',
        ]);

       $user = User::create([
            'name' => $data['name'],
            'email' =>  $data['email'],
            'password'=> Hash::make($data['password'])
        ]);

       auth()->login($user);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
