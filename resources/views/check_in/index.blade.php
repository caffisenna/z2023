<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <script src="{{ url('js/jquery.min.js') }}"></script>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{ url('css/uikit.min.css') }}" />

    <!-- UIkit JS -->
    <script src="{{ url('js/uikit.min.js') }}"></script>
    <script src="{{ url('js/uikit-icons.min.js') }}"></script>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="content-wrapper">
            <section class="content">

                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        </div>
                    </div>
                </section>

                <div class="content px-3">

                    <div class="card">
                        <div style="background-color:#115740">
                            <p class="uk-text-large uk-text-center" style="color:#FFF">チェックイン完了</p>
                        </div>
                        <p class="uk-text-success uk-text-large">ご来場を受け付けました</p>
                        <div class="uk-margin"><a href="{{ url('/home') }}"
                                class="uk-button uk-button-primary uk-width-1-2">戻る</a></div>
                        <div class="card-body p-0">
                            <table class="uk-table uk-table-hover uk-table-striped uk-text-large">
                                <tr>
                                    <td>氏名</td>
                                    <td>{{ $participant->name }} 様</td>
                                </tr>
                                @if(isset($participant->ceremony))
                                <tr>
                                    <td>表彰</td>
                                    <td><span class="uk-text-danger">表彰参加者</span></td>
                                </tr>
                                @endif
                                <tr>
                                    <td>所属</td>
                                    <td>{{ $participant->pref }}連盟 @if ($participant->district)
                                            {{ $participant->district }}地区
                                        @endif
                                        {{ $participant->dan }}@if ($participant->dan_number)
                                            {{ $participant->dan_number }}団
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>役務</td>
                                    <td>{{ $participant->role_dan }}</td>
                                </tr>
                                <tr>
                                    <td>日時</td>
                                    <td>{{ $participant->checkedin_at }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="background-color:#115740; color:#fff">
            <p class="uk-text-small uk-text-center">受付システム<br>
                {{ config('app.name') }} &copy;</p>
        </footer>
    </div>
</body>

</html>
