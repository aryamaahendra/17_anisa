<?php

namespace App\Http\Requests;

use App\Jobs\ProcessKNN as JobsProcessKNN;
use App\Models\History;
use App\Models\Testing;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProcessKNN extends FormRequest implements Fulfillable
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
        return [
            'image' => ['required', 'file']
        ];
    }

    public function fulfill()
    {
        try {
            $test = Testing::where('isSet', true)->first();
            DB::beginTransaction();

            $file = $this->validated('image');
            $path = $file->store('public/history');

            $model = new History();
            $model->uuid = Str::orderedUuid();
            $model->image = Str::of($path)->replace('public/', '');
            $model->k = $test->k;
            
            $model->save();

            DB::commit();

            JobsProcessKNN::dispatch($model->id);

            return $model->uuid;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
