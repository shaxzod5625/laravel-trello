<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:30',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.min' => 'A name must be at least 3 characters',
            'name.max' => 'A name must be less than 30 characters',
        ];
    }
}
