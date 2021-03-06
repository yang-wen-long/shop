    @extends('layouts.shop')
    @section('title', '确认购物车')
    @section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <div class="dingdanlist">
      <table>
       <tr>
        <td class="dingimg" width="75%" colspan="2">新增收货地址</td>
        <td align="right">
          <a href="{{url('/address')}}"><img src="/static/index/images/jian-new.png" /></a>
        </td>
       </tr> 
       @foreach($desc as $dec) 
         <tr>
            <td>收货人：{{$dec->address_name}}</td>
            <td>手机号：{{$dec->address_detail}}</td>
         </tr>

       @endforeach
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">支付方式</td>
        <td align="right"><span class="hui">网上支付</span></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">是否需要开发票</td>
        <td align="right"><a href="javascript:;" class="orange">是</a> &nbsp; <a href="javascript:;">否</a></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票内容</td>
        <td align="right"><a href="javascript:;" class="hui">请选择发票内容</a></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr>
       @foreach($all as $error)
       <tr>
        <td class="dingimg" width="15%"><img src="http://uploads.1910.com/{{$error->goods_img}}"/></td>
        <td width="50%">
         <h3>{{$error->goods_name}}</h3>
         <time>下单时间：{{date("Y-m-d H:i:d",$error->addtime)}}</time>
        </td>
        <td align="right"><span class="qingdan">X {{$error->buy_num}}</span></td>
       </tr>
       <tr>
        <th colspan="3"><strong class="orange">¥{{$error->goods_price}}</strong></th>
       </tr>
       @endforeach

       <tr>
        <td class="dingimg" width="75%" colspan="2">商品金额</td>
        <td align="right"><strong class="orange">¥{{$error->goods_price * $error->buy_num}}</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">折扣优惠</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">抵扣金额</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">运费</td>
        <td align="right"><strong class="orange">¥{{$error->discounts}}</strong></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     
     
    </div><!--content/-->
    
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥{{$error->goods_price * $error->buy_num + $error->discounts}}</strong></td>
       <td width="40%"><a href="{{url('/seccess')}}" class="jiesuan">提交订单</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
@endsection