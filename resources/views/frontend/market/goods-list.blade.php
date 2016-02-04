<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>无标题文档</title>
<link href="{{asset('css/frontend/reset.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/frontend/goods_list.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('js/vendor/jquery/jquery-2.1.4.min.js')}}"></script>
</head>

<body>
	
	<div class="header">
    	<b>您好：{{access()->user()->name}}</b>
        <a href="{!! route('auth.logout') !!}" class="btn btn-default btn-flat"> <span>退出</span></a>
    </div>
    <ul class="goods-list">
        @foreach($products as $product)
            <a href="{{route('market.info',$product->id)}}">
                <li>
                    <img src="{{$product->image}}">
                    <h1>{{$product->title1}}</h1>
                </li>
            </a>
        @endforeach
    </ul>
    <div class="footer">市场部</div>
<script>
	var h=$("body").height();
	var s=h-66;
	$(".goods-list").height(s);
</script>
</body>
</html>
