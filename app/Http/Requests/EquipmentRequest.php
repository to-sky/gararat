<?php

namespace App\Http\Requests;

use App\Services\RequestService;
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
     * Check if specifications and main_specifications data not empty
     * Store NULL to database if data is empty
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name),
            'specifications' => RequestService::filterArrayWithNested($this->specifications),
            'main_specifications' => RequestService::filterArray($this->main_specifications['data']),
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
