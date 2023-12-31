@props([
    'className' => false,
    'tempFile' => false
    ])
<div class="flex space-x-3">
    <input
        type="file"
        class="file-input file-input-bordered {{ $className ?: '' }}"
        {{ $attributes }}
    />
    <div class="avatar w-2/4  max-w-xs">
        <div class="w-12 rounded-full">
            @if($tempFile)
                <img src="{{ $tempFile->temporaryUrl() }}" alt="Profile Photo"/>
            @else
                <img src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo"/>
            @endif
        </div>
    </div>

</div>
