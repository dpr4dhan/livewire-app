<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Profile extends Component
{
    public string $username = '';
    public string $about = '';

    public function save()
    {
        $profileData = $this->validate([
            'username' => 'required|max:24',
            'about' => 'max:140'
        ]);

        auth()->user()->update($profileData);
    }

    public function render() :View
    {
        return view('livewire.profile')->extends('layouts.app');
    }
}
