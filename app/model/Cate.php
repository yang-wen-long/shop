<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //数据库表名
    protected $table="brand_cate";
    //指定主键pk
    protected $primaryKey = "cate_id";
    //关闭时间戳
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
