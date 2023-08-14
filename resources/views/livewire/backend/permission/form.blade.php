<!-- Modal Content -->
<input type="checkbox" id="permissionModal" class="modal-toggle"
       x-init="Livewire.on('notify-saved', (res) => {
            if(res.status){
                notyf.success(res.msg);
            }else{
                notyf.error(res.msg);
            }
            document.getElementById('closeBtn').click();
            })
          "
/>
<div class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="font-bold text-lg">{{ ucfirst($mode)}} Permission </h3>
        <form wire:submit="{{ $mode === 'edit' ? 'update("'. $permissionId.'")' : 'store'}}">
            <div class="py-4">
                <div class="flex grid grid-cols-1 md:grid-cols-2 md:gaps-2">
                    <div>
                        <x-input.group className="w-full" label="Title" for="title" :error="$errors->first('title')">
                            <x-input.text wire:model.live="title" id="title" placeholder="Enter title" className="max-w-md"/>
                        </x-input.group>
                    </div>
                    <div>
                        <x-input.group className="w-full" label="Status" labelClassName="cursor-pointer" for="Status" :error="$errors->first('status')">
                            <x-input.toggle wire:model.live="status" id="status" name="status"/>
                        </x-input.group>
                    </div>

                </div>
            </div>
            <div class="modal-action">
                <button class="btn btn-success">Save</button>
                <label for="permissionModal" id="closeBtn" class="btn" wire:click="resetFormData">Close</label>
            </div>
        </form>

    </div>
</div>
