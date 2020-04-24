<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //数据库表名
    protected $table="goods";
    //指定主键pk
    protected $primaryKey = "goods_id";
    //关闭时间戳
    public $timestamps = false;
    //黑名单
    protected $guarded = [];

//封装代码
    public static function getGoods($where,$pageSize){
    	 $goods = Goods::leftJoin("brand_cate", 'goods.cate_id', '=', 'brand_cate.cate_id')
                        ->leftJoin('han', 'goods.blog_id', '=', 'han.blog_id')
                        ->where($where)
                        ->orderBY("goods_id","desc")
                        ->paginate($pageSize);
            return $goods;
    }
    //获取幻灯片的方法
    public static function getIndexslide(){
        $slide = Goods::select("goods_id","goods_img")->where("is_slide","=","1")->take(5)->get();
        return $slide;
    }


}
