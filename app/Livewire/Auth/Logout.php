<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Logout extends Component
{
    public function render()
    {
        if(auth()->user()){
            Session::flush();
            Auth::logout();
            redirect('/login');
        }
        return view('livewire.auth.logout');
    }
}
