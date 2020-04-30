<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
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
        if (collect($this->specifications)->flatten()->filter()->isEmpty()) {
            $this->merge(['specifications' => null]);
        }

        if (collect($this->main_specifications)->flatten()->filter()->isEmpty()) {
            $this->merge(['main_specifications' => null]);
        }

        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
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
                'required', Rule::unique('equipment')->ignore($this->equipment)
            ],
            'name_ar' => 'required',
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
            'name_ar' => 'arabic name',
            'manufacturer_id' => 'manufacturer',
            'equipment_group_id' => 'equipment group'
        ];
    }
}
