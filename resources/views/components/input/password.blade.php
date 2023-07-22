@props([
    'leadingAddOn' =>false,
    'placeholder' => false,
    'className'
    ])
@if($leadingAddOn)
    <div class="join">
        <div class="btn join-item">
            {{$leadingAddOn}}
        </div>
@endif
    <input
        type="password"
        class="input input-bordered w-full max-w-xs {{ $leadingAddOn ? 'join-item' : '' }} {{ $className ?? ''}}"
        @if($placeholder)
            placeholder="{{$placeholder}}"
        @endif
        {{ $attributes }}
    />
@if($leadingAddOn)
    </div>
@endif
