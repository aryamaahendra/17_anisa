@props(['label', 'column'])

<th wire:click="sort('{{ $column }}')" {{ $attributes }}>
    <div class="flex items-center space-x-1">
        <div class="">{{ $label }}</div>

        @if ($sortBy === $column)
            @if ($sortDirection === 'asc')
                <x-icons.arrow-down class="h-3 w-3 fill-current" />
            @else
                <x-icons.arrow-up class="h-3 w-3 fill-current" />
            @endif
        @endif
    </div>
</th>
