@extends('components.layouts.ladning')


@section('content')
    <div class="min-w-full min-h-screen grid place-content-center">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-semibold mb-2">K-Beras</h1>
            <p class=" max-w-[60ch]">
                K-Breas merupakan sebuah sistem yang menggabungkan
                kecerdasan algoritma KNN dan GLCM untuk memisahkan dengan akurat antara beras premium
                dan medium
            </p>
        </div>

        <div class="flex justify-center">
            @livewire('knn-dashboard')
        </div>
    </div>
@endsection
