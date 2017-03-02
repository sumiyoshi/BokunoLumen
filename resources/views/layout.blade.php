<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    @yield('style')
</head>
<body>

@if (!empty($flash))
    <div>
        {{$flash}}
    </div>
@endif

@yield('content')

@yield('script')
</body>
</html>