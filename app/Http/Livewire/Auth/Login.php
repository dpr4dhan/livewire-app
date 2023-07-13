<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Config;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $credentials = $this->validate();

        return auth()->attempt($credentials)
            ? redirect()->intended('/')
            : $this->addError('email', trans('auth.failed'));
    }

    public function render()
    {
//        Config::set('livewire.layout', 'layouts.auth');
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
