<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//使用说明   \验证      \规则;
use Illuminate\validation\Rule;
class StoreGoodsPost extends FormRequest
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
        $date = \Route::currentRouteName();
        if($date == "goodsstore"){
            return[
                "goods_name"=>"required|unique:goods|max:18|regex:/^[\x7f-\xff]{2,}[0-9a-zA-Z]{1,}$/",
                "goods_price"=>"required",
                "goods_desc"=>"required",
                "goods_num"=>"required",
                "goods_score"=>"required",
                "is_show"=>"required",
                "is_nwe"=>"required",
                "is_hot"=>"required",
                "is_slide"=>"required",
                "blog_id"=>"required",
                "cate_id"=>"required",
            ];
        }
        if($date == "goodsupdate"){
            return[
                "goods_name"=>[
                "required",
                Rule::unique("goods")->ignore(request()->id,"goods_id"),
                "max:18,regex:/^[\x7f-\xff]{2,}[0-9a-zA-Z]{1,}$/"
                ],
                "goods_price"=>"required",
                "goods_desc"=>"required",
                "goods_num"=>"required",
                "goods_score"=>"required",
                "is_show"=>"required",
                "is_nwe"=>"required",
                "is_hot"=>"required",
                "is_slide"=>"required",
                "blog_id"=>"required",
                "cate_id"=>"required",
            ];
        }
    }

    public function messages()
    { 
        return[ 
                'goods_name.required' => '商品名称不能为空', 
                'goods_name.unique' => '商品名称不能重复',
                'goods_name.max' => '商品名称最大长度位18',
                'goods_name.regex' => '中文字母数字组成',

                'goods_price.required' => '商品价格不能为空',

                'goods_desc.required' => '商品详情不能为空',

                'goods_num.required' => '商品库存不能为空', 

                'goods_score.required' => '商品货号不能为空', 

                'is_show.required' => '是否显示不能为空', 

                'is_nwe.required' => '是否显示不能为空',

                'is_hot.required' => '是否精品不能为空',
                
                'is_slide.required' => '是否是幻灯片推荐不能为空',

                'blog_id.required' => '商品品牌不能为空',

                'cate_id.required' => '商品分类不能为空',

            ];
    }










}
