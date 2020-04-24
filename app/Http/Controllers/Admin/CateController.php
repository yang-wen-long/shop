<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//调用model中的数据
use App\model\Cate;
//页面验证
use App\Http\Requests\StoreCatePost;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示方法
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $post = Cate::all();
        $user = shangchun($post);
        // dd($user);
        return view("admin.cate.find",["user"=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = Cate::all();
        $res = shangchun($post);
        // //渲染页面
        return view("admin.cate.cate",["res"=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *执行添加方法
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCatePost $request)
    {
        //
        $post = request()->except("_token");
        $sec = Cate::insert($post);
        if($sec){
            return redirect("/cate/index");
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
           $res = Cate::where('cate_id','=',$id)->first();
           $post = Cate::all();
           $user = shangchun($post);
           return view("admin.cate.show",["res"=>$res,"user"=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *执行更新
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //接值
        $post = request()->except("_token");
        $res = Cate::where("cate_id","=",$id)->update($post);
        if($res !==false){
            return redirect("/cate/index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *s删除方法
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $desc = Cate::where('cate_id', '=', $id)->delete();
        if($desc){
            return redirect("/cate/index");
        }
    }


}
