@extends('layouts.shop')
@section('title', '注册')
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
  <form  action="{{url('/admin')}}" method="post" id="submitdeng" class="reg-login">
    <h3>已经有账号了？点此<a class="orange" href="{{url('login')}}">登陆</a></h3>
    @csrf
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="lrBox">
      <div class="lrList">
        <input type="text" name="user_name" id="name" placeholder="输入手机号码或者邮箱号" />
        <font color="red">{{session("get")}}</font>
        <span id="spanname"></span>
      </div>
      <div class="lrList2">
        <input type="text" name="user_code" id="code" placeholder="输入短信验证码" /> <button type="button">获取验证码</button>
        <span id="spancode"></span>
      </div>
      <div class="lrList">
        <input type="text" name="user_pwd" id="pwd" placeholder="设置新密码（6-18位数字或字母）" />
        <span id="spanpwd"></span>
      </div>
      <div class="lrList">
        <input type="text" name="user_pwds" id="pwds" placeholder="再次输入密码" />
        <span id="spanpwds"></span>
      </div>
      </div><!--lrBox/-->
      <div class="lrSub">
        <input type="submit" value="立即注册" />
      </div>
</form>
<script>
$(document).ready(function(){
    $("button").click(function(){
      var name = $("input[name='user_name']").val();
      var reg = /^1[3|5|6|7|8|9]\d{9}$/;
      if(reg.test(name)){
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        $.post("/sendSms",{mobile:name},function(index){
            alert(index.msg);
        },"json");
        return false;
      }
      //邮箱方法
      var emailreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
      if(emailreg.test(name)){
        $.get('/sendEmail',{email:name},function(index){
          alert(index.msg);
        },"json");
        return ;
      }
       alert("请填写正确的邮箱或手机号");
    });
    //账号判断
    $("#name").blur(function(){
        var data = $(this).val();
        var reg = /^1[3|5|6|7|8|9]\d{9}$/;
        var emailreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if(!reg.test(data) && !emailreg.test(data)){
          $("#spanname").html("<font color=red>*邮箱或手机号格式不对</font>");
        }else{
          $("#spanname").html("<font color=blue>√</font>");
        }
    });
    //验证码
    $("#code").blur(function(){
      var date = $(this).val();
      if(date == ''){
        alert("验证码不能为空");
        return false;
      }
      $.get('/senKed',{name:date},function(index){
          alert(index.msg);
      },'json');
    });
    //判断密码
    $("#pwd").blur(function(){
      var pwd = $(this).val();
      var reg = /^\d{5,11}$/;
      if(pwd == ""){
          $("#spanpwd").html("<font color=red>*不能为空</font>");
      }else if(!reg.test(pwd)){
          $("#spanpwd").html("<font color=red>*密码格式不对，格式为数字组成，最少是5位最大为11位</font>");
      }else{
          $("#spanpwd").html("<font color=blue>√</font>");
      }
    });
    //判断确认密码
    $("#pwds").blur(function(){
      var name = $(this).val();
      var data =$('#pwd').val();
      console.log(name);
      console.log(data);
      var reg = /^\d{5,11}$/;
      if(name == ""){
          $("#spanpwd").html("<font color=red>*不能为空</font>");
      }else if(!reg.test(name)){
          $("#spanpwds").html("<font color=red>*确认密码格式不对，格式为数字组成，最少是5位最大为11位</font>");
      }else if(name !== data){
          $("#spanpwds").html("<font color=red>*密码和确认密码不一致</font>");
      }else{
          $("#spanpwds").html("<font color=blue>√</font>");
      }
    });
    $("#submitdeng").submit(function(){
      var name = $("#name").val();
      if(name == ""){
          $("#spanname").html("<font color=red>*手机号不能为空</font>");
      }
      var code = $("#code").val();
      if(code == ""){
          $("#spancode").html("<font color=red>*短信验证码不能为空</font>");
      }
      var pwd = $("#pwd").val();
      if(pwd == ""){
          $("#spanpwd").html("<font color=red>*密码不能为空</font>");
      }
      var pwds = $("#pwds").val();
      if(pwds == ""){
          $("#spanpwds").html("<font color=red>*确认密码不能为空</font>");
      }
      if(name==""||code==""||pwd==""||pwds==""){
        return false;
      }else{
        return true;
      }
    });
});
</script>
@include("Index.public.foot");
@endsection