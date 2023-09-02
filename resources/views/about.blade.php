@extends('components.layouts.ladning')


@section('content')
    <div class="grid place-content-center mt-16">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-semibold mb-2">K-Beras</h1>
            <p class=" max-w-[60ch]">
                K-Breas merupakan sebuah sistem yang menggabungkan
                kecerdasan algoritma KNN dan GLCM untuk memisahkan dengan akurat antara beras premium
                dan medium dengan tingkat akurasi melebihi 70%.
            </p>
        </div>
    </div>

    <div class="mt-12 pb-12 max-w-4xl mx-auto space-y-6">
        <div class="card lg:card-side bg-base-100 shadow-xl">
            <figure class="w-full min-w-[300px]">
                <img src="{{ asset('beras-premium.jpg') }}" class="h-full w-full" alt="Album" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Beras Premium</h2>
                <p>
                    Beras premium tidak boleh memiliki kadar butir gabah sama sekali, benda lain atau
                    benda asing. Benda asing adalah benda-benda selain butiran beras yang terdapat dalam
                    beras
                    seperti butiran batu kecil atau kerikil, sekam atau benda lainnya. Benda asing
                    menunjukkan tingkat pencemaran beras atau tidak bersihnya proses pengolahan beras.
                    Beras tidak boleh tercampur benda asing sama sekali alias 0%. Beras premium memiliki
                    kualitas lebih tinggi dengan derajat sosoh minimal 95%, kadar air maksimal 14% dan
                    butir
                    patah maksimal 15%.
                </p>
            </div>
        </div>

        <div class="card lg:card-side bg-base-100 shadow-xl">
            <figure class="w-full min-w-[300px]">
                <img src="{{ asset('beras-medium.jpg') }}" class="h-full w-full" alt="Album" />
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
@endsection
