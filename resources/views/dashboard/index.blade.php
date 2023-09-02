@extends('components.layouts.dsahboard')

@section('content')
    <div class="stats shadow w-full mb-6">
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

    <div class="grid mx-auto grid-cols-2">
        <div class="flex justify-center">
            <div class="card bg-base-100 shadow-xl max-w-md">
                <figure class="max-w-full max-h-72">
                    <img class="w-full h-full object-cover" src="{{ asset('beras-premium.jpg') }}"
                        alt="Shoes" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Beras Premium</h2>
                    <p>
                        Beras premium tidak boleh memiliki kadar butir gabah sama sekali, benda lain
                        atau
                        benda asing. Benda asing adalah benda-benda selain butiran beras yang terdapat
                        dalam
                        beras seperti butiran batu kecil atau kerikil, sekam atau benda lainnya. Benda
                        asing
                        menunjukkan tingkat pencemaran beras atau tidak bersihnya proses pengolahan
                        beras.
                        Beras tidak boleh tercampur benda asing sama sekali alias 0%. Beras premium
                        memiliki
                        kualitas lebih tinggi dengan derajat sosoh minimal 95%, kadar air maksimal 14%
                        dan
                        butir patah maksimal 15%.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="card bg-base-100 shadow-xl max-w-md">
                <figure class="max-w-full max-h-72">
                    <img class="w-full h-full object-cover" src="{{ asset('beras-medium.jpg') }}"
                        alt="Shoes" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Beras Medium</h2>
                    <p>
                        Beras medium kadar butir gabahnya adalah maksimal 1 butir/100 gram dan boleh
                        memiliki kadar benda lain maksimal 0,05 persen. Beras medium memiliki
                        spesifikasi
                        derajat sosoh minimal 95%, kadar air maksimal 14% dan butir patah maksimal 25%
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
