@extends('admin.layouts.app')
@section('title', '控制台')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>自定义菜单</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

<div class="container-fluid row animated fadeInRight">
    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    主菜单
                    <div class="pull-right">
                        <a href="{{ admin_url('menu/create') }}" type="button" class="btn btn-xs btn-success">
                            <i class="glyphicon glyphicon-plus"></i> 添加
                        </a>

                        <a class="btn btn-xs btn-primary" href="{{ admin_url('menu/publish') }}">
                            <i class="glyphicon glyphicon-globe"></i> 发布到微信
                        </a>
                    </div>

                </div>
                <div class="panel-body">
                    <div class="list-group">
                        {{--@foreach($wxMenus as $menu)
                            <a href="{{ asset('backed/wxmenu') }}?wxMenu={{ $menu->id }}" class="list-group-item {{ $menu->id == $wxMenu->id ? 'active' : '' }}">
                                <p>{{ $menu->name }} <span class="label label-default">{{ $menu->type == 'click' ? '点击事件' : '跳转链接' }}</span></p>
                                <p>
                                    @if($menu->type == 'click')
                                        Key : <code>{{ $menu->action }}</code>
                                    @else
                                        Url : <code>{{ $menu->action }}</code>
                                    @endif
                                </p>
                            </a>
                        @endforeach--}}
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@stop

@section('scripts')
<script type="text/javascript">
    /**
     * 创建菜单
     *
     * @param {Object}   $request
     * @param {Function} $callback
     */
    var createMenu = function ($request, $callback) {
        Util.request('POST', 'menu/store', $request, $callback);
    }
</script>
@stop