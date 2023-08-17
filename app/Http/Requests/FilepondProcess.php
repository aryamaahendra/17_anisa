<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class FilepondProcess extends FormRequest implements Fulfillable
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
        $model = $this->query('m');
        $rules = [];

        if ($model == 'data') {
            $rules = [
                'imgs' => ['required', 'array', 'min:1'],
                'imgs.*' => ['required', 'file'],
            ];
        }

        return $rules;
    }

    public function fulfill()
    {
        $model = $this->query('m');

        switch ($model) {
            case 'data':
                return $this->handleFile($this->file('imgs')[0]);
                break;

            default:
                abort(400);
                break;
        }
    }

    protected function handleFile($file)
    {
        $folder = Str::orderedUuid()->toString();
        $filename = $file->getClientOriginalName();

        $file->storeAs('filepond/' . $folder, $filename);

        return $folder;
    }
}
