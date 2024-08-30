<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeasurementsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'neck' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'chest' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'bust' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'under_bust' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'waist_shirt' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'waist_pant' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'shoulder' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'sleeve_length' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'bicep' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'wrist' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'hips' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'thigh' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'knee' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'calf' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'inseam' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
            'outseam' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
        ];
    }

    // if error in the first field then it will only trigger first field.
    protected $stopOnFirstFailure = true;
}
