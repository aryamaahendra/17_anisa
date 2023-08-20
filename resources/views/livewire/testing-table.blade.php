<div class="">
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
            <form action="{{ route('dshb.test.process') }}" method="POST" class="join">
                @csrf

                <input name="k" value="{{ old('k') }}"
                    class="input input-bordered join-item max-w-[150px]" placeholder="Nilai K" />

                @error('k')
                    <x-form.error-message :message="$message" />
                @enderror

                <button type="submit" class="btn btn-primary join-item rounded-r-full">
                    Proces
                </button>
            </form>
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
                    <th class="pl-6">Code</th>
                    @include('components.table.th-shortable', [
                        'column' => 'k',
                        'label' => 'Nilai K',
                    ])

                    @include('components.table.th-shortable', [
                        'column' => 'akurasi',
                        'label' => 'Akurasi',
                    ])

                    @include('components.table.th-shortable', [
                        'column' => 'time',
                        'label' => 'Waktu',
                    ])

                    @include('components.table.th-shortable', [
                        'column' => 'created_at',
                        'label' => 'Dibuat',
                    ])

                    <th class="pr-6">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $data)
                    <tr wire:key="testing-{{ Str::random() }}">
                        <td class="pl-6 whitespace-nowrap">
                            {{ $data->uuid }}
                        </td>

                        <td class="w-1">
                            {{ $data->k }}
                        </td>

                        <td class="w-1">
                            @if (is_null($data->akurasi))
                                <span class="loading loading-spinner loading-sm"></span>
                            @else
                                {{ $data->akurasi * 100 }}%
                            @endif
                        </td>

                        <td class="w-1">
                            @if (is_null($data->time))
                                <span class="loading loading-spinner loading-sm"></span>
                            @else
                                {{ $data->time }}ms
                            @endif
                        </td>

                        <td class="whitespace-nowrap w-1">
                            {{ Carbon\Carbon::create($data->created_at)->diffForHumans() }}
                        </td>

                        <td class="pr-6 w-1">
                            @if ($data->isSet)
                                <div class="tooltip tooltip-left" data-tip="Current K">
                                    <button type="button"
                                        class="btn btn-square btn-sm btn-ghost text-success">
                                        <x-icons.circle-check-filled
                                            class="w-5 h-5 stroke-current" />
                                    </button>
                                </div>
                            @else
                                <div class="tooltip tooltip-left" data-tip="Set as K">
                                    <button type="button" wire:click="setAsK({{ $data->id }})"
                                        class="btn btn-square btn-sm btn-ghost">
                                        <x-icons.circle-check class="w-5 h-5 stroke-current" />
                                    </button>
                                </div>
                            @endif
                        </td>
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