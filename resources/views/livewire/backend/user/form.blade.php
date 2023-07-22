<!-- Modal Content -->
<input type="checkbox" id="userModal" class="modal-toggle"
       x-init="@this.on('notify-saved', (res) => {
       if(res.status){
            notyf.success(res.msg);
       }else{
            notyf.error(res.msg);
       }
        document.getElementById('closeBtn').click();
       })"
/>
<div class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="font-bold text-lg">{{ ucfirst($mode)}} User </h3>
        <form wire:submit.prevent="{{ $mode === 'edit' ? 'updateUser('. $userId.')' : 'storeUser'}}">
            <div class="py-4">
                <div class="flex grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <x-input.group className="w-full" label="Name" for="name" :error="$errors->first('name')">
                            <x-input.text wire:model="name" id="name" placeholder="Enter name"/>
                        </x-input.group>
                    </div>
                    <div>
                        <x-input.group className="w-full" label="Username" for="username" :error="$errors->first('username')">
                            <x-input.text wire:model="username" id="username" placeholder="Enter username"/>
                        </x-input.group>
                    </div>
                    <div>
                        <x-input.group className="w-full" label="Email" for="email" :error="$errors->first('email')">
                            <x-input.text wire:model="email" id="email" placeholder="Enter email"/>
                        </x-input.group>
                    </div>
                    <div>
                        <x-input.group className="w-full" label="Password" for="password" :error="$errors->first('password')">
                            <x-input.password wire:model="password" id="password" placeholder="Enter Password"/>
                        </x-input.group>
                    </div>
                </div>
            </div>
            <div class="modal-action">
                <button class="btn btn-success">Save</button>
                <label for="userModal" id="closeBtn" class="btn" wire:click="resetFormData">Close</label>
            </div>
        </form>

    </div>
</div>
