<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules =  [
            'category_id'=>[
                'required',
                'integer'
            ],
            'name'=>[
                'required',
                'string'
            ],
            'slug'=>[
                'required',
                'string',
                'max:255'
            ],
            'brand'=>[
                'required',
                'string',
                'max:255'
            ],
            'small_description'=>[
                'required',
                'string'
            ],
            'description'=>[
                'required',
                'string'
            ],
            'orignal_price'=>[
                'required',
                'integer'
            ],
            'selling_price'=>[
                'required',
                'integer'
            ],
            'quantity'=>[
                'required',
                'integer'
            ],
            'trending'=>[
                'nullable',
                
            ],
            'status'=>[
                'nullable',
                
            ],
            'meta_title'=>[
                'required',
                'string'
            ],
            'meta_description'=>[
                'required',
                'string'
            ],
            'meta_keyword'=>[
                'required',
                'string'
            ],
            'image'=>[
                'nullable',
                
            ]
            
        ];

        return $rules;
    }
}
