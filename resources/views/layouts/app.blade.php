<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('css/all.min.css') }}" />

    <link href="{{ url('css/bootstrap4-toggle.min.css') }}" rel="stylesheet">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ url('css/adminlte.min.css') }}" />

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('css/icheck-bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ url('css/select2.min.css') }}" />

    <link rel="stylesheet" href="{{ url('css/bootstrap-datetimepicker.min.css') }}" />

    {{-- datatablesを有効にするにはこの位置でないとjqueryを呼んでくれない --}}
    <script src="{{ url('js/jquery.min.js') }}"></script>

    @yield('third_party_stylesheets')
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{ url('css/uikit.min.css') }}" />

    <!-- UIkit JS -->
    <script src="{{ url('js/uikit.min.js') }}"></script>
    <script src="{{ url('js/uikit-icons.min.js') }}"></script>

    @stack('page_css')
    <!-- iOS用 -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Android用 -->
    <meta name="mobile-web-app-capable" content="yes">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><span
                            uk-icon="menu"></span></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ url('/images/logo-sp.jpg') }}" class="user-image img-circle elevation-2"
                            alt="User Image">
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="{{ url('/images/logo-sp.jpg') }}" class="img-circle elevation-2"
                                alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                                <small>{{ Auth::user()->created_at->format('Y-m') }}登録</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                            <a href="#" class="btn btn-default btn-flat float-right"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                ログアウト
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                @yield('content')
            </section>
        </div>

        <!-- Main Footer -->

        <footer class="main-footer" style="background-color:#115740; color:#fff">
            <p class="uk-text-small uk-text-center">100周年記念式典部会<br>
                {{ config('app.name') }} &copy;</p>
        </footer>

    </div>

    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/bs-custom-file-input.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('js/adminlte.min.js') }}"></script>
    <script src="{{ url('js/moment.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ url('js/bootstrap4-toggle.min.js') }}"></script>
    <script src="{{ url('js/select2.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-switch.min.js') }}"></script>


    <script>
        $(function() {
            bsCustomFileInput.init();
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>

    @yield('third_party_scripts')

    @stack('page_scripts')
</body>

</html>
