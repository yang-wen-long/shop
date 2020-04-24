@extends('layouts.shop')
@section('title', '添加收货地址')
@section('content')
<header>
  <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
  <div class="head-mid">
    <h1>收货地址</h1>
  </div>
</header>
<div class="head-top">
  <img src="/static/index/images/head.jpg" />
</div><!--head-top/-->
  <form action="{{url('/addlist')}}" method="post" id="submit" class="reg-login">
    @csrf
    <div class="lrBox">
    <div class="lrList">
      <input type="text" name="address_name" id="name" placeholder="收货人" />
      <span id="spanname"></span>
    </div>
    <div class="lrList">
      <input type="text" name="address_detail" id="detail" placeholder="手机" />
      <span id="spandetail"></span>
    </div>
    <div class="lrList">
      <select name="province_id" id="province">
        <option value="0">省份</option>
        @foreach($area as $all)
        <option value="{{$all->id}}">{{$all->name}}</option>
        @endforeach
      </select>
      <span id="spanprovince"></span>
    </div>
    <div class="lrList">
      <input type="text" name="address_mobile" id="mobile" placeholder="详细地址" />
      <span id="spanmobile"></span>
    </div>
    <div class="lrList2">
      <input type="checkbox" name="is_default" value="1" checked>
       <button>设为默认</button>
     </div>
    </div><!--lrBox/-->
    <div class="lrSub">
       <input type="submit" value="保存" />
    </div>
</form><!--reg-login/-->
<script>
  //页面加载方法
  $(document).ready(function(){
    //市区
    $(document).on("change","#province",function(){
      $("#province").nextAll().remove();
      var name=$(this).val();
      $("#province")
      if(name == 0){
        return false;
      }
      $.get("/ress",{name:name},function(index){
          //判断是否有错
          if(index.error_no == 1){
            //获取后台传过来的值
            var date = index.data;
            // console.log(data);
            var str = "<div class='lrList'><select id='city' name='city_id'><option value='0'>请选择市...</option>";
            for(var i in date){
              str +="<option value="+date[i]['id']+">"+date[i]["name"]+"</option>";
            }
            str +="</select></div>";
            $("#province").next().remove();
            $("#province").after(str);
          }else{
            alert(index.error_msg);
          }
      },"json");
    });
    //县区
    $(document).on("change","#city",function(){
      $("#city").nextAll().remove();
      var name=$(this).val();
      $("#city")
      if(name == 0){
        return false;
      }
      $.get("/ress",{name:name},function(index){
          //判断是否有错
          if(index.error_no == 1){
            //获取后台传过来的值
            var date = index.data;
            // console.log(data);
            var str = "<div class='lrList'><select id='area' name='area_id'><option value='0'>请选择区县...</option>";
            for(var i in date){
              str +="<option value="+date[i]['id']+">"+date[i]["name"]+"</option>";
            }
            str +="</select></div>";
            $("#city").next().remove();
            $("#city").after(str);
          }else{
            alert(index.error_msg);
          }
      },"json");
    });
    //收货人
    $(document).on("blur","#name",function(){
      var name=$(this).val();
      // var reg=/^[\x7f-\xffA-Za-z0-9\s]+$/;
      if(name==''){
        $("#spanname").html("<font color=red>*收货人不能为空</font>");
        return false;
      }
      // else if(!reg.test(name)){
      //   alert("请填写正确的格式");
      //   return false;
      // }
    });
    //手机号
    // $(document).on("blur","#detail",function(){
    //   var detail=$(this).val();
    //   var reg=/^[0-9]{11}$/;
    //   if(detail==''){
    //     $("#spandetail").html("<font color=red>*手机号不能为空</font>");
    //     return false;
    //   }else if(!reg.test(name)){
    //     $("#spandetail").html("<font color=red>*手机号格式不对</font>");
    //     return false;
    //   }else{
    //     $("#spandetail").html("");
    //   }
    // });
    //收货地址
    $(document).on("blur","#mobile",function(){
      var mobile=$(this).val();
      // var reg=/^[0-9]{11}$/;
      if(mobile==''){
        $("#spanmobile").html("<font color=red>*收货地址不能为空</font>");
        return false;
      }
      // else if(!reg.test(name)){
      //   $("#spandetail").html("<font color=red>*收货地址格式不对</font>");
      //   return false;
      // }
    });
    //提交表单
    $("#submit").submit(function(){
       var name = $("#name").val();
       var detail = $("#detail").val();
       var mobile = $("#mobile").val();
       var province = $("#province").val();
       if(name==''&&detail==''&&province==0 &&mobile==''){
          $("#spanname").html("<font color=red>*收货人不能为空</font>");
          $("#spandetail").html("<font color=red>*手机号不能为空</font>");
          $("#spanmobile").html("<font color=red>*详细地址不能为空</font>");
          return false;
       }
        return true;
    });
  });
</script>
@include("Index.public.foot");
@endsection