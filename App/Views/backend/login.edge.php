<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Giriş Yap | Titan-2 Blog</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{!! get_asset('backend/bootstrap/css/bootstrap.min.css') !!}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{!! get_asset('backend/dist/css/AdminLTE.min.css') !!}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">

        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>Titan-2</b> Blog</a>
            </div>

            <div class="login-box-body">
                @if(Session::hasFlash())
                    <div class="alert alert-danger">{!! Session::getFlash() !!}</div>
                @endif

                <form action="" method="post">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group has-feedback">
                        <input type="email" name="usermail" id="usermail" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="userpass" id="userpass" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Giriş Yap</button>
                </form>
            </div>
        </div>

        <!-- jQuery 2.2.3 -->
        <script src="{!! get_asset('backend/plugins/jQuery/jquery-2.2.3.min.js') !!}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{!! get_asset('backend/bootstrap/js/bootstrap.min.js') !!}"></script>

    </body>
</html>
