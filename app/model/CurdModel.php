<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class CurdModel extends Model
{
    //数据库表名
    protected $table="curd";
    //指定主键pk
    protected $primaryKey = "admin_id";
    //关闭时间戳
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
