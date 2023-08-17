<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilepondRevert extends FormRequest implements Fulfillable
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [];
    }

    public function fulfill()
    {
        $folder = $this->getContent();
        $folder = Str::of($folder)->replace('"', '');

        if (Storage::directoryExists('filepond/' . $folder)) {
            Storage::deleteDirectory('filepond/' . $folder);
        } else {
            abort(404);
        }

        return true;
    }
}
