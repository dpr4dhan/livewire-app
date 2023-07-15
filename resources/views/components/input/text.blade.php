@props(['placeholder' => false])
<input
    type="text"
    class="input input-bordered w-full max-w-xs"
    @if($placeholder)
        placeholder="{{$placeholder}}"
    @endif
    {{ $attributes }}
/>
