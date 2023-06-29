<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class SayHi extends Component
{

    public Post $post;

    public function mount(Post $post) :void
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.say-hi');
    }
}
