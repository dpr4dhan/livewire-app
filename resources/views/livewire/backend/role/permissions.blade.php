<!-- Modal Content -->
<input type="checkbox" id="assignPermissionModal" class="modal-toggle"
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
    <div class="modal-box">
        <h3 class="font-bold text-lg">Assign Permissions </h3>
        <form wire:submit.prevent="updatePermission">
            <div class="py-4">
                <ul>
                    @if(!empty($permissions))
                    @foreach($permissions as $permission)
                        <li>
                            <label class="cursor-pointer label">
                                <span class="label-text">{{$permission->title}}</span>
                                <input type="checkbox" checked="checked" class="checkbox checkbox-info" value="{{ $permission->id }}"/>
                            </label>
                        </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="modal-action">
                <button class="btn btn-success">Save</button>
                <label for="assignPermissionModal" id="closePermissionBtn" class="btn" wire:click="resetFormData">Close</label>
            </div>
        </form>

    </div>
</div>
