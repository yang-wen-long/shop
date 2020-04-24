<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCatePost extends FormRequest
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
           "cate_name"=>"required|unique:brand|max:20",
            "cate_desc"=>"required",
        ];
    }
    public function messages()
    { 
        return[ 
                'cate_name.required' => '商品名称不能为空', 
                'cate_name.unique' => '商品名称不能重复',
                'cate_name.max' => '商品名称最大长度位18',

                'cate_desc.required' => '手机号不能为空', 
            ];
    }




}
