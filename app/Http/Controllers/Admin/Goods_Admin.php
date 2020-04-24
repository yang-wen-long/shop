<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\CurdModel;
//表单验证
use App\Http\Requests\StoreCurdPost;

class Goods_Admin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $pageSize = config("app.pageSize");
       $all = CurdModel::paginate($pageSize);
       // $all["admin_pwd"] = decrypt($all["admin_pwd"]);
       return view("Admin/admin/show",["all"=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("Admin/admin/insert");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(StoreCurdPost $request)
    {
        //
        $post = request()->except("_token");
        $post["admin_pwd"] = encrypt($post["admin_pwd"]);
        $post["admin_time"] =time();
        $name = CurdModel::insert($post);
        if($name){
            request()->session()->put("yang",["admin_name"=>$post["admin_name"],"admin_pwd"=>$post["admin_pwd"]]);
            return redirect("/admin/index"); 
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
        $all = CurdModel::where("admin_id","=",$id)->first();
        return view("Admin/admin/find",["all"=>$all]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = request()->except("_token");
        $post["admin_pwd"] = encrypt($post["admin_pwd"]);
        $post["admin_time"] =time();
        $all = CurdModel::where("admin_id","=",$id)->update($post);
        if($all !==false){
            return redirect("/admin/index");
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
        $post = CurdModel::where("admin_id","=",$id)->delete();
        if($post){
            return redirect("/admin/index");
        }
    }
}
