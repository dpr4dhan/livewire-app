<div>
    @foreach($posts as $post)
        <div>

            @livewire('say-hi', ['post' => $post], key($post->id))
            <button wire:click="removeContact('{{ $post->id }}')">Remove</button>
        </div>
    @endforeach
        <hr>
        {{ now() }}
        <button wire:click="$emit('refreshChildren')">Refresh Children</button>
</div>
