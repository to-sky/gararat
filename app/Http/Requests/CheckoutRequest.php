<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\User;
use App\Rules\GoogleRecaptcha;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'status' => Order::STATUS_QUEUED,
            'user_id' => auth()->id() ?? User::whereEmail($this->email)->first()->id ?? null,
            'total' => (float) Cart::total(2, '.', ''),
            'subscribe' => $this->subscribe ? true : false
        ]);
    }

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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'country_id' => 'required',
            'g-recaptcha-response' => [
                'required', new GoogleRecaptcha()
            ]
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
            'country_id' => 'country'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required' => __('Are you a robot?')
        ];
    }
}
