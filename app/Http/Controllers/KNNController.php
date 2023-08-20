<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessKNN;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KNNController extends Controller
{
    public function index(): View
    {
        return view('knn.index');
    }

    public function process(ProcessKNN $request)
    {
        $id = $request->fulfill();

        return response()->json([
            'error' => false,
            'data' => $id
        ]);
    }
}
