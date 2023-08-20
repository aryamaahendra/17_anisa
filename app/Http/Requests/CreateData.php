<?php

namespace App\Http\Requests;

use App\Jobs\PreprocessImgUjiLatih as Preprocess;
use App\Models\Data;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateData extends FormRequest implements Fulfillable
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
            'imgs' => ['required', 'array', 'min:1'],
            'imgs.*' => ['required', 'string'],
            'class' => ['required', 'string', 'in:premium,medium'],
            'type' => ['required', 'string', 'in:train,test'],
        ];
    }

    public function fulfill()
    {
        $ids = [];

        try {
            DB::beginTransaction();

            $inputs = $this->validated();
            foreach ($inputs['imgs'] as $img) {
                [$path, $orignalName] = $this->processImg($img);
                $model = new Data();
                $model->original_image = $path;
                $model->original_name = $orignalName;
                $model->class = $inputs['class'];
                $model->type = $inputs['type'];
                $model->save();

                array_push($ids, $model->id);
            }
            DB::commit();

            foreach ($ids as $id) {
                Preprocess::dispatch($id);
            }

            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    protected function processImg($img)
    {
        $files = Storage::files('filepond/' . $img);
        if (empty($files)) abort(400);

        $orginalName = pathinfo($files[0], PATHINFO_FILENAME);

        $moveTo = 'data_original/' . Str::orderedUuid() . '.' . pathinfo($files[0], PATHINFO_EXTENSION);
        $status = Storage::move($files[0], 'public/' . $moveTo);
        if (!$status) abort(400);

        Storage::deleteDirectory('filepond/' . $img);

        return [$moveTo, $orginalName];
    }
}
