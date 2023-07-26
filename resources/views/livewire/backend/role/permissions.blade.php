<!-- Modal Content -->
<input type="checkbox" id="assignPermissionModal" class="modal-toggle"/>
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Assign Permissions </h3>
        <form wire:submit.prevent="assignPermission('{{ $roleId }}')">
            <div class="py-4">
                <ul>
                    @if(!empty($permissions))
                    @foreach($permissions as $permission)
                        <li>
                            <label class="cursor-pointer label">
                                <span class="label-text">{{$permission->title}}</span>
                                <input wire:model="assignedPermissions" type="checkbox"   class="checkbox checkbox-info" value="{{ $permission->id }}"/>
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
