<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Shop_user extends Model
{
    //数据库表名
    protected $table="shop_user";
    //指定主键pk
    protected $primaryKey = "user_id";
    //关闭时间戳
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
