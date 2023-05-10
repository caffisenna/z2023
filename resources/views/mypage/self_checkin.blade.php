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
        </div>
        @unless ($participant->checkedin_at)
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
        @endunless
        @if ($participant->checkedin_at)
            <div class="card-body p-0">
                <div class="uk-text-center uk-margin">
                    <img src="{{ url('/images/passed_ceremony.png') }}" alt="" width="" height=""><br>
                    <span>この画面を受付スタッフに見せてご入場ください</span>
                </div>
            </div>
        @endif
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
