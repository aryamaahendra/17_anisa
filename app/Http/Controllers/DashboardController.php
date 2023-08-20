<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\History;
use App\Models\Testing;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', [
            'premium' => Data::where('class', 'premium')->count(),
            'medium' => Data::where('class', 'medium')->count(),
            'test' => Testing::where('isSet', true)->first(),
            'history' => History::count(),
        ]);
    }
}
