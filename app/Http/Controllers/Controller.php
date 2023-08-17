<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function flashMessage(bool $error, string $msg): array
    {
        return [
            'flash-messages' => [
                'error' => $error,
                'message' => $msg
            ]
        ];
    }
}
