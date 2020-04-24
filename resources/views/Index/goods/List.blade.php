    @extends('layouts.shop')
    @section('title', '商品详情')
    @section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      @foreach($add["goods_imgs"] as $kk)
      <img src="http://uploads.1910.com/{{$kk}}" />
      @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$add->goods_price}}</strong></th>
       <td>
        <input type="text" value="1" goods_id="{{$add->goods_id}}" id="{{$add->goods_num}}" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$add->goods_name}}</strong>
        <p class="hui">{{$add->goods_desc}}</p>
        <p>当前访问量是：{{$visit}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="http://uploads.1910.com/{{$add->goods_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td>
        <a href="javascript:void(0);" id="update" goods_id="{{$add->goods_id}}">加入购物车</a>
       </td>
      </tr>
     </table>
    </div><!--maincont-->
<script>
  $(document).ready(function(){
    //减号的方法
    $(".decrease").click(function(){
      //获取点击的对象
      var _this=$(this);
      //获取点击对象的值
      var buy_num=parseInt(_this.next("input").val());
      //获取点击的对象的库存
      var goods_num=parseInt(_this.next("input").attr("id"));
      // //获取点击的对象的id
      var goods_id=parseInt(_this.next("input").attr("goods_id"));
      if(buy_num < 1){
        _this.next().val(1);
        alert("商品不能小于1件");
        return false;
      }       
    });
    //加号的方法
    $(".increase").click(function(){
      //获取点击的对象
      var _this=$(this);
      //获取点击对象的值
      var buy_num=parseInt(_this.prev("input").val());
      //获取点击的对象的库存
      var goods_num=parseInt(_this.prev("input").attr("id"));
      // //获取点击的对象的id
      var goods_id=parseInt(_this.prev("input").attr("goods_id"));
      if(buy_num > goods_num){
        _this.prev().val(goods_num);
        alert("该商品库存不足");
        return false;
      }       
    });
    //输入框的购买条数
    $(".value").blur(function(){
      //获取点击的对象
      var _this=$(this);
      //获取点击对象的值
      var buy_num=parseInt(_this.val());
      //获取点击的对象的库存
      var goods_num=parseInt(_this.attr("id"));
      // //获取点击的对象的id
      var goods_id=parseInt(_this.attr("goods_id"));
      var reg = /^\d{1,}$/; 
      if(!reg.test(buy_num)){
          _this.val("1");
          alert("请填写正确的数字");
          return false;
      }else if(buy_num <= 1){
          _this.val("1");
          alert("购买的数量不能小于1");
          return false;
      }else if(buy_num > goods_num){
          _this.val(goods_num);
          alert("库存不足");
          return false;
      }
    });
    //添加购物车方法
    $("#update").click(function(){
        var _this = $(this);
        var goods_id = parseInt(_this.attr("goods_id"));
        var buy_num = parseInt($(".value").val());
        $.get("/getcatr",{"goods_id":goods_id,"buy_num":buy_num},function(index){
          if(index.error_no == 1){
            location.href="/login?refer="+window.location.href;
          }
          if(index.error_no == 2){
            alert(index.error_msg);
            return false;
          }
          if(index.error_no == 0){
            location.href="/CatrController";
          }
        },"json");
        
    });
  });
</script>
@include("Index.public.foot");
@endsection