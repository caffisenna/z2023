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
            <p class="uk-text-default uk-text-center uk-margin-auto-vertical" style="color:#FFF">全国大会2023<br>デジタルパス
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
                            {{-- ここで来賓を明示する --}}
                            @if ($participant->ceremony == '表彰式に参加する')
                                <span class="uk-text-danger"><span uk-icon="star"></span> 表彰ご参加 <span
                                        uk-icon="star"></span></span><br>
                            @endif
                            {{-- ここで来賓を明示する --}}
                            {{ $participant->name }} 様
                            <br>
                            {{-- 同伴者 --}}
                            @if (isset($participant->ceremony_with))
                                <span class="uk-text">ご同伴:{{ $participant->ceremony_with }}様</span>
                            @endif
                            {{-- 同伴者 --}}
                        </span>
                    </td>
                </tr>

                <tr>
                    <td class="uk-text-center">
                        <!-- Slider main container -->
                        <div class="swiper">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide">
                                    {!! QrCode::size(150)->generate(url('/s/check_in?id=') . $participant->uuid) !!}
                                </div>
                                @if (ENV('QRSWIPE') < now())
                                    <div class="swiper-slide">
                                        @if (empty($participant->gift_receipt))
                                            <a href="#modal-gift-receipt" uk-toggle
                                                class="uk-button uk-button-large uk-button-primary">記念品受領</a>
                                        @else
                                            <p class="uk-text-success uk-text-large">記念品受領済み</p>
                                            {{ $participant->gift_receipt }}
                                        @endif
                                    </div>

                                    <div class="swiper-slide">
                                        @if (empty($participant->cloak_receipt))
                                            <a href="#modal-cloak-receipt" uk-toggle
                                                class="uk-button uk-button-large uk-button-primary">クローク受領</a>
                                        @else
                                            <p class="uk-text-success uk-text-large">クローク返却済み</p>
                                            {{ $participant->cloak_receipt }}
                                        @endif
                                    </div>
                                @endif

                            </div>
                        </div>
                    </td>
                </tr>
                <tr>

                    <td>
                        @if (isset($participant->seat_number) && empty($participant->checkedin_at) && empty($participant->self_absent))
                            <p class="uk-text-default"><a href="#modal-self-absent" uk-toggle
                                    class=" uk-button uk-button-danger uk-width-1-1@m">式典を欠席する(ご本人)</a></p>
                        @elseif(isset($participant->self_absent))
                            {{ $participant->name }}(欠席入力済み)<br>
                        @endif

                        {{-- レセプション欠席入力 --}}
                        @if (isset($participant->reception_seat_number) && empty($participant->reception_self_absent))
                            <p class="uk-text-default"><a href="#modal-reception_self-absent" uk-toggle
                                    class=" uk-button uk-button-danger uk-width-1-1@m">レセプションを欠席する</a></p>
                        @elseif(isset($participant->reception_self_absent))
                            レセプション欠席入力済み
                        @endif
                    </td>
                </tr>
            </table>
            <p class="uk-text-warning uk-text-center uk-text-small">このページを受付でご提示下さい</p>
        </div>
        <footer class="" style="background-color:#115740; color:#fff">
            <p class="uk-text-small uk-text-center uk-margin-auto-vertical">受付システム<br>
                {{ config('app.name') }} &copy;</p>
        </footer>
    </div>

    {{-- ここからモーダルウィンドウ --}}
    <div id="modal-self-check-in" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title uk-text-primary">チェックイン</h2>
            <p>{{ $participant->name }}様ご自身でチェックイン(到着手続き)を行います。<br>
            </p>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close uk-width-1-1@m" type="button">キャンセル</button>
                <a class="uk-button uk-button-primary uk-width-1-1@m"
                    href="{{ url('/') }}/self_check_in/?checkin_id={{ $participant->uuid }}">チェックインする</a>
            </p>
        </div>
    </div>

    <div id="modal-self-absent" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title uk-text-danger">欠席手続き</h2>
            <p>{{ $participant->name }}様ご自身で<span class="uk-text-danger">記念式典</span>の欠席手続きを行います。参加を取りやめる場合は<span
                    class="uk-text-warning">欠席する</span>ボタンをタップしてください</p>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                <a class="uk-button uk-button-danger"
                    href="{{ url('/') }}/self/?absent={{ $participant->uuid }}">欠席する</a>
            </p>
        </div>
    </div>

    <div id="modal-reception_self-absent" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title uk-text-danger">レセプション欠席手続き</h2>
            <p>{{ $participant->name }}様ご自身で<span class="uk-text-danger">レセプション</span>の欠席手続きを行います。参加を取りやめる場合は<span
                    class="uk-text-warning">欠席する</span>ボタンをタップしてください</p>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                <a class="uk-button uk-button-danger"
                    href="{{ url('/') }}/self/?absent={{ $participant->uuid }}&q=reception">欠席する</a>
            </p>
        </div>
    </div>

    {{-- 記念品受領 --}}
    <div id="modal-gift-receipt" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title uk-text-danger">記念品受領</h2>
            <p>{{ $participant->name }}様へ<span class="uk-text-danger">記念品</span>をお渡ししました。</p>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                <a class="uk-button uk-button-danger"
                    href="{{ url('/') }}/receipt/?uuid={{ $participant->uuid }}&q=gift">受領</a>
            </p>
        </div>
    </div>
    {{-- 記念品受領 --}}

    {{-- クローク受領 --}}
    <div id="modal-cloak-receipt" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title uk-text-danger">クローク受領</h2>
            <p>{{ $participant->name }}様へ<span class="uk-text-danger">クロークでのお預かり品</span>をお渡ししました。</p>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                <a class="uk-button uk-button-danger"
                    href="{{ url('/') }}/receipt/?uuid={{ $participant->uuid }}&q=cloak">受領</a>
            </p>
        </div>
    </div>
    {{-- クローク受領 --}}

    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            // direction: 'vertical',
            direction: 'horizontal',
            loop: false,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
    </script>
</body>

</html>
