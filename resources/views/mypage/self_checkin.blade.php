<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} | デジタルパス</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <script src="{{ url('js/jquery.min.js') }}"></script>

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ url('css/adminlte.min.css') }}" />

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{ url('css/uikit.min.css') }}" />

    <!-- UIkit JS -->
    <script src="{{ url('js/uikit.min.js') }}"></script>
    <script src="{{ url('js/uikit-icons.min.js') }}"></script>
</head>

<body class="uk-container-xsmall">
    <div class="uk-responsive-width">
        <div style="background-color:#115740">
            <p class="uk-text-large uk-text-center uk-margin-auto-vertical" style="color:#FFF">全国大会2023<br>デジタルパス
            </p>
        </div>
        @include('flash::message')
        <div class="uk-margin uk-text-center">
            <img src="{{ url('/images/logo-sp.png') }}" width="150px">
            <p class="uk-text-large uk-text-center uk-text-primary">セルフチェックイン</p>
            @if (ENV('RECEPTION_ACCEPT_TIME') > now() && empty($participant->checkedin_at))
                <p class="uk-text-center">↓↓現在<span class="uk-text-danger">全体会</span>のチェックイン中↓↓</p>
            @elseif (ENV('RECEPTION_ACCEPT_TIME') < now() && empty($participant->reception_checkedin_at))
                <p class="uk-text-center">↓↓現在<span class="uk-text-danger">交歓会</span>のチェックイン中↓↓</p>
            @endif
        </div>
        @if (env('CHECKIN_ACCEPT_TIME') < now())
            @if (empty($participant->checkedin_at) ||
                    ($participant->reception == '参加する' && empty($participant->reception_checkedin_at)))
                <div class="card-body p-0">
                    <div class="uk-text-center uk-margin">
                        <div class="uk-text-center uk-margin">
                            {!! Form::open(['route' => 'self_checkin', 'method' => 'POST', 'onsubmit' => 'return beforeSubmit()']) !!}
                            {!! Form::hidden('uuid', $participant->uuid, null) !!}
                            {!! Form::hidden('confirm', 'true', null) !!}
                            {!! Form::submit('チェックインする', [
                                'class' => 'uk-button uk-button-primary uk-button-large',
                            ]) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @elseif ($participant->reception !== '参加する')
                <div class="uk-text-center">
                    <span class="uk-text-warning">交歓会の申込がありません。<br>スタッフにお問い合わせください。</span>
                </div>
            @endif
        @endif


        <div class="card-body p-0">
            <div class="uk-text-center uk-margin">
                {{-- 交歓会 --}}
                @if (env('RECEPTION_ACCEPT_TIME') < now() && $participant->reception_checkedin_at)
                    <p class="uk-text-large">交歓会テーブル: {{ $participant->reception_table }}</p>
                    <img src="{{ url('/images/passed_reception.png') }}" width="" height=""><br>
                @elseif(env('RECEPTION_ACCEPT_TIME') > now() && $participant->checkedin_at)
                    {{-- 全体会 --}}
                    <img src="{{ url('/images/passed_ceremony.png') }}" width="" height=""><br>
                    <span>この画面を受付スタッフに見せてご入場ください</span>
                @endif
            </div>
        </div>


    </div>
    <div uk-sticky="position: bottom" style="background-color:#115740; color:#fff">
        <p class="uk-text-small uk-text-center">
            {{ config('app.name') }}<br>
            受付システム&copy;
        </p>
    </div>

    <script>
        function beforeSubmit() {
            if (window.confirm('ご自身でチェックインしますか?')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>
