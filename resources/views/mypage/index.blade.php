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
    <div class="">
        <div style="background-color:#115740">
            <p class="uk-text-large uk-text-center uk-margin-auto-vertical" style="color:#FFF">全国大会2023<br>デジタルパス
            </p>
        </div>
        @include('flash::message')
        <div class=" uk-margin uk-text-center">
            <img src="{{ url('/images/logo-sp.png') }}" width="150px">
            <p class="uk-text-default uk-text-center uk-text-small">この画面を受付でご提示下さい</p>
        </div>
        <div class="card-body p-0">

            <div class="uk-text-center">
                <span class="uk-text-bold uk-text-large">
                    {{-- ここで来賓を明示する --}}
                    @if ($participant->ceremony == '表彰式に参加する' || $participant->ceremony == '同伴者と二人で参加する')
                        <span class="uk-text-danger"><span uk-icon="star"></span> 表彰ご参加 <span
                                uk-icon="star"></span></span><br>
                    @endif
                    {{-- ここで来賓を明示する --}}
                    <span class="uk-text-large">{{ $participant->name }} 様</span>
                    <br>
                    {{-- 同伴者 --}}
                    @if ($participant->ceremony_with)
                        <span class="uk-text-default">ご同伴: {{ $participant->ceremony_with }} 様</span>
                    @endif
                    {{-- 同伴者 --}}
                </span>
                <div class="uk-margin">
                    {!! QrCode::size(150)->generate(url('/s/check_in?id=') . $participant->uuid) !!}
                </div>
            </div>

            <div class="uk-text-center uk-margin">
                {!! Form::open(['route' => 'self_checkin', 'method' => 'POST']) !!}
                {!! Form::hidden('uuid', $participant->uuid, null) !!}
                {!! Form::submit('セルフチェックイン', ['class' => 'uk-button uk-button-primary uk-button-large']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div uk-sticky="position: bottom" style="background-color:#115740; color:#fff">
            <p class="uk-text-small uk-text-center">
                {{ config('app.name') }}<br>
                受付システム&copy;
            </p>
        </div>
    </div>

</body>

</html>
