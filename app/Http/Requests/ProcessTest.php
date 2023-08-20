<?php

namespace App\Http\Requests;

use App\Jobs\ProcessTest as JobsProcessTest;
use App\Models\Testing;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProcessTest extends FormRequest implements Fulfillable
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
            'k' => ['required', 'numeric', 'min:1']
        ];
    }

    public function fulfill()
    {
        try {
            DB::beginTransaction();

            $model = new Testing();
            $model->uuid = Str::orderedUuid();
            $model->k = $this->validated('k');
            $model->save();

            DB::commit();

            JobsProcessTest::dispatch($model->id, $this->validated('k'));

            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
