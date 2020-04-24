    @extends('layouts.shop')
    @section('title', '加入购物车')
    @section('content')
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
@foreach($all as $k=>$error)
<div class="dingdanlist">
  <table goods_id={{$error->goods_id}}>
    @if($k == 0)
    <tr>
    <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1"  id="addbox"/> 全选</a></td>
    </tr>
    @endif
    <tr>
      <td width="4%">
        <input type="checkbox" class="box" catr_id="{{$error->catr_id}}" id="checked" />
      </td>
      <td class="dingimg" width="15%">
        <img src="http://uploads.1910.com/{{$error->goods_img}}" />
      </td>
      <td width="50%">
        <h3>{{$error->goods_name}}</h3>
        <time>下单时间：{{date("Y-m-d",$error->addtime)}}</time>
      </td>
      <td align="right">
        <input type="text" id="buy_{{$error->catr_id}}" price_id="{{$error->goods_price}}" catr="{{$error->catr_id}}" goods_id="{{$error->goods_id}}" class="spinnerExample"/>
      </td>
    </tr>
    <tr>
      <th colspan="4">
        <b class="orange" id="inclode">单价:￥{{$error->goods_price}}</b>
        小计:<strong class="orange" id="goods_price">￥{{$error->goods_price * $error->buy_num}}</strong>
      </th>
    </tr>
  </table>
</div><!--dingdanlist/-->
@endforeach
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="total">¥0</strong></td>
       <td width="40%"><a href="javascript:;" id="delete" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
<script>
  $(document).ready(function(){
    //单选
    $(document).on("click","#checked",function(){
      var _this = $(this);
      var checked = _this.prop("checked");
      getTotalMoney();
    });
    //全选和反选
    $(document).on("click","#addbox",function(){
      var _this = $(this);
      var clicks = _this.prop("checked");
      $(".box").prop("checked",clicks);
      //调用方法
      getTotalMoney();
    });
    //获取商品的价格
    function getTotalMoney(){
      var box = $(".box:checked");
      if(box.length == 0){
        $("#total").html("￥"+0);
        return false;
      }else{
        var money = 0;
        box.each(function(index){
           var _this=$(this);
           var xj = _this.parents("table").find("strong").html();
           xj = xj.trim().substr(1,xj.length);
           money += Number(xj);
        });
        $("#total").html("￥"+money);
      }
    }
    //点击的选中复选框
    function checkedBox(_this){
      // _this.parents("tr").find(".box").prop("checked",true);
      var name = _this.parents("table").find(".box").prop("checked",true);
    }
    //减号的方法
    $(".decrease").click(function(){
      //获取点击的对象
      var _this=$(this);
      //获取点击对象的值
      var buy_num=parseInt(_this.next("input").val());
      //购物车id
      var catr_id = parseInt(_this.next("input").attr("catr"));
      //商品id
      var goods_id = parseInt(_this.next("input").attr("goods_id"));
      if(buy_num < 1){
        _this.next().val(1);
        alert("商品不能小于1件");
        return false;
      }
      //获取小计
      var price_id = parseInt(_this.next("input").attr("price_id"));
      var jx = price_id * buy_num;
      _this.parents("table").find("strong").html("￥"+jx);
      // $("#goods_price")_this.html("￥"+jx);
      //ajax进行传值
      CheckNone(buy_num,goods_id,catr_id);
      //叫点击的复选框进行选中
      checkedBox(_this);
      //获取点击的商品价格
      getTotalMoney();
    });
    //加号的方法
    $(".increase").click(function(){
      //获取点击的对象
      var _this=$(this);
      //获取点击对象的值
      var buy_num=parseInt(_this.prev("input").val());
      //获取点击的对象的库存
      var catr_id=parseInt(_this.prev("input").attr("catr"));
      // //获取点击的对象的id
      var goods_id=parseInt(_this.prev("input").attr("goods_id"));
      //（特殊标记）
      //（判断去除要加请想办法）
      //（特殊标记）
      //获取小计
      var price_id = parseInt(_this.prev("input").attr("price_id"));
      var jx = price_id * buy_num;
      _this.parents("table").find("strong").html("￥"+jx);
      // $("#goods_price").html("￥"+jx);
      //ajax进行传值
      CheckNone(buy_num,goods_id,catr_id);
      //叫点击的复选框进行选中
      checkedBox(_this);
      //获取点击的商品价格
      getTotalMoney(); 
    });
    //输入框的购买条数
    $(".value").click(function(){  
      //获取点击的对象
      var _this=$(this);
      //获取点击对象的值
      var buy_num=parseInt(_this.val());
      //获取点击的对象的库存
      var catr_id=parseInt(_this.attr("catr"));
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
      }
      //（特殊标记）
      //（判断去除要加请想办法）
      //（特殊标记）
      //获取小计
      var price_id = parseInt(_thisattr("price_id"));
      var jx = price_id * buy_num;
      _this.parents("table").find("strong").html("￥"+jx);
      //ajax进行传值
      CheckNone(buy_num,goods_id,catr_id);
      //叫点击的复选框进行选中
      checkedBox(_this);
      //获取点击的商品价格
      getTotalMoney();  
    });
    //ajax进行传值
    function CheckNone(buy_num,goods_id,catr_id){
      if(buy_num==""&&goods_id==""&&catr_id==""){
        alert("数据有误");
        return false;
      }
      $.get("/update",{buy_num:buy_num,goods_id:goods_id,catr_id:catr_id},function(index){
        if(index.error_no == 1){
          alert(index.error_msg);
        }
      },"json");
    }
    $("#delete").click(function(){
      var _this=$(this);
      var box=$(".box:checked");
      if(box.length == 0){
        alert("请选择一条数据，进行购买！");
        return false;
      }
        //给个空的字符串
        var str='';
        //循环得到数组
        box.each(function(index){
          str += goods_id = $(this).parents("table").attr("goods_id")+",";
        });
        var str=str.trim();
        var str=str.substr(0,str.length-1);
      location.href="/confirmorder?str="+str;
    });
  });
</script>
@endsection