<div class="card-body">
    <div>
        @include('includes.message')
    </div>
    <div class="flex justify-between">
        <h2 class="card-title">Roles List</h2>
        @can('create_new_role')
        <button class="btn btn-success btn-sm" type="button">
            <label for="roleModal"><i class="fa-solid fa-plus"></i> Create</label>
        </button>
        @endcan
    </div>


    <div class="grid grid-cols-6 gap-4">
        <div class="col-end-10 col-span-2">
            <x-input.group className="w-full max-w-xs" label="" for="search">
                <x-input.text wire:model.live="search" id="search" placeholder="Enter search" className="input-sm"/>
            </x-input.group>
        </div>

    </div>

    <x-table.frame>
        <x-table.head>
            <tr>
                <th>SN</th>
                <x-table.headcell wire:click="sortBy('title')" sort="true" :order="$sortColumn === 'title' ? $sortOrder : null">Title</x-table.headcell>
                <x-table.headcell wire:click="sortBy('description')" sort="true" :order="$sortColumn === 'description' ? $sortOrder : null">Description</x-table.headcell>
                @can('assign_permissions_to_role')
                <th>Assign Permissions</th>
                @endcan
                <x-table.headcell>Actions</x-table.headcell>
            </tr>
        </x-table.head>
        <x-table.body>
            @php $i = 1; @endphp
            @foreach($roles as $role)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $role->name }}</td>
                    <td><span class="text-{{$role->status ? 'success' : 'error'}}">{{ $role->status ? 'Active' : 'Inactive' }}</span></td>
                    @can('assign_permissions_to_role')
                    <td>

                        <button type="button" class="btn btn-primary btn-sm" wire:click="fetchAssignedPermissions('{{ $role->id }}')">
                            <label for="assignPermissionModal">
                                Permissions
                            </label>
                        </button>
                    </td>
                    @endcan
                    <td>
                        <div class="flex gap-1">
                            @can('update_role')
                            <button  class="btn btn-ghost text-primary" >
                                <label for="roleModal" wire:click="edit('{{ $role->id }}')">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </label>
                            </button>
                            @endcan
                            @can('delete_role')
                            <button type="button" class="btn btn-ghost text-red-500" x-data=""
                                    @click="
                                        Swal.fire({
                                          text: 'Do you want to delete ?',
                                          icon: 'warning',
                                          confirmButtonText: 'Delete',
                                          confirmButtonColor: '#ff1260',
                                          showCancelButton: true
                                        }).then(function(evt){
                                            if(evt.isConfirmed){
                                                Livewire.dispatch('deleteRole', {role: '{{ $role->id}}'});
                                            }
                                        });
                                    "
                            >
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach

        </x-table.body>
    </x-table.frame>
    <div class="mt-4">
        {{ $roles->links() }}
    </div>

    @include('livewire.backend.role.form')
    @include('livewire.backend.role.permissions')
</div>
