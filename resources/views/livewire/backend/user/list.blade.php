<div class="card-body">
    <div>
        @include('includes.message')
    </div>
    <div class="flex justify-between">
        <h2 class="card-title">User List</h2>
        <button class="btn btn-success btn-sm" type="button">
            <label for="userModal"><i class="fa-solid fa-plus"></i> Create</label>
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
                <x-table.headcell wire:click="sortBy('name')" sort="true" :order="$sortColumn === 'name' ? $sortOrder : null">Name</x-table.headcell>
                <x-table.headcell wire:click="sortBy('email')" sort="true" :order="$sortColumn === 'email' ? $sortOrder : null">Email</x-table.headcell>
                <x-table.headcell wire:click="sortBy('username')" sort="true" :order="$sortColumn === 'username' ? $sortOrder : null">Username</x-table.headcell>
                <x-table.headcell>Avatar</x-table.headcell>
                <x-table.headcell>Actions</x-table.headcell>
            </tr>
        </x-table.head>
        <x-table.body>
            @php $i = 1; @endphp
            @foreach($users as $user)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        <div class="avatar">
                            <div class="w-10 rounded-full">
                                <img src="{{ $user->avatarUrl() }}" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="flex justify-center gap-1">
                            <button  class="btn btn-ghost text-primary" >
                                <label for="userModal" wire:click="editUser({{ $user->id }})">
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
                                                Livewire.emit('deleteUser', {{ $user->id}});
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
        {{ $users->links() }}
    </div>

    @include('livewire.backend.user.form')
</div>
