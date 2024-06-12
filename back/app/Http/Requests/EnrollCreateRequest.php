<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollCreateRequest extends FormRequest
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
            'parent_id' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'passport_front' => 'required',
            'passport_back' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'birth_date' => 'required',
            'gender' => '',
            'photo' => '',
            'birth_certificate' => '',
            'med_certificate' => '',
            'med_disability' => '',
        ];
    }
}
