<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class AreaModel extends Model
{
    //指定表名
    protected $table = "brand_area";
    //指定主键pk
    protected $primaryKey = "area_id";
    //关闭时间戳
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
