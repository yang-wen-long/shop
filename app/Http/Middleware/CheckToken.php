<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //接值
        $session = session("yang");
        //判断session是否存在值
        if(!$session){
            //从cookie中取值
            $adminuser = request()->cookie('adminuser');
            //在判断是否存在
            if($adminuser){
                //进行赋值
                session(["adminuser"=>$adminuser]);
            }else{
                // dd($name);
                return redirect("/login");                
            }

        } 
        //原页面
        return $next($request);
    }
}
