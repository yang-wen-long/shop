    @extends('layouts.shop')
    @section('title', '所有的商品')
    @section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select">
      <li class="pro-selCur"><a href="javascript:;">新品</a></li>
      <li><a href="javascript:;">销量</a></li>
      <li><a href="javascript:;">价格</a></li>
     </ul><!--pro-select/-->
     <div class="prolist">
      @foreach($all as $kk) 
      <dl>
       <dt><a href="{{url('/List/'.$kk->goods_id)}}"><img src="http://uploads.1910.com/{{$kk->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">{{$kk->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$kk->goods_price}}</strong></div>
        <div class="prolist-yishou"><span>共有</span> <em>:{{$kk->goods_num}}</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
     </div><!--prolist/-->
     @include("Index.public.foot");
     @endsection