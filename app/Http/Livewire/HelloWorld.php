<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;

class HelloWorld extends Component
{

    public $posts;

    public function mount($name) :void
    {
        $this->posts = Post::all();
    }
//
//    public function hydrate() :void
//    {
//        $this->name = 'Hydrated !';
//    }
//
//    public function updated() :void
//    {
//        $this->name = strtoupper($this->name );
//    }

    public function removeContact(Post $post) :void
    {
        $post->delete();
        $this->posts = Post::all();
    }

    public function render() : View
    {
        return view('livewire.hello-world');
    }
}
