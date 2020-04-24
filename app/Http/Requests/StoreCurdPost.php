<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurdPost extends FormRequest
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
            "admin_name"=>"required|unique:curd|max:18|regex:/^[\x7f-\xff]{2,}[0-9a-zA-Z]{1,}$/",
            "admin_mobile"=>"required|max:11|regex:/^\d{11}$/",
            "admin_mailbox"=>"required|regex:/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i",
            "admin_pwd"=>"required|max:12",
        ];
    }
    public function messages()
    { 
        return[ 
                'admin_name.required' => '用户名不能为空', 
                'admin_name.unique' => '用户名不能重复',
                'admin_name.max' => '用户名最大长度位18',
                'admin_name.regex' => '中文字母数字组成',

                'admin_mobile.required' => '手机号不能为空', 
                'admin_mobile.max' => '手机号最大长度位11',
                'admin_mobile.regex' => '手机号为数字',

                'admin_mailbox.required' => '邮箱不能为空', 
                'admin_mailbox.regex' => '邮箱为英文数字组成',

                'admin_pwd.required' => '密码不能为空', 
                'admin_pwd.max' => '密码不能超过12位', 
                // 'admin_pwd.regex' => '密码需一致',
            ];
    }


















}
