@extends('components.layouts.dsahboard')

@section('content')
    <div class="card bg-base-100 shadow-md w-full">
        <div class="card-body px-0 w-full max-w-full overflow-x-hidden">
            @livewire('data-table')
        </div>
    </div>
@endsection
