<html lang="en">
<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/gentelella/vendors/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/gentelella/vendors/animate.css/animate.min.css"/>
    <link rel="stylesheet" href="/gentelella/build/css/custom.min.css"/>

    <link rel="stylesheet" href="{{asset('/css/app.min.css')}}"/>

    @yield('style')
</head>
<body class="nav-md">

<div class="container body">
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>
            <br>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <ul class="nav side-menu">
                        <li><a><i class="fa fa-bars"></i> User <span class="fa fa-chevron-down"></span></a>
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
                        <a href="javascript:void(0);" class="user-profile dropdown-toggle" data-toggle="dropdown"
                           aria-expanded="false">
                            {{ $login_user->name }}
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="{{route('logout')}}">
                                    <i class="fa fa-sign-out pull-right"></i>
                                    Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="right_col" role="main">
        <div class="row tile_count" style="margin-top: 55px;">
            @if (!empty($flash))
                <div class="alert alert-success" role="alert">
                    <p>{{$flash}}</p>
                </div>
            @endif

            @yield('content')

        </div>
    </div>
</div>

<script src="/gentelella/vendors/jquery/dist/jquery.min.js"></script>
<script src="/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/gentelella/build/js/custom.min.js"></script>
<script src="{{asset('/js/app.min.js')}}"></script>

@yield('script')
</body>
</html>