@props(['placeholder' => false])
<textarea
    class="textarea textarea-bordered"
    @if($placeholder)
        placeholder="{{$placeholder}}"
    @endif
    {{ $attributes }}
></textarea>
