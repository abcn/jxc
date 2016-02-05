    <div class="pull-right" style="margin-bottom:10px">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              市场调查管理 <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
              <li><a href="{{ route('admin.market.index') }}">所有调查</a></li>
            {{--创建文章--}}
            @permission('admin-market-create')
                <li><a href="{{ route('admin.market.create') }}">新增市场调查</a></li>
            @endauth
            {{--end创建文章--}}

            <li class="divider"></li>
          </ul>
        </div><!--btn group-->
    </div><!--pull right-->

    <div class="clearfix"></div>