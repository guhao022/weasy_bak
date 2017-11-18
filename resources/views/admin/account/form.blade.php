@extends('admin.account.app')
@section('title', '新增公众号')

@section('content')
    <div class="container ibox animated fadeInRight">
        <div class="page-header">
            <h2 id="nav">@if(isset($account)) 编辑公众号 @else 添加公众号 @endif</h2>
        </div>
        <div class="well bs-component ibox-content">

            <form method="POST" action="{{isset($account)? admin_url('account/update/'.$account->id): admin_url('account/create')}}" accept-charset="UTF-8" class="form-horizontal">
                {{csrf_field()}}
                <div class="form-group ">
                    <label for="name" class="col-sm-2 control-label">* 公众号名称</label>
                    <div class="col-sm-6">
                        <input class="form-control" value="{{isset($account) ? $account->name : old('name')}}" placeholder="例如：WEASY" name="name" type="text" id="name" required />
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group ">
                    <label for="original_id" class="col-sm-2 control-label">* 公众号原始Id</label>
                    <div class="col-sm-6">
                        <input class="form-control" value="{{isset($account) ? $account->original_id : old('original_id')}}" placeholder="请认真填写，错了不能修改。例如gh_gks84hksi90o" name="original_id" type="text" id="original_id" required />
                        @if ($errors->has('original_id'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group ">
                    <label for="wechat_account" class="col-sm-2 control-label">* 微信号</label>
                    <div class="col-sm-6">
                        <input class="form-control" value="{{isset($account) ? $account->wechat_account : old('wechat_account')}}" placeholder="例如：weasy" name="wechat_account" type="text" id="wechat_account" required />
                        @if ($errors->has('wechat_account'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('wechat_account') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group ">
                    <label for="app_id" class="col-sm-2 control-label">AppID（公众号）</label>
                    <div class="col-sm-6">
                        <input class="form-control" value="{{isset($account) ? $account->app_id : old('app_id')}}" placeholder="用于自定义菜单等高级功能" name="app_id" type="text" id="app_id" />
                        @if ($errors->has('app_id'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('app_id') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group ">
                    <label for="app_secret" class="col-sm-2 control-label">AppSecret </label>
                    <div class="col-sm-6">
                        <input class="form-control" value="{{isset($account) ? $account->app_secret : old('app_secret')}}" placeholder="用于自定义菜单等高级功能" name="app_secret" type="text" id="app_secret" />
                        @if ($errors->has('app_secret'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('app_secret') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group ">
                    <label for="account_type" class="col-sm-2 control-label">微信号类型 </label>
                    <div class="col-sm-6">
                        <select class="form-control bs-select-hidden" placeholder="认证服务号是指每年向微信官方交300元认证费的公众号" id="account_type" name="account_type">
                            @if(isset($account))
                                <option value="1">订阅号</option>
                                <option value="2">服务号</option>
                            @else
                                <option value="1" @if(old('account_type') == 1) selected @endif>订阅号</option>
                                <option value="2" @if(old('account_type') == 2) selected @endif>服务号</option>
                            @endif
                        </select>
                        @if ($errors->has('account_type'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('account_type') }}</strong>
                                    </span>
                        @endif

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-8 col-lg-offset-2">
                        <input class="btn btn-success" type="submit" value="提交" />
                    </div>
                </div>
            </form>

        </div>
    </div>
@stop

