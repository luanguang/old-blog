<!-- =========================
     HEADER SECTION
============================== -->
<header class="header">
    <nav class="navbar navbar-default" role="navigation">
        <div class="top-head">
            <div class="main">
                <div class="user-info">
                    @if (Route::has('login'))
                        @auth
                        <div class="user-desc">
                            <span class="avatar"><a href="{{ url('user') }}"><img src="{{ url('storage/'.Auth::user()->avatar) }}" alt=""></a></span>
                            <div class="dropdown">
                                <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="drop-btn">
                                    <span class="nickname"><a href="{{ url('user') }}">{{ Auth::user()->name }}</a></span>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li>
                                        <a href="{{ url('user') }}">个人中心</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('user/article') }}">我的文章</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}">退出</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="login">
                            <button class="btn-login"><a href="{{ url('login') }}">登录</a></button>
                            <button class="btn-register"><a href="{{ url('register') }}">注册</a></button>
                        </div>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-24">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('article') }}">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Reader">
                            <h1>欢乐日常</h1>
                        </a>
                    </div>
                </div>
                <!-- Navigation items -->
                <div class="col-md-24">
                    <div class="collapse navbar-collapse main-navigation" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown"><a href="{{ url('user') }}">{{ trans('view.self').trans('view.center') }}</a>
                            </li>

                            <li class="dropdown"><a href="{{ url('article') }}">{{ trans('view.article').trans('view.center') }}</a>

                            </li>

                            <li class="dropdown"><a href="{{ url('category') }}">{{ trans('view.category').trans('view.center') }}</a>
                                {{--<ul class="dropdown-menu" role="menu">--}}
                                    {{--<li><a tabindex="-1" href="{{ url('category/create') }}">{{ trans('view.add').trans('view.category') }}</a></li>--}}
                                {{--</ul>--}}
                            </li>

                            <li><a href="{{ url('mark') }}">{{ trans('view.mark').trans('view.center') }}</a></li>
                            <li><a href="{{ url('browse') }}">{{ trans('view.browse').trans('view.history') }}</a></li>
                            <li><a href="{{ url('follow') }}">{{ trans('view.follow') }}</a></li>
                        </ul>

                        <!-- SEARCH -->
                        @if (Route::currentRouteName() == 'article.index')
                        <form class="search-box navbar-form navbar-right" role="search" method="GET" action="{{ url('article') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" id="title" name="title" placeholder="{{ trans('view.search') }}" value="{{ !empty($search['title']) ? $search['title'] : '' }}">
                            </div><!-- /input-group -->
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /END FLUID CONTAINER -->
    </nav>
</header>
<!-- /END HEADER SECTION  -->