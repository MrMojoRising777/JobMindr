<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'company_id'    => 'nullable|exists:companies,id',
            'name'          => 'required|string|max:255',
            'street'        => 'required|string|max:255',
            'housenr'       => 'required|string|max:10',
            'zipcode'       => 'required|string|max:10',
            'city'          => 'required|string|max:255',
            'region'        => 'required|string|max:255',
            'country'       => 'required|string|max:255',
            'sector'        => 'nullable|string|max:255',
            'website'       => 'nullable|url|max:255',
        ];
    }
}
