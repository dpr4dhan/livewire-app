<div class="card-body">
    <h2 class="card-title">Transaction List</h2>
    <div class="right-end-px">
        <x-input.group className="w-full max-w-xs" label="" for="search">
            <x-input.text wire:model="search" id="search" placeholder="Enter search"/>
        </x-input.group>
    </div>

    <x-table.frame>
        <x-table.head>
            <tr >
                <th>SN</th>
                <x-table.headcell wire:click="sortBy('name')" sort="true" :order="$sortColumn === 'name' ? $sortOrder : null">Customer Name</x-table.headcell>
                <x-table.headcell wire:click="sortBy('item')" sort="true" :order="$sortColumn === 'item' ? $sortOrder : null">Item</x-table.headcell>
                <x-table.headcell wire:click="sortBy('quantity')" sort="true" :order="$sortColumn === 'quantity' ? $sortOrder : null">Quantity</x-table.headcell>
                <x-table.headcell wire:click="sortBy('amount')" sort="true" :order="$sortColumn === 'amount' ? $sortOrder : null">Amount</x-table.headcell>
            </tr>
        </x-table.head>
        <x-table.body>
            @php $i = 1; @endphp
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $transaction->name }}</td>
                    <td>{{ $transaction->item }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->amount }}</td>
                </tr>
            @endforeach

        </x-table.body>
    </x-table.frame>
    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
</div>
