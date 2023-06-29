<div>
{{--    <input wire:model="name" type="text">--}}
   Hy {{$post->title}}: {{now()}}
    <button wire:click="$refresh">Refresh</button>
</div>
