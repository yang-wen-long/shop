<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//购物车
use App\model\Shop_CatrModel;
//收货地址
use App\model\AddressModel;
//商品管理
use App\model\Goods;
//引入memcache
use Illuminate\Support\Facades\Cache;
class CatrController extends Controller
{
	public function CatrController(){
		//登录的用户id
		$user_id = session("code")->user_id;
		$all = Shop_CatrModel::where("user_id","=",$user_id)->get();
		//获取每个商品的购买数量
		$buy_num = array_column($all->toArray(),"buy_num");
		//将购买数量相加
		$count = array_sum($buy_num);
		//购物车方法
		$cate_id = array_column($all->toArray(),"catr_id");
		//用购物车id和购买数量进行像拼接
		$checkedbuynumber = array_combine($cate_id,$buy_num);
		$goods = Goods::select("goods_num")->get();
		//传值
		// return view("/Index/index/catr",["all"=>$all,"add"=>$$count]);
		return view("/Index/index/catr",compact("all","count","checkedbuynumber","goods"));
	}
	//个购物车数量进行修改
	public function update(){
		//获取点击的数量
		$buy_num = request()->buy_num;
		//购物车id
		$catr_id = request()->catr_id;
		//商品id
		$goods_id = request()->goods_id;
		//用户id
		$user_id = session("code")->user_id;
		if(!$user_id){
			echo returnJson(1,"请先登录！");
			exit;
		}
		//组织条件
		$where=[
			"catr_id"=>$catr_id,
			"goods_id"=>$goods_id,
			"user_id"=>$user_id
		];
		//查询商品表的数据
		$goods = Goods::select("goods_num")->where("goods_id","=",$goods_id)->first();
		//查询购物车表
		$all =  Shop_CatrModel::where($where)->first();
		//判断库存是否充足
		if("$buy_num" > $goods["goods_num"]){
			echo returnJson(1,"库存不足！请重新添加");
			exit;
		}
		//有库存就进行修改数据
		$add = Shop_CatrModel::where($where)->update(["buy_num"=>$buy_num]);
		echo returnJson(0);
		exit;
	}
	// // 购物车订单方法
	// public function confirmorder(){
	// 	//登录的用户id
	// 	$user_id = session("code")->user_id;
	// 	$add=AddressModel::where("user_id","=",$user_id)->get()->toArray();
	// 	if($add==[]){
	// 		return redirect("/address");
	// 	}
	// 	$goods_id = request()->str;
	// 	$where=[
	// 		"user_id"=>$user_id,
	// 		"goods_id"=>$goods_id
	// 	];
	// 	$all=Shop_CatrModel::where($where)->get();
	// 	// $price=0;
	// 	// foreach($all as $k=>$a){
	// 	// 	$price=$a["goods_price"]*$a["buy_num"];
	// 	// 	dd($price);
	// 	// }
	// 	// dump($all);
	// 	// dd($add);
	// 	return view("/Index/index/catrlist",["all"=>$all,"add"=>$add]);
	// }
























































	//购物车订单方法
	public function confirmorder(){
		//登录的用户id
		$user_id = session("code")->user_id;
		$add=AddressModel::where("user_id","=",$user_id)->get()->toArray();
		if($add==[]){
			return redirect("/address");
		}
		$desc=AddressModel::where("user_id","=",$user_id)->get();
		$goods_id = request()->str;
		$goods_id = explode(",",$goods_id);
		$where=[
			"user_id"=>$user_id,
			"goods_id"=>$goods_id
		];
		// dd($goods_id);
		$all=Shop_CatrModel::whereIn("goods_id",$goods_id)->where("user_id","=",$user_id)->get();
		$allmoney = 0;
		foreach($all as $kk=>$aa){
			$allmoney=$aa["goods_price"] * $aa["buy_num"];
			$allmoney += $allmoney;
		}
		// dd($desc->user_id);
		// dd($allmoney);
		// dd($all);
		return view("/Index/index/catrlist",["all"=>$all,"allmoney"=>$allmoney,"add"=>$desc]);
	}


}