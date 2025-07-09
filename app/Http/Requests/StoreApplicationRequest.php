<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

        $this->merge([
            'application.properties.salary_range.min'   => $this->input('salary_min'),
            'application.properties.salary_range.max'   => $this->input('salary_max'),
            'application.properties.job_type'           => $this->input('job_type'),
            'application.properties.work_location'      => $this->input('work_location'),
            'application.properties.experience_level'   => $this->input('experience_level'),
            'application.properties.education_level'    => $this->input('education_level'),
        ]);
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

            'application.properties.salary_range.min' => 'nullable|numeric|min:0|max:1000000',
            'application.properties.salary_range.max' => 'nullable|numeric|min:0|max:1000000|gte:application.properties.salary_range.min',

            'application.properties.job_type' => [
                'nullable',
                'string',
                Rule::in(['full-time', 'part-time', 'contract', 'internship'])
            ],

            'application.properties.work_location' => [
                'nullable',
                'string',
                Rule::in(['on-site', 'remote', 'hybrid'])
            ],

            'application.properties.experience_level' => [
                'nullable',
                'string',
                Rule::in(['junior', 'medior', 'senior', 'lead', 'none'])
            ],

            'application.properties.education_level' => [
                'nullable',
                'string',
                Rule::in(['high_school', 'bachelor', 'master', 'phd', 'none'])
            ],
        ];
    }
}
