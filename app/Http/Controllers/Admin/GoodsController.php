<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//商品管理
use App\model\Goods;
//商品添加
use App\model\Brand;
//商品分类
use App\model\Cate;
use DB;
//页面验证
use App\Http\Requests\StoreGoodsPost;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $goods_name=request()->goods_name;
        $goods_price=request()->goods_price;
        $goods_prices=request()->goods_prices;
        $blog_name=request()->blog_name;
        $is_nwe=request()->is_nwe;
        $where = [];
        if($goods_name){
            $where[] = ["goods_name","like","%".$goods_name."%"];
        }
        if($goods_price){
            $where[] = ["goods_price",">=","%".$goods_price."%"];
        }
        //between
        if($goods_prices){
            $where[] = ["goods_price","<=","%".$goods_prices."%"];
        }
        if($blog_name){
            $where[] = ["blog_name","like","%".$blog_name."%"];
        }
        if($is_nwe){
            $where[] = ["is_nwe","like","%".$is_nwe."%"];
        }
        // dump($where);

        //监听sql
        // DB::connection()->enableQueryLog();
        //分页显示条数
        $pageSize = config("app.pageSize");
        // dd($pageSize);
        $goods = Goods::getGoods($where,$pageSize);
        // 监听sql
        // $logs = DB::getQueryLog();
        // dd($logs);
        // dd(cookie("adminuser"));
        //循环追后得到的值
        foreach($goods as $k=>$a){
            $goods[$k]["goods_imgs"] = explode("|",$goods[$k]["goods_imgs"]);
        }
        //laravel中的循环方法
        // foreach($goods as $k=>$a){
        //     $goods[$k]->goods_imgs = explode("|",$a->goods_imgs);
        // }
        // $sll = $request->session->get("name"=>$goods_name);
        // request()->session()->put("name",["pwd"=>$goods_name,"desc"=>$goods_price]);
        // dd(request()->session()->all("name"));
        //打印多为下的数据
        $sql = request()->all();
        // dump($sql);
        // dd($goods[1]->goods_imgs);
        $all= Brand::get();
        //判断ajax方法
        // dd(request()->ajax());
        if(request()->ajax()){
            return view("admin.goods.ajaxshow",
            [   
                "all"=>$all
                ,"goods"=>$goods
                ,"sql"=>$sql
                ,'goods_name'=>$goods_name
                ,"goods_price"=>$goods_price
                ,"goods_prices"=>$goods_prices
                ,"blog_name"=>$blog_name
                ,"is_nwe"=>$is_nwe
            ]);
        }
        return view("admin.goods.show",
        [   
            "all"=>$all
            ,"goods"=>$goods
            ,"sql"=>$sql
            ,'goods_name'=>$goods_name
            ,"goods_price"=>$goods_price
            ,"goods_prices"=>$goods_prices
            ,"blog_name"=>$blog_name
            ,"is_nwe"=>$is_nwe
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *添加展示
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $all= Brand::get();
        $arr= Cate::get();
        $fen = shangchun($arr);
        // dd($fen);
        return view("admin/goods/create",["all"=>$all,"arr"=>$fen]);
    }

    /**
     * Store a newly created resource in storage.
     *添加方式
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsPost $request)
    {
        //
        // $request->validate([ 
        //     'goods_name' => 'bail|required|unique:goods|max:255', 
        //     'goods_desc' => 'required', 
        //     ],[
        //     "goods_name.required"=>"*商品名称必须填写",
        //     "goods_name.unique"=>"*商品名称已存在",
        //     "goods_name.max"=>"*商品名称长度最大位255",
        //     "goods_desc.required"=>"* ",
        // ]);
        $post = request()->except("_token");
        //多文件上传
        // if($request->hasFile('goods_imgs')){
        //     $post["goods_imgs"]= $this->shangchun("goods_imgs");
        // }
        //文件上传
        if($request->hasFile('goods_img')){
            $post["goods_img"]= uploads("goods_img");
        }
        //多文件上传
        if(isset($post['goods_imgs'])){
            $imgs =  MODEmove("goods_imgs");
            $post["goods_imgs"] = implode("|",$imgs);
        }
        $are = Goods::insert($post);
        if($are){
            return redirect("/goods/index");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *查询单条数据
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $all= Brand::get();
        $arr= Cate::get();
        $fen = shangchun($arr);
        $res = Goods::where("goods_id","=",$id)->first();
        //用分割字符串的方法来分割
        $res["goods_imgs"] = explode("|",$res["goods_imgs"]);
        // dd($res);
        return view("admin.goods.find",["res"=>$res,"all"=>$all,"arr"=>$fen]);
    }

    /**
     * Update the specified resource in storage.
     *更新数据
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGoodsPost $request, $id)
    {
        //
        $post = request()->except("_token","goods_imgs");
        if($request->hasFile('goods_img')){
            $post["goods_img"]= uploads("goods_img");
        }
        //多文件上传
        if(isset($post['goods_imgs'])){
            $imgs = MODEmove("goods_imgs");
            $post["goods_imgs"] = implode("|",$imgs);
        }
        $desc = Goods::where('goods_id',"=", $id) ->update($post);
        if($desc !==false){
            return redirect("/goods/index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除数据
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $goods_img= Goods::where("goods_id","=",$id)->value("goods_img");
        if($goods_img){
            unlink(storage_path("app/".$goods_img));
        }
        // dd(storage_path("app/".$goods_img));
        $res = Goods::where('goods_id','=',$id)->delete();
        if($res){
            return redirect("/goods/index");
        }
    }

}
