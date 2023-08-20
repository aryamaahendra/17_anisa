@extends('components.layouts.dsahboard')

@section('content')
    <div class="stats shadow w-full">

        <div class="stat">
            <div class="stat-figure text-primary">
                <x-icons.database class="inline-block w-8 h-8 stroke-current" />
            </div>
            <div class="stat-title">Beras Premium</div>
            <div class="stat-value text-primary">{{ $premium }}</div>
            <div class="stat-desc">Split 70:30 train & test</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <x-icons.database class="inline-block w-8 h-8 stroke-current" />
            </div>
            <div class="stat-title">Beras Medium</div>
            <div class="stat-value text-secondary">{{ $medium }}</div>
            <div class="stat-desc">Split 70:30 train & test</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-success">
                <x-icons.percentage class="inline-block w-8 h-8 stroke-current" />
            </div>
            <div class="stat-title">Akurasi</div>
            <div class="stat-value text-success">{{ $test->akurasi * 100 }}</div>
            <div class="stat-desc">highest accuracy with K = {{ $test->k }}</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-info">
                <x-icons.database class="inline-block w-8 h-8 stroke-current" />
            </div>
            <div class="stat-title">History</div>
            <div class="stat-value text-info">{{ $history }}</div>
            <div class="stat-desc">Aug 23</div>
        </div>
    </div>
@endsection
