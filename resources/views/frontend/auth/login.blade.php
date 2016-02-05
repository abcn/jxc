@extends('frontend.layouts.master')

@section('content')

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.frontend.auth.login_box_title') }}</div>

                <div class="panel-body">

                    {!! Form::open(['url' => 'login', 'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            {!! Form::label('name', '用户名', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => '用户名']) !!}
                            </div><!--col-md-6-->
                        </div><!--form-group-->

                        <div class="form-group">
                            {!! Form::label('password', '密码', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => '密码']) !!}
                            </div><!--col-md-6-->
                        </div><!--form-group-->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('remember') !!} {{ trans('labels.frontend.auth.remember_me') }}
                                    </label>
                                </div>
                            </div><!--col-md-6-->
                        </div><!--form-group-->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'btn btn-primary', 'style' => 'margin-right:15px']) !!}

                                {!! link_to('password/reset', trans('labels.frontend.passwords.forgot_password')) !!}
                            </div><!--col-md-6-->
                        </div><!--form-group-->

                    {!! Form::close() !!}

                    <div class="row text-center">
                        {!! $socialite_links !!}
                    </div>
                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->

@endsection