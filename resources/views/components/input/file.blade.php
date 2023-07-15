@props(['className' => false])

<input
    type="file"
    class="file-input file-input-bordered w-full max-w-xs {{ $className ?: '' }}"
    {{ $attributes }}
/>
