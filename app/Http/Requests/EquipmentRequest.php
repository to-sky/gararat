<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EquipmentRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * Check if specifications data not empty
     * Store NULL to database if data is empty
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $filteredSpecificationData = collect($this->specifications)->flatten()->filter();

        if($filteredSpecificationData->isEmpty()) $this->merge(['specifications' => null]);
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
                Rule::unique('parts')->ignore($this->equipment)
            ],
            'manufacturer_id' => 'required|integer',
            'equipment_group_id' => 'required|integer',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric'
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
            'name' => 'english name',
            'manufacturer_id' => 'manufacturer',
            'equipment_group_id' => 'equipment group'
        ];
    }
}
