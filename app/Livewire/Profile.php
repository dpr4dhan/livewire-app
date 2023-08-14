<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public string $username = '';
    public ?string $about = '';
    public ?string $birthday = '';
    public $newAvatar;
    public $newAvatars = [];


    //lifecycle hook
    public function mount() :void
    {
        $this->username = auth()->user()->username;
        $this->about = auth()->user()->about;
        $this->birthday = auth()->user()->birthday;
    }

    /**
     * updated{propertyName}
     * @return void
     */
    public function updatedNewAvatar() :void
    {
        $this->validate(['newAvatar' => 'image|max:2000']);
    }
    //lifecycle hook

    public function save() :void
    {
        $profileData = $this->validate([
            'username' => 'required|max:24',
            'about' => 'max:140',
            'birthday' => 'date|date_format:Y-m-d',
            'newAvatar' => 'image|max:2000'
        ]);
        $filename = $this->newAvatar->store('/', 'avatars');
        auth()->user()->update(
            [
                'username' => $this->username,
                'about' => $this->about,
                'birthday' => $this->birthday,
                'avatar' => $filename,
            ]
        );
//        $this->dispatchBrowserEvent('notify', 'Profile updated successfully!');
//        session()->flash('notify-saved');
        $this->emitSelf('notify-saved');
    }

    public function render() :View
    {
        return view('livewire.profile')->extends('layouts.app');
    }
}
