@props(
    ['title',
      'sort' => false,
      'order'
    ]
)
<th class="cursor-pointer"  {{$attributes}}>
    {{ $slot }}
    @if($sort)
        <label class="swap swap-flip text-xs space-x-2">

            @if($order == 'asc')
                <i class="fa-solid fa-sort-down"></i>
            @elseif($order == 'desc')
                <i class="fa-solid fa-sort-up"></i>
            @endif
        </label>
    @endif
</th>
