<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\Brand;
use DB;
use App\Http\Requests\StoreBlogPost;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示方法
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //接值
        $blog_name = request()->blog_name;
        $where = [];
        if($blog_name){
            $where[] = ["blog_name","like","%".$blog_name."%"];
        }
        // $users = DB::table('han')->get();
        //用ORM(model中的数据来查询数据库的东西)
        //$users = Brand::all();
        $users = Brand::orderBy("blog_id","desc")->where($where)->paginate(3);
        //ajax方法判断
        // dd(request()->ajax());
        if(request()->ajax()){
            return view("admin.brand.ajaxshow",["user"=>$users,"blog_name"=>$blog_name]);
        }
        // dd($users);
        return view("admin.brand.show",["user"=>$users,"blog_name"=>$blog_name]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       return view("admin.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     *执行添加方法
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *uploads.1910.com 
     */
    public function store(StoreBlogPost $request)
    {
        //获取说有的值
        // $post=request()->all();
        // $post=$request->all();
        // $post=request()->input();
        // $post=request()->post();
        // dd($post);
        //只接受***
        // $post=request()->only();
        //排除接受***
        $post=request()->except(["_token"]);
        // dd($post);
        //判断上传文件
        if ($request->hasFile('blog_logo')){
            $post["blog_logo"] = uploads('blog_logo');
        }
        // dd($post);
        $scr = DB::table('han')->insert($post);
        if($scr){
            return redirect("/brand/index");
        }
    }
    /**
     * Display the specified resource.
     *预览详情页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $res = DB::table('han')->where('blog_id','=',$id)->first();
        return view("admin.brand.find",["error"=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *执行更新
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogPost $request, $id)
    {
        //接值ID
        $post=request()->except(["_token"]);
        if($request->hasFile('blog_logo')){
            $post["blog_logo"] = uploads("blog_logo");
        }
        $dec = DB::table('han') ->where(['blog_id'=>$id]) ->update($post);
        if($dec !== false){
             return redirect("/brand/index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除方法
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand_logo=DB::table("han")->where("blog_id","=",$id)->value("blog_logo");
        if($brand_logo){
            unlink(storage_path("app/".$brand_logo));
        }
        // dd(storage_path("app/".$brand_logo));
        $res = DB::table('han')->where('blog_id','=',$id)->delete();
        if($res){
            return redirect("/brand/index");
        }
    }
}
