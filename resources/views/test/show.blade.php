@extends('components.layouts.dsahboard')

@section('content')
    @php
        $kfold = json_decode($test->kfold_data, true);
        // dd($kfold);
    @endphp

    <div class="alert alert-info mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            class="stroke-current  shrink-0 w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>Akuari Rata-Rata: {{ number_format($kfold['accuracy'], 4) * 100 }}%</span>
    </div>

    <div class="card bg-base-100 shadow-md w-full mb-6">
        <div class="card-body p-0 w-full max-w-full overflow-x-hidden">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th class="pl-8 !border">Tipe</th>
                            <th class="!border">Premium</th>
                            <th class="pr-8 !border">Medium</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr>
                            <td class="pl-8 !border">Recall Rata-Rata</td>
                            <td class="!border">
                                {{ number_format($kfold['recall']['premium'], 4) * 100 }}%
                            </td>
                            <td class="!border pr-8">
                                {{ number_format($kfold['recall']['medium'], 4) * 100 }}%
                            </td>
                        </tr>
                        <!-- row 2 -->
                        <tr>
                            <td class="pl-8 !border">Precision Rata-Rata</td>
                            <td class="!border">
                                {{ number_format($kfold['precision']['premium'], 4) * 100 }}%
                            </td>
                            <td class="!border">
                                {{ number_format($kfold['precision']['medium'], 4) * 100 }}%
                            </td>
                        </tr>
                        <!-- row 3 -->
                        <tr>
                            <td class="pl-8 !border">F1 Score Rata-Rata</td>
                            <td class="!border">
                                {{ number_format($kfold['f1score']['premium'], 4) * 100 }}%
                            </td>
                            <td class="!border pr-8">
                                {{ number_format($kfold['f1score']['medium'], 4) * 100 }}%
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        @forelse ($kfold['data'] as $key => $data)
            <div class="card bg-base-100 shadow-md w-full">
                <div class="card-body p-0 w-full max-w-full overflow-x-hidden">
                    <div class="px-6 pt-6 pb-4">
                        <h1>Proses K-{{ $key + 1 }}</h1>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th rowspan="2" colspan="2" class="pl-8 !border"></th>
                                    <th colspan="2" class="pr-8 !border text-center">Origin Class
                                    </th>
                                </tr>
                                <tr>
                                    <th class="!border">Premium</th>
                                    <th class="pr-8 !border">Medium</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr>
                                    <th rowspan="2"
                                        class="pl-8 text-xs !border w-1 text-center font-[700] text-base-content/60">
                                        Predicted Class
                                    </th>
                                    <th class="text-xs !border font-[700] text-base-content/60">
                                        Premium
                                    </th>
                                    <td class="!border">
                                        {{ $data['TP'] }}
                                    </td>
                                    <td class="!border pr-8">
                                        {{ $data['FP'] }}
                                    </td>
                                </tr>
                                <!-- row 2 -->
                                <tr>
                                    <th class="text-xs !border font-[700] text-base-content/60">
                                        Medium
                                    </th>
                                    <td class="!border">
                                        {{ $data['FN'] }}
                                    </td>
                                    <td class="!border">
                                        {{ $data['TN'] }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="overflow-x-auto py-6">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th class="pl-8 !border">Tipe</th>
                                    <th class="!border">Premium</th>
                                    <th class="pr-8 !border">Medium</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr>
                                    <td class="pl-8 !border">Recall Rata-Rata</td>
                                    <td class="!border">
                                        {{ number_format($data['recall']['premium'], 4) * 100 }}%
                                    </td>
                                    <td class="!border pr-8">
                                        {{ number_format($data['recall']['medium'], 4) * 100 }}%
                                    </td>
                                </tr>
                                <!-- row 2 -->
                                <tr>
                                    <td class="pl-8 !border">Precision Rata-Rata</td>
                                    <td class="!border">
                                        {{ number_format($data['precision']['premium'], 4) * 100 }}%
                                    </td>
                                    <td class="!border">
                                        {{ number_format($data['precision']['medium'], 4) * 100 }}%
                                    </td>
                                </tr>
                                <!-- row 3 -->
                                <tr>
                                    <td class="pl-8 !border">F1 Score Rata-Rata</td>
                                    <td class="!border">
                                        {{ number_format($data['f1score']['premium'], 4) * 100 }}%
                                    </td>
                                    <td class="!border pr-8">
                                        {{ number_format($data['f1score']['medium'], 4) * 100 }}%
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        @empty
        @endforelse
    </div>
@endsection
