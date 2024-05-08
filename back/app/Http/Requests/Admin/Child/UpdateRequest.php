<?php

namespace App\Http\Requests\Admin\Child;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => ['string', 'max:50'],
            'surname' => ['string', 'max:50'],
            'birth_date' => '',
            'gender' => '',
            'parent_id' => '',
            'group_id' => '',
            'photo' => '',
            'birth_certificate' => '',
            'med_certificate' => '',
            'med_disability' => '',
        ];
    }
}
