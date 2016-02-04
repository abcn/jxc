<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="{{asset('css/frontend/reset.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/frontend/goods_info.css')}}" rel="stylesheet" type="text/css">
<title>无标题文档</title>
</head>

<body>
	<div class="header">
    	<b>您好：{{access()->user()->name}}</b>
        <a href="{!! route('auth.logout') !!}" class="btn btn-default btn-flat"> <span>退出</span></a>
    </div>
    <div class="goodsimg-box"><img src="" class="goods-img"></div>
    <ol type="1">
    	<li>{{$info->title1}}</li>
        <li>{{$info->title2}}</li>
        <li>成本价：￥{{$info->ch_price}}</li>
        <li>市场价：￥{{$info->sc_price}}（亚马逊FBA数据采集）</li>
        <li>排名：{{$info->rank}}</li>
        <li>产品说明：{{$info->desc}}</li>
        <li>阿里巴巴地址: {{$info->alibaba1}}</li>
        <li>调查员：{{$info->investigators}}</li>
        <li>数量：{{$info->amount}}</li>
    </ol>
    <div class="btn-box">
        @if($info->status == 0)
            <button type="button" name="agree-btn" class="agree-btn" onclick="action(1)">同意</button>
            <button type="button" name="disagree-btn" class="disagree-btn" onclick="action(2)">否决</button>
        @elseif($info->status == 1)
            <button type="button" name="agree-btn" class="agree-btn">已同意</button>
        @elseif($info->status == 2)
            <button type="button" name="disagree-btn" class="disagree-btn">已否决</button>
        @endif

    </div>
    <div class="footer">市场部</div>
</body>
<script src="{{asset('js/vendor/jquery/jquery-2.1.4.min.js')}}"></script>
<script>
    function action(status){
        $.ajax({
            'type': 'POST',
            'url': '{{route('market.action',$info->id)}}',
            'data':{'status':status,'_token':'{{csrf_token()}}'},
            'success': function(data){
                alert('ok');
            }
        })
    }
</script>
</html>
