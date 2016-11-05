<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'email' => 'required|email|unique:subscriptions',
            'budget' => 'required',
            'message' => 'required',
            'agree' => 'required',
            'subscribe' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Please fill Email',
            'email.unique' => 'This email already was used for submission',
        ];
    }
}
