@props([
    'leadingAddOn' =>false,
    'placeholder' => false
    ])
@if($leadingAddOn)
    <div class="join">
        <div class="btn join-item">
            {{$leadingAddOn}}
        </div>
@endif
    <input
        type="text"
        class="input input-bordered w-full max-w-xs {{ $leadingAddOn ? 'join-item' : '' }}"
        @if($placeholder)
            placeholder="{{$placeholder}}"
        @endif
        {{ $attributes }}
    />
@if($leadingAddOn)
    </div>
@endif
