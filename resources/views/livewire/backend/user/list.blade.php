<div class="card-body">

    <div class="flex justify-between">
        <h2 class="card-title">User List</h2>
        <button class="btn btn-success btn-sm" type="button"><label for="userModal"><i class="fa-solid fa-plus"></i> Create</label></button>
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
            <tr >
                <th>SN</th>
                <x-table.headcell wire:click="sortBy('name')" sort="true" :order="$sortColumn === 'name' ? $sortOrder : null">Name</x-table.headcell>
                <x-table.headcell wire:click="sortBy('item')" sort="true" :order="$sortColumn === 'item' ? $sortOrder : null">Email</x-table.headcell>
                <x-table.headcell wire:click="sortBy('quantity')" sort="true" :order="$sortColumn === 'quantity' ? $sortOrder : null">Username</x-table.headcell>
                <x-table.headcell wire:click="sortBy('amount')" sort="true" :order="$sortColumn === 'amount' ? $sortOrder : null">Avatar</x-table.headcell>
                <x-table.headcell >Actions</x-table.headcell>
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
                </tr>
            @endforeach

        </x-table.body>
    </x-table.frame>
    <div class="mt-4">
        {{ $users->links() }}
    </div>

    <!-- Modal Content -->
    <input type="checkbox" id="userModal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg">Create User</h3>
            <form wire:submit.prevent="createUser">
                <div class="py-4">
                    <div class="grid grid-cols-2">
                        <div>
                            <x-input.group className="w-full max-w-xs" label="Name" for="name" :error="$errors->first('name')">
                                <x-input.text wire:model="name" id="name" placeholder="Enter name"/>
                            </x-input.group>
                        </div>
                        <div>
                            <x-input.group className="w-full max-w-xs" label="Username" for="username" :error="$errors->first('username')">
                                <x-input.text wire:model="username" id="username" placeholder="Enter username"/>
                            </x-input.group>
                        </div>
                        <div>
                            <x-input.group className="w-full max-w-xs" label="Email" for="email" :error="$errors->first('email')">
                                <x-input.text wire:model="email" id="email" placeholder="Enter email"/>
                            </x-input.group>
                        </div>
                    </div>
                </div>
                <div class="modal-action">
                    <button class="btn btn-success">Save</button>
                    <label for="userModal" class="btn">Close!</label>
                </div>
            </form>

        </div>
    </div>
</div>
