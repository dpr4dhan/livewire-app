<div class="card w-full h-fit bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title">Profile</h2>
        <div>
        </div>
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-2">

                <x-input.group label="Username" for="username" :error="$errors->first('username')">
                    <x-input.text wire:model="username" id="username" placeholder="Enter username"/>
                </x-input.group>

                <x-input.group label="About" for="about" :error="$errors->first('about')" help-text="Write about yourself...">
                    <x-input.textarea wire:model="about" id="about" placeholder="Write about yourself ..."/>
                </x-input.group>

                <x-input.group label="Photo" for="photo" :error="$errors->first('photo')">
                    <x-input.file wire:model="photo" id="photo" className="file-input-primary"/>
                </x-input.group>



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
                    class="text-red-500">
                            Saved !
                </span>
                <a class="btn btn-dark" href="{{route('dashboard')}}">Cancel</a>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>

    </div>
</div>
