<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//数据库的方法
use App\model\AreaModel;
//页面验证
use App\Http\Requests\StoreAreaPost;
class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $area_name = request()->area_name;
        $area_data = request()->area_data;
        $where = [];
        if($area_name){
            $where[] = ["area_name","like","%".$area_name."%"];
        }
        if($area_data){
            $where[] = ["area_data","like","%".$area_data."%"];
        }
        $pageSize =config("app.pageSize"); 
        $post = AreaModel::where($where)->orderBY("area_id","desc")->paginate($pageSize);
        if(request()->ajax()){
            return view("Admin.area.ajaxshow",["post"=>$post,"area_name"=>$area_name,"area_data"=>$area_data]);
        }
        return view("Admin.area.show",["post"=>$post,"area_name"=>$area_name,"area_data"=>$area_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // 添加战神
        return view("Admin.area.insert");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaPost $request)
    {
        //
        $post = request()->except("_token");
        if ($request->hasFile('area_img')){ 
            $post["area_img"] = uploads("area_img");
        }
        $desc = AreaModel::insert($post);
        if($desc){
            return redirect("/area/index");
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = AreaModel::where("area_id","=",$id)->first();
        return view("Admin.area.find",["post"=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAreaPost $request, $id)
    {
        //
        $post = request()->except("_token");
        $desc = AreaModel::where("area_id","=",$id)->update($post);
        if($desc !==false){
            return redirect("/area/index"); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $area_img= AreaModel::where("area_id","=",$id)->value("area_img");
        if($area_img){
            unlink(storage_path("app/".$area_img));
        }
        $post = AreaModel::where("area_id","=",$id)->delete();
        if($post){
            return redirect("/area/index");
        }
    }
}
