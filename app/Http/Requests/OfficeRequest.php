<?php

namespace App\Http\Requests;

use App\Services\RequestService;
use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
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
     * Check if phones data not empty
     * Store NULL to database if data is empty
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'phones' => RequestService::filterArray($this->phones)
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
            'address' => 'required',
            'address_ar' => 'required',
            'email' => 'required|email:rfc,dns',
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
            'address' => 'english address',
            'address_ar' => 'arabic address',
        ];
    }
}
