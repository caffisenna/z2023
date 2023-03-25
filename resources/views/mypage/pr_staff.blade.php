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

    {{-- Swiper --}}
    <link rel="stylesheet" href="{{ url('/swiper/swiper-bundle.min.css') }}" />
    <script src="{{ url('/swiper/swiper-bundle.min.js') }}"></script>

    <style>
        .swiper {
            height: 150px;
            width: 300px;
        }
    </style>
</head>

<body class="uk-container-xsmall">
    <div class="">
        <div style="background-color:#115740">
            <p class="uk-text-default uk-text-center uk-margin-auto-vertical" style="color:#FFF">
                100周年記念式典<br>スタッフ用デジタルパス
            </p>
        </div>
        @include('flash::message')
        <div class=" uk-margin uk-text-center">
            <img src="{{ url('/images/logo-sp.jpg') }}">
        </div>
        <div class="card-body p-0">
            <table class="uk-table">
                <tr>
                    <td class="uk-text-center">
                        <span class="uk-text-bold uk-text-large">
                            {{ $staff->user->name }} 様
                            <br>
                            {{ $staff->team }}<br>
                        </span>
                        {{ $staff->prefecture }}連盟{{ $staff->district }}
                    </td>
                </tr>
                @if (isset($staff->vs->name) || isset($staff->bs->name))
                    <tr>

                        {{-- シート番号も必要!! --}}
                        <td class="uk-text-center">
                        </td>
                    </tr>
                @endif
                <tr>
                    <td class="uk-text-center">
                        <div class="swiper-slide">
                            {{-- {!! QrCode::size(150)->generate(url('/s/check_in?id=') . $staff->uuid) !!} --}}
                        </div>
                        @if (empty($staff->checkedin_at))
                            <p class="uk-text-warning">↓↓↓会場に到着したらチェックイン!↓↓↓</p>
                            <p class="uk-text-default"><a href="#modal-self-check-in" uk-toggle
                                    class=" uk-button uk-button-primary uk-width-1-1@m">チェックイン</a></p>
                        @else
                            <p class="uk-text-primary uk-text-large">チェックイン済み<br>
                                {{ $staff->checkedin_at }}</p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <footer class="" style="background-color:#115740; color:#fff">
            <p class="uk-text-small uk-text-center uk-margin-auto-vertical">100周年記念式典部会<br>
                {{ config('app.name') }} &copy;</p>
        </footer>
    </div>

    {{-- ここからモーダルウィンドウ --}}
    <div id="modal-self-check-in" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title uk-text-primary">チェックイン</h2>
            <p>{{ $staff->user->name }}様ご自身でチェックイン(到着手続き)を行います。</p>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close uk-width-1-1@m" type="button">キャンセル</button>
                <a class="uk-button uk-button-primary uk-width-1-1@m"
                    href="{{ url('/') }}/staff_checkin/?uuid={{ $staff->uuid }}&checkin=true">チェックインする</a>
            </p>
        </div>
    </div>

    <div id="modal-self-absent" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title uk-text-danger">欠席手続き</h2>
            <p>{{ $staff->name }}様ご自身で<span class="uk-text-danger">記念式典</span>の欠席手続きを行います。参加を取りやめる場合は<span
                    class="uk-text-warning">欠席する</span>ボタンをタップしてください</p>
            @if (isset($staff->vs->name) || isset($staff->bs->name))
                <p class="uk-text-warning">引率スカウトは受付ブースで個別にチェックインを行って下さい。</p>
            @endif
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                <a class="uk-button uk-button-danger"
                    href="{{ url('/') }}/self/?absent={{ $staff->uuid }}">欠席する</a>
            </p>
        </div>
    </div>
</body>

</html>
