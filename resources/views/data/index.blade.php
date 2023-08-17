@extends('components.layouts.dsahboard')

@section('content')
    <div class="card bg-base-100 shadow-md">
        <div class="card-body px-0">
            @livewire('data-table')
        </div>
    </div>
@endsection
