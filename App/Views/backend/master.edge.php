<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $title }}</title>

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{!! get_asset('backend/bootstrap/css/bootstrap.min.css') !!}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{!! get_asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{!! get_asset('backend/dist/css/AdminLTE.min.css') !!}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{!! get_asset('backend/dist/css/skins/_all-skins.min.css') !!}">

        @yield('css')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

        <!-- [+] REMOTE MODAL -->
        <div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
            </div>
        </div>
        <!-- [-] REMOTE MODAL -->

        <div class="wrapper">
            @include('backend.layouts.header')

            @include('backend.layouts.sidebar')

            @yield('content')

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Titan Framework</b> v{{ VERSION }}
                </div>
                <strong>Copyright &copy; {{ Date::now()->get('Y') }} <a href="http://v2.titanphp.com/doc">Titan 2 Web Framework</a></strong> ile kodlanmıştır.
            </footer>
        </div>

        <!-- jQuery 2.2.3 -->
        <script src="{!! get_asset('backend/plugins/jQuery/jquery-2.2.3.min.js') !!}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{!! get_asset('backend/bootstrap/js/bootstrap.min.js') !!}"></script>
        <!-- SlimScroll -->
        <script src="{!! get_asset('backend/plugins/slimScroll/jquery.slimscroll.min.js') !!}"></script>
        <!-- FastClick -->
        <script src="{!! get_asset('backend/plugins/fastclick/fastclick.js') !!}"></script>
        <!-- AdminLTE App -->
        <script src="{!! get_asset('backend/dist/js/app.min.js') !!}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{!! get_asset('backend/dist/js/demo.js') !!}"></script>
        <!-- Custom JS -->
        <script src="{!! get_asset('backend/dist/js/custom.js') !!}"></script>

        @yield('js')

    </body>
</html>
