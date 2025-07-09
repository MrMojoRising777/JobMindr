<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'company_id'    => 'required|exists:companies,id',
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:255',
            'linkedin'      => 'nullable|string|max:255',
            'position'      => 'required|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Voornaam is verplicht.',
            'last_name.required'  => 'Achternaam is verplicht.',
            'email.required'      => 'E-mailadres is verplicht.',
            'email.email'         => 'Voer een geldig e-mailadres in.',
            'phone.required'      => 'Telefoonnummer is verplicht.',
            'position.required'   => 'Functie is verplicht.',
        ];
    }
}
