<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public string $username = '';
    public string $about = '';

    //lifecycle hook
    public function mount() :void
    {
        $this->username = auth()->user()->username;
        $this->about = auth()->user()->about;
    }

    //lifecycle hook

    public function save() :void
    {
        $profileData = $this->validate([
            'username' => 'required|max:24',
            'about' => 'max:140',
//            'photo' => 'max:2000'
        ]);
        auth()->user()->update($profileData);
//        $this->dispatchBrowserEvent('notify', 'Profile updated successfully!');
//        session()->flash('notify-saved');
        $this->emitSelf('notify-saved');
    }

    public function render() :View
    {
        return view('livewire.profile')->extends('layouts.app');
    }
}
