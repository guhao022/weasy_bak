<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="logo profile-element">
                    <h2 class="text-center text-navy"><strong>{{ $global->current_account->name }}</strong></h2>
                </div>
                <div class="logo-element">
                    {{ config('app.logo', 'WE') }}
                </div>
            </li>
            <li class="active">
                <a href="/admin"><i class="fa fa-tachometer"></i> <span class="nav-label">控制台</span> </a>
            </li>

            <li>
                <a href="#"><i class="fa fa-comments"></i> <span class="nav-label">消息</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="#">实时消息</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-th"></i> <span class="nav-label">功能</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ admin_url('menu') }}">自定义菜单</a></li>
                    <li><a href="#">自动回复</a></li>
                    <li><a href="#">自定义活动</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>