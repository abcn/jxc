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
    {!! Form::model($market, ['route' => ['admin.market.update', $market->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'files' => true]) !!}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">编辑市场调查</h3>

            <div class="box-tools pull-right">
                @include('backend.market.includes.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
                {!! Form::label('image', '商品图片', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    @foreach($market->image as $image)
                        <img src="{{url($image->image)}}" />
                    @endforeach
                    {!! Form::file('images[]', array('multiple'=>true)) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('title1', '商品标题', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('title1', null, ['class' => 'form-control', 'placeholder' => '商品标题']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('cb_price', '成本价', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('cb_price', null, ['class' => 'form-control', 'placeholder' => '成本价']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('sc_price', '市场价', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('sc_price', null, ['class' => 'form-control', 'placeholder' => '市场价']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('desc', '产品说明', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::textarea('desc', null, ['class' => 'form-control', 'placeholder' => '市场价']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('rank', '排名', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('rank', null, ['class' => 'form-control', 'placeholder' => '排名']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('alibaba', '阿里巴巴', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('alibaba1', null, ['class' => 'form-control', 'placeholder' => '阿里巴巴']) !!}
                    {!! Form::text('alibaba2', null, ['class' => 'form-control', 'placeholder' => '阿里巴巴']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('investigators', '调查员', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('investigators', null, ['class' => 'form-control', 'placeholder' => '调查员']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('amount', '数量', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => '数量']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{route('admin.market.index')}}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
            </div>

            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('buttons.general.crud.create') }}" />
            </div>
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
    {!! Form::close() !!}
@endsection