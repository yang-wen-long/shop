<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//手机号验证
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
//方法
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
//注册方法
use App\model\Shop_user;
class LoginController extends Controller
{
    //登录方法
    public function Login(){
        $all = session("code");
        if($all){
            return redirect("/");
        }else{
            return view("Index/login");
        }
    	
    }
    //注册方法
    public function Reg(){
    	return view("Index/reg");
    } 
    //判断手机验证码
    public function sendSms(Request $request){
    	$mobile = Request()->mobile;
    	$reg = "/^1[3|5|6|7|8|9]\d{9}$/";
    	// dd(preg_match($reg,$mobile));
    	if(!preg_match($reg,$mobile)){
    		echo json_encode(["code"=>'00001',"msg"=>"账号有误"]);
    	}

    	$red = rand(100000,999999);
    	//调用短信
    	$res = $this->aendByMobile($mobile,$red);
    	if($desc["Message"] == "ok"){
    		session(["code"=>$red]);
    		echo json_encode(["code"=>'00000',"msg"=>"发送成功"]);
    	}
    }
    //用邮箱判断
    public function sendEmail(Request $request){
    	$email = $request->email;
    	$reg = '/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/';
    	if(!preg_match($reg,$email)){
    		echo json_encode(["code"=>'00001',"msg"=>"邮箱格式不对"]);
    	}
    	$res = rand(100000,999999);
    	$desc = $this->sendByEmail($email,$res);
    	session(["code"=>$res]);
    	echo json_encode(["code"=>'00000',"msg"=>"发送成功"]);
    }
	//短信验证
    public function aendByMobile($mobile,$red){
		AlibabaCloud::accessKeyClient('LTAI4GB3RJWnsQWbn3dSiekK', 'QXXqQ3ov51P59VLmrSnSkVDJDTheFv')
								->regionId('cn-hangzhou')
								->asDefaultClient();
		try {
			$result = AlibabaCloud::rpc()
								  ->product('Dysmsapi')
								  // ->scheme('https') // https | http
								  ->version('2017-05-25')
								  ->action('SendSms')
								  ->method('POST')
								  ->host('dysmsapi.aliyuncs.com')
								  ->options([
												'query' => [
												  'RegionId' => "cn-hangzhou",
												  'PhoneNumbers' => $mobile,
												  'SignName' => "阳阳小院",
												  'TemplateCode' => "SMS_185240307",
												  'TemplateParam' => "{code:$red}",
												],
											])
								  ->request();
			return $result->toArray();
		} catch (ClientException $e) {
			return $e->getErrorMessage() . PHP_EOL;
		} catch (ServerException $e) {
			return $e->getErrorMessage() . PHP_EOL;
		}
    }
    //邮箱验证
    public function sendByEmail($email,$res){
    	Mail::to($email)->send(new SendCode($res));
    } 
    //专门用来进判断
    public function senKed(Request $request){
    	$name = request()->name;
    	$names = session("code");
    	if($name !== "$names"){
    		echo json_encode(["code"=>'00001',"msg"=>"验证码有误"]);
    	}else{
    		echo json_encode(["code"=>'00000',"msg"=>"对"]);
    	}
    }
    //注册方法
    public function admin(){
    	$data = request()->except("_token","user_pwds");
        $def = Shop_user::where("user_name","=",$data["user_name"])->first();
        if($def){
            return redirect("/reg")->with("get","*用户名已存在！");
        }
    	if($data == ""){
    		return redirect("/reg");
    	}
    	$data["user_time"] = time();
    	//解密的方法（decrypt）加密的方法（encrypt）
    	$data["user_pwd"] = encrypt($data["user_pwd"]);
    	$click=Shop_user::where("user_name","=",$data["user_name"])->first();
    	$all = Shop_user::insert($data);
    	if($all){
    		session(["yang"=>$click]);
    		return redirect("/login");
    	}
    }
    //登录方法
    public function user(){
        $name = request()->except("_token");
        if($name == ""){
            return redirect("/login")->with("get","*用户名或密码不能为空");
        }
        $add = Shop_user::where("user_name","=",$name["user_name"])->first();
        // dd($add);
        if(!$add){
            return redirect("/login")->with("get","*用户名或密码不对");
        }
        // dd(decrypt($add->user_pwd));
        if(decrypt($add->user_pwd) !== $name["user_pwd"]){
            return redirect("/login")->with("get","*用户名或密码不对");
        }
        session(["code"=>$add]);
        if($name["refer"]){
            return redirect($name["refer"]);
        }
            return redirect("/");
    }   
    //我的
    public function getuser(){
        return view("Index/logon/userindex");
    }




























}
