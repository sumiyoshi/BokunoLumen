<html lang="en">
<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="/node_modules/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/node_modules/gentelella/vendors/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/node_modules/gentelella/vendors/animate.css/animate.min.css"/>
    <link rel="stylesheet" href="/node_modules/gentelella/build/css/custom.min.css"/>

</head>
<body class="login">


<div class="login_wrapper">
    <div class="animate form login_form">

        @if ($errors)
            <div class="alert alert-danger" role="alert">
                <p>Login failure</p>
            </div>
        @endif

        <section class="login_content">
            <form action="{{ route('login') }}" method="post">
                <h1>Login Form</h1>
                <div>
                    <input type="text" class="form-control" placeholder="Username" name="mail">
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <div>
                    <input type="submit" value="login" class="btn btn-default btn-block" style="margin-left: 0;"/>
                </div>

            </form>
        </section>
    </div>
</div>

</body>
</html>