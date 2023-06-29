<div>
    @foreach($posts as $post)
        <div>

            @livewire('say-hi', ['post' => $post], key($post->id))
            <button wire:click="removeContact('{{ $post->id }}')">Remove</button>
        </div>
    @endforeach
        <hr>
        <button wire:click="$refresh">Refresh</button>
        {{ now() }}
</div>
