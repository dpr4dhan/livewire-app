<div class="card-body">
    <div>
        @include('includes.message')
    </div>
    <div class="flex justify-between">
        <h2 class="card-title">Permissions List</h2>
        <button class="btn btn-success btn-sm" type="button">
            <label for="permissionModal"><i class="fa-solid fa-plus"></i> Create</label>
        </button>
    </div>


    <div class="grid grid-cols-6 gap-4">
        <div class="col-end-10 col-span-2">
            <x-input.group className="w-full max-w-xs" label="" for="search">
                <x-input.text wire:model="search" id="search" placeholder="Enter search" className="input-sm"/>
            </x-input.group>
        </div>

    </div>

    <x-table.frame>
        <x-table.head>
            <tr>
                <th>SN</th>
                <x-table.headcell wire:click="sortBy('title')" sort="true" :order="$sortColumn === 'title' ? $sortOrder : null">Title</x-table.headcell>
                <x-table.headcell wire:click="sortBy('description')" sort="true" :order="$sortColumn === 'description' ? $sortOrder : null">Description</x-table.headcell>
                <x-table.headcell>Actions</x-table.headcell>
            </tr>
        </x-table.head>
        <x-table.body>
            @php $i = 1; @endphp
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $permission->title }}</td>
                    <td>{{ $permission->description }}</td>
                    <td>
                        <div class="flex gap-1">
                            <button  class="btn btn-ghost text-primary" >
                                <label for="permissionModal" wire:click="edit('{{ $permission->id }}')">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </label>
                            </button>
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
                                                Livewire.emit('deletePermission', '{{ $permission->id}}');
                                            }
                                        });
                                    "
                            >
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach

        </x-table.body>
    </x-table.frame>
    <div class="mt-4">
        {{ $permissions->links() }}
    </div>

    @include('livewire.backend.permission.form')
</div>
