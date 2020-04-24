@extends('layouts.shop')
@section('title', '登录')
@section('content')
<header>
  <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
  <div class="head-mid">
      <h1>会员注册</h1>
  </div>
</header>
<div class="head-top">
    <img src="/static/index/images/head.jpg" />
</div><!--head-top/-->
  <form action="{{url('/user')}}" method="post" id="submit" class="reg-login">
    @csrf
    <h3>还没有珠宝账号？点此<a class="orange" href="{{url('/reg')}}">注册</a></h3>
      <font color=red>{{session("get")}}</font>
      <input type="hidden" name="refer" value="{{request()->refer}}" placeholder="输入手机号码或者邮箱号" />
    <div class="lrBox">
      <div class="lrList">
        <input type="text" name="user_name" id="name" placeholder="输入手机号码或者邮箱号" />
        <span id="spanname"></span>
      </div>
      <div class="lrList">
        <input type="text" name="user_pwd" id="pwd" placeholder="输入密码" />
        <span id="spanpwd"></span>
      </div>
      </div><!--lrBox/-->
      <div class="lrSub">
        <input type="submit" value="立即登录" />
      </div>
    </div>
  </form><!--reg-login/-->
  <script>
    $(document).ready(function(){
      $("#submit").submit(function(){
          var name = $("#name").val();
          var pwd = $("#pwd").val();
          if(name == '' || pwd == ''){
            $("#spanname").html("<font color=red>*账户不能为空</font>");
            $("#spanpwd").html("<font color=red>*密码不能为空</font>");
            return false;
          }else{
            return true;
          }
      });
    });
  </script>
@include("Index.public.foot");
@endsection
