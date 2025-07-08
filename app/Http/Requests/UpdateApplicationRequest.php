<?php

namespace App\Http\Requests;

use App\Enums\ApplicationRejectionReason;
use App\Enums\ApplicationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateApplicationRequest extends FormRequest
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
            'application_id'    => 'required|exists:applications,id',
            'status'            => ['required', new Enum(ApplicationStatus::class)],
            'reason'            => ['nullable', new Enum(ApplicationRejectionReason::class)],
            'notes'             => ['nullable', 'string'],
        ];
    }
}
