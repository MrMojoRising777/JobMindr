<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Prepare the data for validation.
     */
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
            // Company rules
            'company.name'      => 'required|string|max:255',
            'company.sector'    => 'required|string|max:255',
            'company.website'   => 'nullable|url|max:255',
            'company.street'    => 'required|string|max:255',
            'company.housenr'   => 'required|string|max:10',
            'company.zipcode'   => 'required|string|max:10',
            'company.city'      => 'required|string|max:255',
            'company.region'    => 'required|string|max:255',
            'company.country'   => 'required|string|max:255',

            // Contact rules
            'contact.first_name'    => 'nullable|string|max:255',
            'contact.last_name'     => 'nullable|string|max:255',
            'contact.email'         => 'nullable|email|max:255',
            'contact.phone'         => 'nullable|string|max:20',
            'contact.linkedin'      => 'nullable|url|max:255',
            'contact.position'      => 'nullable|string|max:255',

            // Application rules
            'application.position'  => 'required|string|max:255',
            'application.found_on'  => 'required|string|max:255',
            'application.website'   => 'nullable|url|max:255',
            'application.notes'     => 'nullable|string|max:600',
        ];
    }
}
