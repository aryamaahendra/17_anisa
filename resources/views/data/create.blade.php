@extends('components.layouts.dsahboard')

@section('content')
    <div class="card bg-base-100 w-full max-w-2xl mx-auto shadow-md">
        <form action="{{ route('dshb.data.store') }}" method="POST" class="card-body">
            @csrf

            <div x-data="dataFormImgs" class="form-control filepond-2-row w-full">
                <label class="label">
                    <span class="label-text">Gambar</span>
                </label>

                <input x-ref="input" type="file" name="imgs[]" multiple>

                @error('class')
                    <x-form.error-message :message="$message" />
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Class</span>
                </label>

                <select class="select select-bordered" name="class">
                    <option value="premium">Premium</option>
                    <option value="medium">Medium</option>
                </select>

                @error('class')
                    <x-form.error-message :message="$message" />
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Tipe</span>
                </label>

                <select class="select select-bordered" name="type">
                    <option value="train">Data Latih</option>
                    <option value="test">Data Uji</option>
                </select>

                @error('type')
                    <x-form.error-message :message="$message" />
                @enderror
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
