<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'link_text' => 'required',
                    'url' => 'required',
                    'body' => 'required',
                    'image' => 'required|mimes:jpg,jpeg,png|max:2048',
                ];
            }
            case 'PATCH':
            {
                return [
                    'link_text' => 'required',
                    'url' => 'required',
                    'body' => 'required',
                    'image' => 'mimes:jpg,jpeg,png|max:2048',
                ];
            }
        }
    }
}
