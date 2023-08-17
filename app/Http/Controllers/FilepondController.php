<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilepondProcess;
use App\Http\Requests\FilepondRevert;
use Illuminate\Http\Request;

class FilepondController extends Controller
{
    public function process(FilepondProcess $request)
    {
        $file = $request->fulfill();

        return response($file);
    }

    public function revert(FilepondRevert $request)
    {
        $file = $request->fulfill();

        return response()->noContent();
    }
}
