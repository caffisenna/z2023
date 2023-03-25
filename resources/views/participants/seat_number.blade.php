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

    <link rel="stylesheet" type="text/css" href="{{ url('/datatables/jquery.dataTables.css') }}">
    <script src="{{ url('/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ url('/datatables/jquery.dataTables.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#participants-table thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#participants-table thead');

            var table = $('#participants-table').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" placeholder="' + title +
                                '" style="width:60px" />');

                            // On every keypress in this input
                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('keyup change', function(e) {
                                    e.stopPropagation();

                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                        '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();

                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
            });
        });
    </script>
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
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>式典座席一覧</h1>
                    </div>
                </div>

                <div class="content px-3">

                    @include('flash::message')

                    <div class="clearfix"></div>
                    <div class="uk-card uk-card-default uk-card-body">
                        {{ Form::open(['url' => '/admin/seat_number']) }}
                        {{ Form::select(
                            'row',
                            [
                                '' => '',
                                'い' => 'い',
                                'ろ' => 'ろ',
                                'は' => 'は',
                                'に' => 'に',
                                'ほ' => 'ほ',
                                'へ' => 'へ',
                                'と' => 'と',
                                'ち' => 'ち',
                                'り' => 'り',
                                'ぬ' => 'ぬ',
                                'る' => 'る',
                                'を' => 'を',
                                'わ' => 'わ',
                                'か' => 'か',
                                'よ' => 'よ',
                                'た' => 'た',
                                'れ' => 'れ',
                                'そ' => 'そ',
                                'つ' => 'つ',
                                'ね' => 'ね',
                                'な' => 'な',
                                'ら' => 'ら',
                                'む' => 'む',
                                'う' => 'う',
                                'ゐ' => 'ゐ',
                                'の' => 'の',
                                'お' => 'お',
                                'く' => 'く',
                                'や' => 'や',
                                'ま' => 'ま',
                                'け' => 'け',
                                'ふ' => 'ふ',
                                'こ' => 'こ',
                                'え' => 'え',
                                'て' => 'て',
                                'あ' => 'あ',
                                'さ' => 'さ',
                                'き' => 'き',
                                'ゆ' => 'ゆ',
                                'め' => 'め',
                                'み' => 'み',
                                'し' => 'し',
                                'ゑ' => 'ゑ',
                                'ひ' => 'ひ',
                                'も' => 'も',
                                'せ' => 'せ',
                                'す' => 'す',
                                'ん' => 'ん',
                            ],
                            '',
                            ['class' => 'form-control'],
                        ) }}
                        {!! Form::submit('列検索', ['class' => 'uk-button uk-button-primary']) !!}
                        {{ Form::close() }}

                        @if (Auth::user()->is_pref == null)
                            <div class="col-sm-6">
                            </div>
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="uk-table uk-table-divider uk-table-hover" id="participants-table">
                                    <thead>
                                        <tr>
                                            <th>式典座席</th>
                                            <th>県連</th>
                                            <th>役務</th>
                                            <th>氏名</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($participants as $participant)
                                            <tr>
                                                <td>
                                                    @if (isset($participant->checkedin_at))
                                                        <span
                                                            class="uk-text-success">{{ $participant->seat_number }}</span>
                                                    @else
                                                        {{ $participant->seat_number }}
                                                    @endif
                                                </td>
                                                <td>{{ $participant->pref }}</td>
                                                <td>
                                                    @switch($participant->category)
                                                        @case('県連代表(1)')
                                                            理事長
                                                        @break

                                                        @case('県連代表(2)')
                                                            県コミッショナー
                                                        @break

                                                        @case('県連代表(3)')
                                                            事務局長
                                                        @break

                                                        @case('県連代表(4)')
                                                            引率指導者
                                                        @break

                                                        @case('県連代表(5)')
                                                            VSスカウト
                                                        @break

                                                        @case('県連代表(6)')
                                                            BSスカウト
                                                        @break

                                                        @default
                                                    @endswitch
                                                </td>
                                                <td><a
                                                        href="{{ route('participants.show', [$participant->id]) }}">{{ $participant->name }}</a><br>({{ $participant->furigana }})
                                                    <span class="uk-text-warning">
                                                        @if (isset($participant->vs))
                                                            <br>VS:{{ $participant->vs->name }}
                                                        @endif
                                                        @if (isset($participant->bs))
                                                            <br>BS:{{ $participant->bs->name }}
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>


            </div>

            <!-- Main Footer -->

        </div>
        <footer class="main-footer" style="background-color:#115740; color:#fff">
            <p class="uk-text-small uk-text-center">100周年記念式典部会<br>
                {{ config('app.name') }} &copy;</p>
        </footer>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#participants-table').DataTable();
            });
        </script>

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
