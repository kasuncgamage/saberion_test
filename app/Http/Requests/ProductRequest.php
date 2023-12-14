<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $data =  [   
            'category' => "required|max:40",
            'name' => "required|max:100",
            'description' => "max:400",
            'selling_price' => "required|numeric|gt:0",
            'special_price' => "numeric|gt:-1",
            'status' => "required",
            'is_delivery_available' => "required",
		];

		if($this->get('_method') ==='PUT' || request()->method() == "PUT"){
			$data['code'] ='max:12|unique:products,code,'.$this->route('product')->id;
			$data['product_image'] ='image|max:2048|mimes:jpeg,png';
		}else{
			$data['product_image'] ='required|image|max:2048|mimes:jpeg,png';
			$data['code'] ='required|max:12|unique:products,code';

		}
		return $data;

    }
}
