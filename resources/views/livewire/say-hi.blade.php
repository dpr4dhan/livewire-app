<div>
{{--    <input wire:model="name" type="text">--}}
   Hy {{$post->title}}: {{now()}}
    <button wire:click="emitFoo">Refresh</button>
</div>
