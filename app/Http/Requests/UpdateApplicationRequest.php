<?php

namespace App\Http\Requests;

use App\Enums\ApplicationRejectionReason;
use App\Enums\ApplicationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateApplicationRequest extends FormRequest
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
            'application_id'    => 'required|exists:applications,id',
            'status'            => ['required', new Enum(ApplicationStatus::class)],
            'reason'            => ['nullable', new Enum(ApplicationRejectionReason::class)],
            'notes'             => ['nullable', 'string'],

            'application.properties.salary_range.min' => 'nullable|numeric|min:0|max:1000000',
            'application.properties.salary_range.max' => 'nullable|numeric|min:0|max:1000000|gte:application.properties.salary_range.min',

            'application.properties.job_type' => [
                'nullable',
                'string',
                Rule::in(['full-time', 'part-time', 'Contract', 'Internship'])
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
