<div class="card-body">
    <div>
        @include('includes.message')
    </div>
    <div class="flex justify-between">
        <h2 class="card-title">Change Password</h2>
    </div>
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-1 md:grid-cols-2 space-y-2">
            <div>
                <x-input.group label="Old Password" for="old_password" :error="$errors->first('old_password')">
                    <x-input.password wire:model="old_password" id="old_password" placeholder="Enter Old Password" className="max-w-md"/>
                </x-input.group>
            </div>
            <div>
                <x-input.group label="New Password" for="password" :error="$errors->first('password')">
                    <x-input.password wire:model="password" id="password" placeholder="Enter Password" className="max-w-md"/>
                </x-input.group>
            </div>
            <div>
                <x-input.group label="Confirm Password" for="confirm_password" :error="$errors->first('confirm_password')">
                    <x-input.password wire:model="confirm_password" id="confirm_password" placeholder="Enter Password" className="max-w-md"/>
                </x-input.group>
            </div>
            <div></div>
            <div>
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
