<?php

namespace App\Http\Controllers;

use App\Actions\KFold;
use App\Http\Requests\ProcessTest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestController extends Controller
{
    public function index(): View
    {
        return view('test.index');
    }

    public function process(ProcessTest $request): RedirectResponse
    {
        $akurasi = $request->fulfill();

        return redirect()->route('dshb.test.index')->with(
            $this->FlashMessage(false, 'Pengujian telah ditambahkan di antrian')
        );
    }

    function show(Request $request): View
    {
        return view('test.show', ['test' => $request->route('test')]);
    }
}
