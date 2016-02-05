@extends('backend.layouts.master')

@section('page-header')
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{bower('bootstrap-table/dist/bootstrap-table.min.css')}}">
    <h1>
        {!! app_name() !!}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">市场调查列表</h3>
            <div class="box-tools pull-right">
                @include('backend.market.includes.partials.header-buttons')
            </div>
        </div>
        <div class="box-body">
            <table id="table"
                   data-url="market/data"
                   data-toggle="table"
                   data-cookie="true"
                   data-search="true"
                   data-cookie-id-table="order"
                   data-side-pagination="server"
                   data-pagination="true"
                   data-page-size="20"
                   data-page-list="[20, 50, 100]"
                   data-pagination-first-text="第一页"
                   data-pagination-pre-text="上一页"
                   data-pagination-next-text="下一页"
                   data-pagination-last-text="最后一页"
                   data-sort-order="desc"
                   data-show-refresh="true"
                   data-show-toggle="true"
                   data-show-columns="true"
                   data-click-to-select="true"
                   data-query-params="getQueryParams"
                   data-search-on-enter-key="true">
                <thead>
                <tr>
                    <th data-field="state" data-checkbox="true"></th>
                    <th data-field="id">ID</th>
                    <th data-field="title1">名称</th>
                    <th data-field="cb_price">成本价</th>
                    <th data-field="sc_price">市场价</th>
                    <th data-field="rank">排名</th>
                    <th data-field="investigators">调查员</th>
                    <th data-field="amount">数量</th>
                    <th data-field="status" data-formatter="status">审批状态</th>
                    <th data-field="action" data-formatter="actionFormatter">操作</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
    @section('after-scripts-end')
            <!-- Latest compiled and minified JavaScript -->
    <script src="{{bower('bootstrap-table/dist/bootstrap-table.min.js')}}"></script>

    <!-- Latest compiled and minified Locales -->
    <script src="{{bower('bootstrap-table/dist/locale/bootstrap-table-zh-CN.min.js')}}"></script>
    <script src="{{bower('bootstrap-table/dist/extensions/cookie/bootstrap-table-cookie.js')}}"></script>
    <script src="{{asset('js/backend/jquery.form.js')}}"></script>
    <script>
        var $table = $('#table'),
                $button = $('#button'),
                $ok = $('#ok');
        //设置table
        $table.bootstrapTable({

        });
        //点击执行搜索
        $ok.click(function () {
            $table.bootstrapTable('refresh');
        });
        //获取所有选中选项
        function getIdSelections() {
            return $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
        }
        function clearanceState(value) {
            var clearance_state = '';
            switch (value){
                case '0':
                    clearance_state = '未放行';
                    break;
                case '1':
                    clearance_state = '查验';
                    break;
                case '2':
                    clearance_state = '已放行';
                    break;
                default:
                    clearance_state = '未放行';
            }
            return clearance_state;
        }
        //到港状态
        function status(value) {
            var status = '';
            switch (value){
                case '1':
                    status = '已同意';
                    break;
                case '2':
                    status = '已否决';
                    break;
                default:
                    status = '未审核';
            }
            return status;
        }

        //获取操作button
        function actionFormatter(value, row, index) {
            var status_button =  '@permission('admin-market-check')<a href="javascript:void(0);" class="btn btn-xs btn-success" onclick="action(1,'+row['id']+')" ><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="同意">同意</i></a><a href="javascript:void(0);" class="btn btn-xs btn-success" onclick="action(2,'+row['id']+')" ><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="否决">否决</i></a>@endauth';
            if(row.status == 1){
                var status_button =  '<a href="javascript:void(0);" class="btn btn-xs btn-success" disabled="disabled" ><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="已同意">已同意</i></a>';
            }else if((row.status == 2)){
                var status_button =  '<a href="javascript:void(0);" class="btn btn-xs btn-success" disabled="disabled" ><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="已否决">已否决</i></a>';
            }
            var edit_button =  '@permission('admin-market-check')<a href="/admin/market/'+row.id+'/edit" class="btn btn-xs btn-success" onclick="importSubOrder('+row['id']+')"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="编辑">编辑</i></a>@endauth';
            var delete_button = '<a href="javascript:void(0);" data-method="delete" disabled="disabled" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除">删除</i></a>';
            return edit_button+delete_button+status_button;
        }
        //返回搜索参数值
        function getQueryParams(params) {
            $('#toolbar').find('input[name]').each(function () {
                params[$(this).attr('name')] = $(this).val();
            });
            $('#toolbar').find('select[name]').each(function () {
                params[$(this).attr('name')] = $(this).val();
            });
            return params; // body data
        }

        function showRequest() {
            $("#validation-errors").hide().empty();
            return true;
        }
        function showResponse(response)  {
            if(response.success == false)
            {
                $('#upload_button').html('保存');
                var responseErrors = response.errors;
                $.each(responseErrors, function(index, value)
                {
                    if (value.length != 0)
                    {
                        $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                    }
                });
                $("#validation-errors").show();
                $('#upload_button').html('重新上传');
                $('#upload_button').removeAttr('disabled');
//                window.setTimeout(function(){} ,4000);
//                location.reload();
            }else{
                //上传成功
                sweetAlert('上传成功');
                window.setTimeout(function(){ } ,3000);
                location.reload();
            }
        }
        function action(status,id){
            $.ajax({
                'type': 'POST',
                'url': '{{route('admin.market.action')}}',
                'data':{'status':status,'_token':'{{csrf_token()}}','id':id},
                'success': function(data){
                    window.location.reload();
                }
            })
        }
    </script>
@endsection
@endsection