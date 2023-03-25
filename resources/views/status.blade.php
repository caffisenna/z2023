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

        {{-- <div class="content-wrapper"> --}}
            <section class="content">
                <div class="container">
                    <div class="row">

                        <p class="uk-text-large">チェックイン状況</p>
                        <table class="uk-table uk-table-divider uk-table-striped uk-table-hover">
                            <tr>
                                <th>カテゴリ</th>
                                <th>人数</th>
                            </tr>
                            @foreach ($participants as $participant)
                                <tr>
                                    <td class="uk-text-default">{{ $participant['name'] }}</td>
                                    <td><span class="uk-text-success">{{ $participant['checked_in'] }}</span> /
                                        {{ $participant['count'] }}</td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
        {{-- </div> --}}
        </section>
    </div>

    <!-- Main Footer -->

    <footer class="" style="background-color:#115740; color:#fff">
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
