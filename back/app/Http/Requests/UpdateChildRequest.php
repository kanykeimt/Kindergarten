<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChildRequest extends FormRequest
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
            'name' => 'required',
            'surname' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
            'photo' => 'mimes:jpeg,jpg,png',
            'birth_certificate' => 'mimes:jpeg,jpg,png',
            'med_certificate' => 'mimes:jpeg,jpg,png',
            'med_disability' => '',
        ];
    }
}
