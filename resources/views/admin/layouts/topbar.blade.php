<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">欢迎进入 {{ config('app.name', 'Laravel') }} 后台管理系统</span>
            </li>

            @if(!$global->accounts->isEmpty() && !empty($global->current_account))
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            @if($global->current_account) <i class="fa fa-weixin"></i>  {{ $global->current_account->name }} @endif
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($global->accounts as $account)
                                @if($global->current_account && $account->id != $global->current_account->id)
                                    <li>
                                        <a href="{{ admin_url('account/change-account/'.$account->id)}}" data-toggle="tooltip" data-placement="right" title="切换到 “{{ $account->name }}”" data-original-title="切换到 “{{ $account->name }}”">{{ $account->name}}</a>
                                    </li>
                                @endif
                            @endforeach
                            @if($global->accounts->count() > 1)
                                <li role="presentation" class="divider"></li>
                            @endif
                            <li>
                                <a href="{{ admin_url('account')}}">公众号管理</a>
                            </li>
                            <li>
                                <a href="{{ admin_url('account/create')}}">添加公众号</a>
                            </li>
                        </ul>
                    </li>
                |
            @endif

            <li class="dropdown">
                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i> {{ Auth::user()->username }}
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <div class="text-center link-block">
                            <a href="#">
                                账号设置
                            </a>
                        </div>
                    </li>
                    <li class="divider"></li>

                    <li>
                        <div class="text-center link-block">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                注销
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                </ul>
            </li>


            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> 注销
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>

        </ul>

    </nav>
</div>