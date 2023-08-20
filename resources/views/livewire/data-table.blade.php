<div class="">
    <div class="flex items-center justify-between px-6 mb-6">
        <div class="space-x-1">
            <select wire:model.debounce.300="perPage" class="select select-bordered">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>

            <select wire:model.debounce.300="class" class="select select-bordered">
                <option value="">Semua Class</option>
                <option value="premium">Premium</option>
                <option value="medium">Medium</option>
            </select>

            <select wire:model.debounce.300="type" class="select select-bordered">
                <option value="">Semua Tipe</option>
                <option value="train">Data Latih</option>
                <option value="test">Data Uji</option>
            </select>
        </div>

        <div class="">
            <a href="{{ route('dshb.data.create') }}" class="btn btn-primary">
                <x-icons.plus class="w-5 h-5 stroke-current" />
                New Data
            </a>
        </div>
    </div>

    @php
        $rows = $this->data();
    @endphp

    <div class="overflow-x-auto w-full max-w-full">
        <table class="table border-y">
            <!-- head -->
            <thead>
                <tr>
                    <th class="pl-6 w-1">Gambar Original</th>

                    @include('components.table.th-shortable', [
                        'column' => 'original_name',
                        'label' => 'Name',
                    ])

                    @include('components.table.th-shortable', [
                        'column' => 'contrast',
                        'label' => 'Contrast',
                    ])

                    @include('components.table.th-shortable', [
                        'column' => 'energy',
                        'label' => 'Energy',
                    ])

                    @include('components.table.th-shortable', [
                        'column' => 'correlation',
                        'label' => 'Correlation',
                    ])

                    @include('components.table.th-shortable', [
                        'column' => 'homogeneity',
                        'label' => 'Homogeneity',
                    ])

                    @include('components.table.th-shortable', [
                        'column' => 'class',
                        'label' => 'Class',
                    ])

                    @include('components.table.th-shortable', [
                        'column' => 'type',
                        'label' => 'Type',
                    ])

                    <th class="w-1 pr-6">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $data)
                    <tr>
                        <td class="pl-6 w-1">
                            <div class="avatar">
                                <div class="mask rounded-lg w-12 h-12">
                                    <img src="{{ asset('storage/' . $data->original_image) }}"
                                        alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                        </td>

                        <td>
                            {{ $data->original_name }}
                        </td>

                        <td class="w-1">
                            @if (!is_null($data->contrast))
                                {{ number_format($data->contrast, 2, ',') }}
                            @else
                                <span class="loading loading-spinner loading-sm"></span>
                            @endif
                        </td>

                        <td class="w-1">
                            @if (!is_null($data->energy))
                                {{ number_format($data->energy, 6, ',') }}
                            @else
                                <span class="loading loading-spinner loading-sm"></span>
                            @endif
                        </td>

                        <td class="w-1">
                            @if (!is_null($data->correlation))
                                {{ number_format($data->correlation, 2, ',') }}
                            @else
                                <span class="loading loading-spinner loading-sm"></span>
                            @endif
                        </td>

                        <td class="w-1">
                            @if (!is_null($data->homogeneity))
                                {{ number_format($data->homogeneity, 2, ',') }}
                            @else
                                <span class="loading loading-spinner loading-sm"></span>
                            @endif
                        </td>

                        <td class="w-1">
                            <div @class([
                                'badge rounded capitalize',
                                'badge-primary' => $data->class == 'premium',
                                'badge-secondary' => $data->class == 'medium',
                            ])>
                                {{ $data->class }}
                            </div>
                        </td>

                        <td class="w-1">
                            <div @class([
                                'badge rounded capitalize',
                                'badge-success' => $data->type == 'train',
                                'badge-error' => $data->type == 'test',
                            ])>
                                {{ $data->type }}
                            </div>
                        </td>

                        <th class="pr-6">
                            @include('data.partials.column-action')
                        </th>
                    </tr>
                @empty
                @endforelse
            </tbody>

        </table>
    </div>

    @if ($rows->hasPages())
        <div class="p-6">
            {{ $rows->onEachSide(1)->links() }}
        </div>
    @endif
</div>
