<div class="card w-full h-fit bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title">Profile</h2>
        <div>
        </div>
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-2">

                <x-input.group className="w-full max-w-xs" label="Username" for="username" :error="$errors->first('username')">
                    <x-input.text wire:model="username" id="username" placeholder="Enter username"/>
                </x-input.group>
                <x-input.group className="w-full max-w-xs" label="Birthday" for="birthday" :error="$errors->first('birthday')">
                    <x-input.date wire:model="birthday" id="birthday" placeholder="YYYY-MM-DD"/>
                </x-input.group>


            </div>
            <div class="grid grid-cols-1">
                <x-input.group className="w-full" label="About" for="about" :error="$errors->first('about')" help-text="Write about yourself...">
                    <x-input.rich-text wire:model.lazy="about" id="about" placeholder="Write about yourself .." :initialValue="$about "/>
                </x-input.group>

                <x-input.group className="w-2/4 max-w-xs" label="Photo" for="photo" :error="$errors->first('newAvatar')">
                    <x-input.file wire:model="newAvatar" id="newAvatar" className="file-input-primary" :tempFile="$newAvatar"/>

                </x-input.group>

                <x-input.filepond wire:model="newAvatars" id="newAvatars" multiple/>
            </div>


            <div class="card-actions justify-end items-center space-x-3">
                <span
                    x-init="
                            @this.on('notify-saved', () => {
                                open = true;
                                setTimeout(() => {open = false}, 2500);
                            });"
                    x-data="{open: false}"
                    x-show.transition.out.duration.1000ms="open"
                    x-ref="this"
                    style="display: none"
                    class="text-red.
                    -500">
                            Saved !
                </span>
                <a class="btn btn-dark" href="{{route('dashboard')}}">Cancel</a>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>

    </div>
</div>


@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endpush
