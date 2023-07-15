@props([
    'label',
    'for',
    'error' => false,
    'helpText' => false
])

<div class="form-control w-full max-w-xs">
    <label class="label" for="{{ $for }}">
        <span class="label-text">{{ $label }}</span>
    </label>
    {{ $slot }}

    @if($helpText)
    <label class="label">
        <span class="label-text-alt">{{ $helpText }}</span>
    </label>
    @endif
    @if($error)
        <span class="text-red-600">{{$error}}</span>
    @endif
</div>
