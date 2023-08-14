<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class SayHi extends Component
{

    public Post $post;

    protected $listeners = ['foo' => '$refresh'];


    public function  emitFoo(){
        $this->emitUp('foo');
    }

    public function mount(Post $post) :void
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.say-hi');
    }
}
