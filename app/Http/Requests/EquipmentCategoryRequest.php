<?php

namespace App\Http\Requests;

use App\Services\RequestService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class EquipmentCategoryRequest extends FormRequest
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
     * Check if subcategories data not empty
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name),
            'subcategories' => RequestService::filterArray($this->subcategories),
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
            'name' => 'required',
            'name_ar' => 'required',
            'slug' => 'required'
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
            'name_ar' => 'arabic name'
        ];
    }
}
