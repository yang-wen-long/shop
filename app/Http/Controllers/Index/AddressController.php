<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//收货地址
use App\model\AddressModel;
//收货地区
use App\model\ShopAreaModel;
//引入memcache
use Illuminate\Support\Facades\Cache;
class AddressController extends Controller
{
    //展示地址的方法
    public function address(){
    	$area = ShopAreaModel::where("pid","=",0)->get();
    	return view("/Index/address/address",["area"=>$area]);
    }
    //收货地址
    public function ress(){
    	$name = request()->name;
    	//判断非空
    	if($name==""){
           echo returnJson(2,"数据有误！");
           die;
    	} 
    	//组织条件
    	$where=[
    		"pid"=>$name
    	];
    	$add = ShopAreaModel::where($where)->get();
    	if($add){
           echo returnJson(1,"数据查询成功",$add);
           die;
    	}
    }
    //添加收货地址方法
    public function addlist(){
        //登录的用户id
        $user_id = session("code")->user_id;
    	$name=request()->except("_token");
        $name["user_id"]=$user_id;
        $name["create_time"]=time();
        $add=AddressModel::insert($name);
        if($add){
            return redirect("/confirmorder");
        }
    }
    //订单方法
    public function seccess(){
    	return view("/Index/address/success");
    }
    //收货地址方法
    public function adddesc(){
        return vire("/Index/logon/Add-address");
    }

}
