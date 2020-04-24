<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//使用说明   \验证      \规则;
use Illuminate\validation\Rule;
class StoreBlogPost extends FormRequest
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
        //接传过来的值
        $brand = \Route::currentRouteName();
        //添加的
        if($brand == "brandstore"){
            return [
                "blog_name"=>"required|unique:han|max:20",
                "blog_url"=>"required",
            ];
        }
        //修改的
        if($brand == "brandupdate"){
            return [
                    "blog_name"=>[
                    "required",
                    Rule::unique("han")->ignore(request()->id,"blog_id"),
                    "max:20"
                ], 
                "blog_url"=>"required",
            ];
        }
    }
    public function messages()
    { 
        return[ 
                'blog_name.required' => '商品名称不能为空', 
                'blog_name.unique' => '商品名称不能重复',
                'blog_name.max' => '商品名称最大长度位20',
              
                'blog_url.required' => '分类描述不能为空', 
            ];
    }




}
