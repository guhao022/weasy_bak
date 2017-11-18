@extends('admin.layouts.app')
@section('title', '控制台')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>添加{{ isset($menu) ?  ' <code>' . $menu->name . '</code> 子' : '一级'}}菜单</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="container-fluid row animated fadeInRight">
        <hr>
        <div class="col-md-5 ibox">
            <div class="ibox-content">

            <form class="form-group" id="savemenu" action="{{ isset($menu) ? admin_url("menu/store/{$menu->id}") : admin_url('menu/store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="control-label">菜单名称：</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                    <label class="control-label">菜单类型：</label>
                    <div>
                        <div class="checkbox-inline">
                            <label>
                                <input type="radio" name="type" value="click" {{ old('type') == 'click' ? 'checked' : '' }}>
                                点击事件
                            </label>
                        </div>
                        <div class="checkbox-inline">
                            <label>
                                <input type="radio" name="type" value="view" {{ old('type') == 'view' ? 'checked' : '' }}>
                                跳转链接
                            </label>
                        </div>
                    </div>
                    @if ($errors->has('type'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('action') ? ' has-error' : '' }}">
                    <label class="control-label">菜单动作：</label>
                    <input class="form-control" type="text" name="action" value="{{ old('action') }}" placeholder="点击事件填写key，跳转链接填写url">
                    @if($errors->has('action'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('action') }}</strong>
                                </span>
                    @endif
                </div>

                <hr>
                <button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-saved"></i> 保存</button>
            </form>
            </div></div>
        </div>


@stop