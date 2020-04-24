    @extends('layouts.shop')
    @section('title', '首页')
    @section('content')
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
      <dl>
       <dt><a href="user.html"><img src="/static/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">珠宝首页</h1>
        <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
        @if(session("code") == '')
        <li><a href="{{url('/login')}}">登录</a></li>
        <li><a href="{{url('/reg')}}" class="rlbg">注册</a></li>
        @endif
        <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
      
      @foreach($slide as $v)
     <a href="{{url('/List/'.$v->goods_id)}}"><img src="http://uploads.1910.com/{{$v->goods_img}}" /></a>
      @endforeach
     </div><!--sliderA/-->
     <ul class="pronav">
        @foreach($desc as $k)
          <li><a href="prolist.html">{{$k->goods_name}}</a></li>
        @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">

      @foreach($desc as $a)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="{{url('/List/'.$a->goods_id)}}"><img src="http://uploads.1910.com/{{$a->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="{{url('/List/'.$a->goods_id)}}">{{$a->goods_name}}</a><span>已售：{{$a->goods_price}}</span></dd>
        <dd class="ip-price"><strong>¥{{$a->goods_price}}</strong></dd>
       </dl>
      </div>
      @endforeach

      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     <div class="prolist">
      @foreach($desc as $aa)
      <dl>
       <dt><a href="{{url('/List/'.$aa->goods_id)}}"><img src="http://uploads.1910.com/{{$aa->blog_logo}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('/List/'.$aa->goods_id)}}"></a>{{$aa->blog_name}}</h3>
        <div class="prolist-price"><strong>{{$aa->blog_url}}</strong> <span></span></div>
        <div class="prolist-yishou"><span>介绍</span> <em>{{$aa->blog_desc}}</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/static/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     @include("Index.public.foot");
     @endsection