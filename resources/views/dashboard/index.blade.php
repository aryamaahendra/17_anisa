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

    <div class="grid max-w-4xl mx-auto grid-cols-2 gap-6">
        <div class="card bg-base-100 shadow-xl">
            <figure class="max-w-full max-h-72">
                <img class="w-full h-full object-cover" src="{{ asset('BP1.jpg') }}" alt="Shoes" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Beras Premium</h2>
                <p>
                    Beras premium adalah beras berkualitas tinggi yang dikenal karena rasanya yang
                    sangat baik, teksturnya yang bagus, dan penampilannya yang menarik. Beras ini
                    ditanam dengan metode yang hati-hati, sehingga menjadi pilihan yang dicari untuk
                    acara istimewa dan makan mewah.
                </p>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
            <figure class="max-w-full max-h-72">
                <img class="w-full h-full object-cover" src="{{ asset('BM1.jpg') }}" alt="Shoes" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Beras Medium</h2>
                <p>
                    Beras medium adalah varietas beras dengan kualitas di antara beras premium. Dengan
                    butiran lebih seragam dan lebih sedikit biji pecah, beras medium memiliki rasa dan
                    tekstur yang baik dengan harga yang lebih terjangkau. Cocok untuk masakan
                    sehari-hari.
                </p>
            </div>
        </div>
    </div>
@endsection
