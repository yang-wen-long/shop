<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\CurdModel;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    // public function index(){
    //         $admin_name = Cookie::get("admin_name");
    //         $admin_pwd = Cookie::get("admin_pwd");
    //     if($admin_name && $admin_pwd){
    //         $admin_name = Cookie::get("admin_name");
    //         $admin_pwd = Cookie::get("admin_pwd");
    //     }else{

    //         $admin_name="";
    //         $admin_pwd="";  
    //     }
    //     return view("Admin.login",["admin_name"=>$admin_name,"admin_pwd"=>$admin_pwd]);
    // }
    public function login()
    {
        //接值
        $name = request()->except("_token");
        // dd($name);
        //判断用户名是否存在
        $adminuser = CurdModel::where("admin_name","=",$name["admin_name"])->first();
        if(!$adminuser){
            return redirect("/login")->with("get","*用户名或密码不能为空");   
        }
        if(decrypt($adminuser->admin_pwd) != $name["admin_pwd"]){
            return redirect("/login")->with("get","*用户名或密码不对");        
        }
        if($name["checked"] == "yang"){
            $admin_name = $name["admin_name"];
            $admin_pwd  = $name["admin_pwd"];
            // dd($admin_pwd);
            $time= 7*24*60;
            $adminuser['admin_pwd'] = decrypt($adminuser->admin_pwd);
            Cookie::queue("adminuser",$adminuser,$time);
        }
        //存session
        session(["yang"=>$adminuser]);
        //跳转方法
        return redirect("/goods");
       
    }
}
