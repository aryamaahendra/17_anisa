@extends('components.layouts.ladning')


@section('content')
    <div class="grid place-content-center mt-16">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-semibold mb-2">Jenis - Jenis Beras</h1>
            <p class=" max-w-[60ch]">
                Berikut adalah jeni-jenis beras yang umum ditemukan di pasar - pasar tradisional
                indonesia.
            </p>
        </div>
    </div>

    <div class="mt-12 pb-12 max-w-4xl mx-auto space-y-6">
        <div class="card lg:card-side bg-base-100 shadow-xl">
            <figure class="w-full max-w-[300px]">
                <img src="{{ asset('beras-pandan-wangi-2.jpg') }}" style="width: 300px; height:300px;"
                    alt="Album" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Beras Pandan Wangi</h2>
                <p>
                    Beras pandan wangi memiliki bentuk biji cenderung bulat, bening dan sedikit
                    kekuningan. Beras jenis ini jadi salah satu beras paling populer di Indonesia
                    terutama yang menyukai aroma yang ditimbulkan yakni aroma pandan.
                </p>
            </div>
        </div>

        <div class="card lg:card-side bg-base-100 shadow-xl">
            <figure class="w-full max-w-[300px]">
                <img src="{{ asset('mentik_wangi.jpg') }}" style="width: 300px; height:300px;"
                    alt="Album" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Beras Mentik Wangi</h2>
                <p>
                    Rojolele juga jadi salah satu beras paling disukai oleh masyarakat. Beras jenis ini
                    memiliki sebutan lain yakni beras Muncul. Bentuk biji cenderung bulat, terdapat
                    sedikit bagian yang berwarna putih susu.
                </p>
            </div>
        </div>

        <div class="card lg:card-side bg-base-100 shadow-xl">
            <figure class="w-full max-w-[300px]">
                <img src="{{ asset('beras_c4.jpg') }}" style="width: 300px; height:300px;"
                    alt="Album" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Beras C4</h2>
                <p>
                    Untuk jenis beras C4 ini bentuk fisik memiliki kesamaan hampir seperti beras IR 42
                    namun sedikit lebih bulat dan jika dimasak nasinya cenderung lebih pulen.
                </p>
            </div>
        </div>

        <div class="card lg:card-side bg-base-100 shadow-xl">
            <figure class="w-full max-w-[300px]">
                <img src="{{ asset('BERAS_IR_42_PERA.jpg') }}" style="width: 300px; height:300px;"
                    alt="Album" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Beras IR 42 Pera</h2>
                <p>
                    Beras IR 42 ini mempunyai kemiripan dengan jenis beras IR 64, namun dengan ukuran
                    sedikit lebih kecil. Apabila dimasak teksturnya biji beras IR 42 lebih cenderung
                    tidak pulen atau pera.
                </p>
            </div>
        </div>

        <div class="card lg:card-side bg-base-100 shadow-xl">
            <figure class="w-full max-w-[300px]">
                <img src="{{ asset('BERAS_IR_64.jpg') }}" style="width: 300px; height:300px;"
                    alt="Album" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Beras IR 62</h2>
                <p>
                    Beras IR 64 mempunyai nama lain beras Bengawan atau ada juga yang menyebutnya beras
                    Sentra Ramos. Bentuk biji beras IR 64 agak lonjong atau panjang, tidak beraroma
                    wangi.
                </p>
            </div>
        </div>

        <div class="card lg:card-side bg-base-100 shadow-xl">
            <figure class="w-full max-w-[300px]">
                <img src="{{ asset('Beras_Rojolele_5Kg_Super_Premium.jpg') }}" class="h-full w-full"
                    alt="Album" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Beras Rojolele</h2>
                <p>
                    Rojolele juga jadi salah satu beras paling disukai oleh masyarakat. Beras jenis ini
                    memiliki sebutan lain yakni beras Muncul. Bentuk biji cenderung bulat, terdapat
                    sedikit bagian yang berwarna putih susu.
                </p>
            </div>
        </div>
    </div>
@endsection
