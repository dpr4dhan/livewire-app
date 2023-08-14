<div>
{{--    <input wire:model.live="name" type="text">--}}
   Hy {{$post->title}}: {{now()}}
    <button wire:click="emitFoo">Refresh</button>
</div>
