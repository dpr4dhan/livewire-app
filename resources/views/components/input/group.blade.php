@props([
    'label',
    'for',
    'error' => false,
    'helpText' => false,
    'className' => false,
    'labelClassName' => false
])

<div class="form-control {{ $className ?: '' }}">
    <label class="label {{ $labelClassName ?: '' }}" for="{{ $for }}">
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
