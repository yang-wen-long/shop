<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//商品管理
use App\model\Goods;
//品牌表
use App\model\Brand;
//购物车
use App\model\Shop_CatrModel;
//引入memcache
use Illuminate\Support\Facades\Cache;
//Redis方法
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    //
    public function index(){
        //查询缓存
    	$slide = Cache::get("slide");
        //判断缓存是否存在
        if(!$slide){
            //从数据库查询
            $slide = Goods::getIndexslide();
            //存到缓存中
            Cache::put("slide",$slide,60*60*24*2);
        }
        //查询缓存
        $desc = Redis::get("desc");
        //判断缓存是否存在
        if(!$desc){
            $desc = Goods::leftJoin('han', 'goods.blog_id', '=', 'han.blog_id')
            ->orderBY("goods_id","desc")
            ->get();
            // Cache::put("desc",$desc,60*60);
            $desc=serialize($desc);
            Redis::setex("desc",60,$desc);
        }
        $desc=unserialize($desc);
    	return view("Index/index",["slide"=>$slide,"desc"=>$desc]);
    }
    //所有商品
    public function getprolist(){
    	$all = Goods::all();
    	return view("/Index/goods/getcatr",["all"=>$all]);
    }
    //详情页
    public function goodsList($id){
        //访问量
        $visit=Redis::setnx("visit_".$id,1)?1:Redis::incr("visit_".$id);
    	$add = Goods::where("goods_id","=",$id)->first();
    	$add["goods_imgs"]=explode("|",$add["goods_imgs"]);
    	return view("/Index/goods/List",["add"=>$add,"visit"=>$visit]);
    }
    //添加购物车方法
    public function getcatr(){
        //returnJson($error_no=0,$error_msg="")
        //接过来的参数
    	$goods_id = request()->goods_id;
    	$buy_num = request()->buy_num;
        //判断是否登录
        $user = session("code"); 
        if(!$user){
            //没有登录跳回登录页面
           echo returnJson("1","请先登录");
           die;
        }
        //根据商品id进行查询
        $goods = Goods::select("goods_id","goods_name","goods_price","goods_img","goods_num")->find($goods_id);
        // dd($goods["goods_num"]);
        //判断购买数量不能超过数据库的
        if($goods["goods_num"] <= $buy_num){
            //购买的数量超过了库存
           echo returnJson("2","库存不足");
           die;
        }
        //组织条件
        $where=[
            "user_id"=>$user["user_id"],
            "goods_id"=>$goods_id
        ];
        //根据条件进行查询
        $catr = Shop_CatrModel::where($where)->first();
        if($catr){
        //数据库有值的
            $buy_num = $catr["buy_num"]+$buy_num;
            if($goods["goods_num"] <= $buy_num){
                //购买的数量超过了库存
                echo returnJson("2","库存不足");
                die;
            }
            $data1 = [
                "buy_num"=>$buy_num,
                "addtime"=>time(),
                "update_time"=>time()

            ];
            $where2=[
               "user_id"=>$user["user_id"],
               "goods_id"=>$goods_id
            ]; 
            $res = Shop_CatrModel::where($where2)->update($data1);
        }else{
        //数据库没有值
           $data=[
            "user_id"=>$user["user_id"],
            "goods_id"=>$goods_id,
            "goods_name"=>$goods["goods_name"],
            "goods_img"=>$goods["goods_img"],
            "goods_price"=>$goods["goods_price"],
            "buy_num"=>$buy_num,
            "addtime"=>time(),
           ];
           $res = Shop_CatrModel::insert($data);
        }
        if($res){
            echo returnJson("0","加入购物车成功");
            exit;
        }
    }
















}
