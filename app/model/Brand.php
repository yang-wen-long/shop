<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //指定表名
    protected $table = "han";
    //指定主键pk
    protected $primaryKey = "blog_id";
    //关闭时间戳
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
