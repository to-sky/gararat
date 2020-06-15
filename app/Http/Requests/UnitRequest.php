<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnitRequest extends FormRequest
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
        // For update method
        if ($this->isMethod('PUT')) {
            return [
                'parts' =>'required'
            ];
        }

        return [
            'equipment_id' => 'required',
            'catalog_id' => 'required',
            'parts' =>'required'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'equipment_id' => 'equipment',
            'catalog_id' => 'catalog',
        ];
    }
}
