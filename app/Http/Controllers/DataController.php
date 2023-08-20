<?php

namespace App\Http\Controllers;

use App\Actions\GLCM;
use App\Actions\KNN;
use App\Http\Requests\CreateData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class DataController extends Controller
{
    public function index(): View
    {
        return view('data.index');
    }

    public function create(): View
    {
        return view('data.create');
    }

    public function store(CreateData $request)
    {
        $request->fulfill();

        return redirect()->route('dshb.data.index')->with(
            $this->FlashMessage(false, 'Data berhasil disimpan')
        );
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->route('data');
            $data->delete();

            Storage::delete('public/' . $data->original_image);

            DB::commit();
            return redirect()->route('dshb.data.index')->with(
                $this->FlashMessage(false, 'Data berhasil dihapus')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function glcm(Request $request)
    {
        $data = $request->route('data');

        $knn = new KNN();
        dd($knn->predict($data, 3));
    }
}
