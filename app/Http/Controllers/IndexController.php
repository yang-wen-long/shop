<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
//新闻表
use  App\model\AreaModel;
//引入memcache
use Illuminate\Support\Facades\Cache;
class IndexController extends Controller
{
    //车上方法
    public function ches(){
        $area_name=request()->area_name;
        $area_data=request()->area_data;

        $where=[];
        if($area_name){
            $where[]=["area_name","like","%".$area_name."%"];
        }
        if($area_data){
            $where[]=["area_data","like","%".$area_data."%"];
        }
        $post=Cache::get("post");
        if(!$post){
            echo "没有缓存过";
            $post=AreaModel::where($where)->paginate(3);
            Cache::put("post",$post,5);
        }
        if($post){
             echo "有缓存";
        }
        if(request()->ajax()){
            return view("ajax",["post"=>$post,"area_name"=>$area_name,"area_data"=>$area_data]);
        }
        return view("yang",["post"=>$post,"area_name"=>$area_name,"area_data"=>$area_data]);
    }

    // public function index(){
    // 	return view("yang",["name"=>"和艰苦奋斗"]);
    // }
    // public function doadd(){
    // 	$post=request()->all();
    // 	dd($post);
    // }
    // public function show($id=1,$name=""){
    // 	echo $id;
    // 	echo $name;
    // }
    // public function Cookie(){
    //     //第一中方法
    //    // return response("你好，我叫杨文龙")->cookie('name', '安静的挂号收费的', 1);
    //     //第二方法
    //     // Cookie::queue("name","回到房间",1);
    //     // 第三种方法
    //     Cookie::queue(Cookie::make("name","就很烦的艰苦奋斗",1));

    // }
    // public function getCookie(){
    //     // echo request()->cookie('name');
    //     echo Cookie::get("admin_name");
    //     echo Cookie::get("admin_pwd");
    // }
}
