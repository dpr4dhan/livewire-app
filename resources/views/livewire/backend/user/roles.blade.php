<!-- Modal Content -->
<input type="checkbox" id="assignRoleModal" class="modal-toggle"/>
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Assign Roles </h3>
        <form wire:submit="assignRoles('{{ $userId }}')">
            <div class="py-4">
                <ul>
                    @if(!empty($roles))
                    @foreach($roles as $role)
                        <li>
                            <label class="cursor-pointer label">
                                <span class="label-text">{{$role->name}}</span>
                                <input wire:model.live="assignedRoles" type="checkbox"   class="checkbox checkbox-info" value="{{ $role->id }}"/>
                            </label>
                        </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="modal-action">
                <button class="btn btn-success">Save</button>
                <label for="assignRoleModal" id="closeRoleBtn" class="btn" wire:click="resetFormData">Close</label>
            </div>
        </form>

    </div>
</div>
