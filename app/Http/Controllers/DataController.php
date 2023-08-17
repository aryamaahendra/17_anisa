<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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

            Storage::delete('public/' . $data->image);

            DB::commit();
            return redirect()->route('dshb.data.index')->with(
                $this->FlashMessage(false, 'Data berhasil dihapus')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
