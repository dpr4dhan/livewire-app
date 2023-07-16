@props([
    'placeholder' => false,
    'initialValue' => ''
    ])
<div wire:ignore
    x-data
    @trix-blur="$dispatch('change', $event.target.value)"
    {{$attributes}}
>
    <input id="x" value="{{ $initialValue }}" type="hidden" name="content">
    <trix-editor input="x"  class="textarea textarea-bordered textarea-lg"></trix-editor>

</div>
