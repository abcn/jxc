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
                   data-page-size="500"
                   data-page-list="[500, 1000]"
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
                    <th data-field="image">图片</th>
                    <th data-field="title">名称</th>
                    <th data-field="cb_price">成本价</th>
                    <th data-field="sc_price">市场价</th>
                    <th data-field="rank">排名</th>
                    <th data-field="investigators">调查员</th>
                    <th data-field="amount">数量</th>
                    <th data-field="status">审批状态</th>
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
        function portState(value) {
            var port_state = '';
            switch (value){
                case '1':
                    port_state = '未到港';
                    break;
                case '2':
                    port_state = '清关中';
                    break;
                case '3':
                    port_state = '已到港';
                    break;
                default:
                    port_state = '未到港';
            }
            return port_state;
        }
        //报关状态
        function declearState(value) {
            return value ? '已报关' : '未报关';
        }
        //获取操作button
        function actionFormatter(value, row, index) {

            if(row.import_state == 1){
                var import_button =  '<a href="order/'+row['id']+'/sub" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="查看分单">查看分单</i></a></i>';
                var import_ID_button = '<a href="order/'+row['id']+'/ID" class="btn btn-xs btn-success"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="导出身份证" id="export">导出身份证</i></a> ';
            }else{
                var import_button =  '<a href="javascript:void(0);" class="btn btn-xs btn-success" onclick="importSubOrder('+row['id']+')"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="导入">导入</i></a></i>';
                var import_ID_button = '';
            }
            var delete_button = '<a href="order/'+row['id']+'/destroy" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除">删除</i></a>';
            return import_button+import_ID_button+delete_button;
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
        //导入分单函数
        //
        function importSubOrder(id){
            $('#import').modal('show');
            //赋值订单ID
            $('#order_id').val(id);
        }
        //提交分单
        $(function (){
            //点
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json'
            };
            $("#upload_button").click(function() {
                var loader = '<div class="loader-inner ball-clip-rotate">'+
                        '<div></div>'+
                        '</div>';
                $('#upload_button').html(loader);
                //disable
                $('#upload_button').attr('disabled','disabled');
                $('#upload_form').ajaxForm(options).submit();
                //执行loader css
            });
        })
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
    </script>
@endsection
@endsection