<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//使用说明   \验证      \规则;
use Illuminate\validation\Rule;
class StoreAreaPost extends FormRequest
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
        $data = \Route::currentRouteName();
        if($data == "store"){
            return [
                'area_name' => 'required|unique:brand_area|max:40|regex:/^[\x7f-\xffA-Za-z0-9\s]+$/', //2382662404@qq.com
                'area_website' => 'required|max:40|regex:/^[a-zA-Z0-9]{2,10}@[a-zA-Z0-9]{2,5}\.com+$/',
                'area_data' => 'required',
                'area_img' => 'required',
                'area_linkman' => 'required|max:12|regex:/^\d{5,11}$/',
                'area_text' => 'required|max:80',
                'is_desc' => 'required',
            ];
        }
        if($data == "update"){
            return [
                'area_name' => ['required',
                Rule::unique("brand_area")->ignore(request()->id,"area_id"),
                'max:40,regex:/^[\x7f-\xffA-Za-z0-9\s]+$/'
                ],
                'area_website' => 'required|max:40',
                'area_data' => 'required',
                'area_linkman' => 'required|max:12',
                'area_text' => 'required|max:80',
                'is_desc' => 'required',
            ];
        }
    }   
    //错误信息
    public function messages(){ 
        return[ 
                'area_name.required' => '网站名称不能为空', 
                'area_name.unique' => '网站名称不能重复', 
                'area_name.max' => '网站名称最大值为40', 
                'area_name.regex' => '网站名称必须为汉字数字字母组成', 

                'area_website.required' => '网站网址不能为空', 
                'area_website.max' => '网站网址最大值为40', 

                'area_data.required' => '网站类型不能为空', 

                'area_linkman.required' => '网站联系人不能为空', 
                'area_linkman.max' => '网站联系人最大值为12',

                'area_text.required' => '网站介绍不能为空', 
                'area_text.max' => '网站联系人最大值为80', 

                'is_desc.required' => '是否显示不能为空', 
            ];
    }

















}
