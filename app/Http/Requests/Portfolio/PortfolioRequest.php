<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
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
            'en_name'=>'required',
            'en_desc'=>'required|min:8|max:255',
            'en_client'=>'required',

            'ar_name'=>'required',
            'ar_desc'=>'required|min:8|max:255',
            'ar_client'=>'required',

            'category'=>'required',

        ];
    }
    public function messages()
    {
        return [

            'en_desc.min' => 'Your Portfolio\'s description english  Is Too Short',
            'ar_desc.min' => 'Your Portfolio\'s description arabic  Is Too Short',

            'category.required' => __('validation.required'),

            'en_name.required' => __('validation.required'),
            'en_desc.required' => __('validation.required'),
            'en_client.required' => __('validation.required'),

            'ar_name.required' => __('validation.required'),
            'ar_desc.required' => __('validation.required'),
            'ar_client.required' => __('validation.required')
        ];
    }
}
