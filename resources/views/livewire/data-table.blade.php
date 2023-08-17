<div>
    <div class="flex items-center justify-between px-6 mb-6">
        <div class="">
            <select wire:model.debounce.300="perPage" class="select select-bordered">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
        </div>

        <div class="">
            <a href="{{ route('dshb.data.create') }}" class="btn btn-primary">
                <x-icons.plus class="w-5 h-5 stroke-current" />
                Primary
            </a>
        </div>
    </div>

    @php
        $rows = $this->data();
    @endphp

    <div class="overflow-x-auto">
        <table class="table border-y">
            <!-- head -->
            <thead>
                <tr>
                    <th class="pl-6">Gambar Original</th>
                    <th>Nama File</th>
                    <th>Class</th>
                    <th class="w-1 pr-6">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $data)
                    <tr>
                        <td class="pl-6">
                            <div class="avatar">
                                <div class="mask rounded-lg w-12 h-12">
                                    <img src="{{ asset('storage/' . $data->image) }}"
                                        alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                        </td>

                        <td>
                            {{ $data->original_name }}
                        </td>

                        <td>
                            <div @class([
                                'badge rounded',
                                'badge-primary' => $data->class == 'premium',
                                'badge-secondary' => $data->class == 'medium',
                            ])>
                                {{ $data->class }}
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
