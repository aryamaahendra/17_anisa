@extends('components.layouts.dsahboard')

@section('content')
    @if ($errors->any())
        <div class="alert alert-error mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Error! {{ $errors->all()[0] }}</span>
        </div>
    @endif

    <div class="card bg-base-100 shadow-md w-full">
        <div class="card-body px-0 w-full max-w-full overflow-x-hidden">
            @livewire('testing-table')
        </div>
    </div>
@endsection
