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
            <p class="uk-text-default uk-text-center uk-margin-auto-vertical" style="color:#FFF">100周年記念式典 &
                レセプション<br>デジタルパス
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
                            {{-- ここで来賓カテゴリを明示する --}}
                            @if ($participant->pref == '行政（国）' ||
                                $participant->pref == '行政（市）' ||
                                $participant->pref == '会場関係者' ||
                                $participant->pref == '①ボーイスカウト振興国会議員連盟' ||
                                $participant->pref == '②１００周年募金' ||
                                $participant->pref == '④B-Pフェロー' ||
                                $participant->pref == '⑤資金醸成団体' ||
                                $participant->pref == '表彰者' ||
                                $participant->pref == '⑥宗教関係代表者会議代表者' ||
                                $participant->pref == '⑦日本連盟名誉役員' ||
                                $participant->pref == '⑧日本連盟評議員会' ||
                                $participant->pref == '⑨日本連盟理事会' ||
                                $participant->pref == '⑩日本連盟監事' ||
                                $participant->pref == '⑩名誉会議' ||
                                $participant->pref == '⑩教育顧問会議' ||
                                $participant->pref == '⑩アンバサダー' ||
                                $participant->pref == '⑪県連盟連盟長' ||
                                $participant->pref == '新チャレンジ章協力企業' ||
                                $participant->pref == '⑫企業' ||
                                $participant->pref == '⑫関係団体（外部）' ||
                                $participant->pref == '⑬関係団体（内部）' ||
                                $participant->pref == 'レセプション協力')
                                <span class="uk-text-danger"><span uk-icon="star"></span> ご来賓 <span
                                        uk-icon="star"></span></span><br>
                            @endif
                            {{-- ここで来賓を明示する --}}
                            {{ $participant->name }} 様
                            <br>
                            @if (isset($participant->seat_number))
                                記念式典:{{ $participant->seat_number }}<br>
                            @endif
                            @if (isset($participant->reception_seat_number))
                                レセプション:{{ $participant->reception_seat_number }}<br>
                            @endif
                            @unless(empty($participant->self_absent))
                                <span class="uk-text-danger">(欠)</span>
                            @endunless
                        </span>
                    </td>
                </tr>
                @if (isset($participant->vs->name) || isset($participant->bs->name))
                    <tr>

                        {{-- シート番号も必要!! --}}
                        <td class="uk-text-center">
                            {{-- ベンチャースカウト --}}
                            @if (isset($participant->vs->name))
                                VS:{{ $participant->vs->name }} 様
                                ({{ $participant->vs->seat_number }})
                                @if (empty($participant->vs->self_absent))
                                @else
                                    <span class="uk-text-danger">(欠)</span>
                                @endif
                                <br>
                            @endif

                            {{-- ボーイスカウト --}}
                            @if (isset($participant->bs->name))
                                BS:{{ $participant->bs->name }} 様
                                ({{ $participant->bs->seat_number }})
                                @if (empty($participant->bs->self_absent))
                                @else
                                    <span class="uk-text-danger">(欠)</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endif
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
                        @if (isset($participant->vs->name) &&
                            empty($participant->vs->self_absent) &&
                            empty($participant->vs->checkedin_at))
                            <p class="uk-text-default"><a href="#modal-vs-absent" uk-toggle
                                    class=" uk-button uk-button-danger uk-width-1-1@m">式典を欠席する({{ $participant->vs->name }}様)</a>
                            </p>
                        @elseif(isset($participant->vs->self_absent))
                            {{ $participant->vs->name }}(欠席入力済み)<br>
                        @endif
                        @if (isset($participant->bs->name) &&
                            empty($participant->bs->self_absent) &&
                            empty($participant->bs->checkedin_at))
                            <p class="uk-text-default"><a href="#modal-bs-absent" uk-toggle
                                    class=" uk-button uk-button-danger uk-width-1-1@m">式典を欠席する({{ $participant->bs->name }}様)</a>
                            </p>
                        @elseif(isset($participant->bs->self_absent))
                            {{ $participant->bs->name }}(欠席入力済み)
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
            <p class="uk-text-small uk-text-center uk-margin-auto-vertical">100周年記念式典部会<br>
                {{ config('app.name') }} &copy;</p>
        </footer>
    </div>

    {{-- ここからモーダルウィンドウ --}}
    <div id="modal-self-check-in" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title uk-text-primary">チェックイン</h2>
            <p>{{ $participant->name }}様ご自身でチェックイン(到着手続き)を行います。<br>
                @if (isset($participant->vs->name) || isset($participant->bs->name))
                    <span class="uk-text-warning">引率するスカウトも一緒に到着扱いとなります。スカウトが揃っているか確認してください。(欠席入力されていれば不要です)</span>
                @endif
            </p>
            <ul>
                @if (isset($participant->vs->name) && empty($participant->vs->self_absent))
                    <li>VS:{{ $participant->vs->name }}</li>
                @endif
                @if (isset($participant->bs->name) && empty($participant->bs->self_absent))
                    <li>BS:{{ $participant->bs->name }}</li>
                @endif
            </ul>
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
            @if (isset($participant->vs->name) || isset($participant->bs->name))
                <p class="uk-text-warning">引率スカウトは受付ブースで個別にチェックインを行って下さい。</p>
            @endif
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

    {{-- ベンチャー欠席ウィンドウ --}}
    @if (isset($participant->vs->name))
        <div id="modal-vs-absent" uk-modal>
            <div class="uk-modal-dialog uk-modal-body">
                <h2 class="uk-modal-title uk-text-danger">欠席手続き</h2>
                <p><span class="uk-text-danger">{{ $participant->vs->name }}</span>さんの欠席手続きを行います。参加を取りやめる場合は<span
                        class="uk-text-warning">欠席する</span>ボタンをタップしてください</p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                    <a class="uk-button uk-button-danger"
                        href="{{ url('/') }}/self/?absent={{ $participant->vs->uuid }}">欠席する</a>
                </p>
            </div>
        </div>
    @endif
    {{-- ベンチャー欠席ウィンドウ --}}

    {{-- ボーイ欠席ウィンドウ --}}
    @if (isset($participant->bs->name))
        <div id="modal-bs-absent" uk-modal>
            <div class="uk-modal-dialog uk-modal-body">
                <h2 class="uk-modal-title uk-text-danger">欠席手続き</h2>
                <p><span class="uk-text-danger">{{ $participant->bs->name }}</span>さんの欠席手続きを行います。参加を取りやめる場合は<span
                        class="uk-text-warning">欠席する</span>ボタンをタップしてください</p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">キャンセル</button>
                    <a class="uk-button uk-button-danger"
                        href="{{ url('/') }}/self/?absent={{ $participant->bs->uuid }}">欠席する</a>
                </p>
            </div>
        </div>
    @endif
    {{-- ボーイ欠席ウィンドウ --}}

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
