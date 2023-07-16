@props([
    'className' => false,
    'tempFile' => false
    ])
<div class="flex space-x-3">
    <input
        type="file"
        class="file-input file-input-bordered {{ $className ?: '' }}"
        {{ $attributes }}
        multiple
    />
    @if($tempFile)
    @foreach($tempFile as $file)
    <div class="avatar max-w-xs">
        <div class="w-12 rounded-full">
                <img src="{{ $file->temporaryUrl() }}" alt="Profile Photo"/>
         </div>
    </div>
    @endforeach
    @endif

</div>
