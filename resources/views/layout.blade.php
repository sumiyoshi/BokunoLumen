<html lang="en">
<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('/vendor/css/lib.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/app.min.css')}}"/>

    @yield('style')
</head>
<body class="nav-md">

<div class="container body" id="app">
    <div class="main_container">

        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title">
                    <a href="{{route('home')}}" class="site_title">
                        <span>Bokuno Lumen!</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">

                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-user"></i> User <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('users')}}">List</a></li>
                                    <li><a href="{{route('users_new')}}">New</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
                <!-- /sidebar menu -->
            </div>
        </div>

        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:void(0);"
                               class="user-profile dropdown-toggle"
                               data-toggle="dropdown"
                               aria-expanded="false">
                                {{ $login_user->name }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li>
                                    <a href="{{route('logout')}}">
                                        <i class="fa fa-sign-out pull-right"></i>
                                        Log Out
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="right_col" role="main">
            <div class="row tile_count" style="margin-top: 55px;">
                @yield('content')
            </div>
        </div>

        <footer>
            <div class="pull-right">Bokuno Lumen by SumiLab.</div>
        </footer>
    </div>
</div>

<script src="{{asset('/vendor/js/lib.min.js')}}"></script>
<script src="{{asset('/js/app.min.js')}}"></script>

@if (!empty($flash))
    <script>
        new PNotify({
            title: 'INFO',
            text: '{!!$flash!!}',
            type: 'success',
            styling: 'bootstrap3'
        });
    </script>
@endif

@if (!empty($flash_error))
    <script>
        new PNotify({
            title: 'ERROR',
            text: '{!!$flash_error!!}',
            type: 'error',
            styling: 'bootstrap3'
        });
    </script>
@endif


@yield('script')
</body>
</html>