<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class shippingsRequest extends FormRequest
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

              'id'=>'required|exists:settings',
              'value'=>'required|string',
              'plan_value'=>'numeric|nullable'


        ];
    }

    public function messages()
    {
        return [


            'value.required'=>'هذه الوسيله موجوده',
            'value.string'=>'لابد ان تكون موجوده',
            'plan_value.numeric'=>'لابد ان تكون رقم'


        ];
    }


}
