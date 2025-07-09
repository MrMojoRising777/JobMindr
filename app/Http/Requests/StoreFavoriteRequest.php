<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class StoreFavoriteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    protected function prepareForValidation(): void
    {
//        dd($this->all());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'favoritable_type'  => 'required|string|in:application,company',
            'favoritable_id'    => 'required|integer',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $type = $this->input('favoritable_type');
            $id = $this->input('favoritable_id');

            if (!$type || !$id) {
                return;
            }

            $modelMap = [
                'application' => 'applications',
                'company' => 'companies',
            ];

            if (!array_key_exists($type, $modelMap)) {
                return;
            }

            $table = $modelMap[$type];

            if (!DB::table($table)->where('id', $id)->exists()) {
                $validator->errors()->add('favoritable_id', 'The selected ID does not exist in the selected favoritable type.');
            }
        });
    }
}
