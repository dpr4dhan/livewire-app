@props([
    'placeholder' => false
    ])
<div class="join"
    x-data
    x-init="
                new Pikaday({
                    field: $refs.dateInput,
                    format: 'YYYY-MM-DD'
                })
            "

>
    <div class="btn join-item">
        <i class="fa-solid fa-calendar text-gray-500"></i>
    </div>
    <input
        @change="$dispatch('input', $event.target.value)"
        x-ref="dateInput"
        type="text"
        class="input input-bordered w-full max-w-xs join-item"
        @if($placeholder)
            placeholder="{{$placeholder}}"
        @endif
        {{ $attributes }}
    />
</div>
