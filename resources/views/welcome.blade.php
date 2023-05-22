<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{ url('uikit/uikit.min.css') }}" />

    <!-- UIkit JS -->
    <script src="{{ url('uikit/uikit.min.js') }}"></script>
    <script src="{{ url('uikit/uikit-icons.min.js') }}"></script>
    <title>受付システム</title>
</head>

<body class="antialiased">
    <div style="background-color:#115740">
        <p class="uk-text-default uk-text-center uk-margin-auto-vertical" style="color:#FFF">全国大会2023<br>デジタルパスのご案内
        </p>
    </div>
    <div class="uk-container uk-container-large">
        <div class="uk-text-center uk-margin-top">
            <img src="{{ url('/images/logo-sp.png') }}" alt="">
        </div>

        <p class="uk-text-dafault">
            今年の全国大会では、２次元バーコードを利用したデジタルパスで受付いたします。<br>
            デジタルパス(2次元バーコード)は参加者の皆様個別にお送りしておりますEメールをご確認ください。
        </p>

        <ul class="uk-li">
            <li>受付に並ぶ際、上記のデジタルパスをお持ちください。（スマートフォンの画面表示でも結構です）</li>
            <li>デジタルパスを受付スタッフに提示して、チェックイン処理を受けてご入場ください。</li>
            <li>記念品は受付の際にお渡しいたします。</li>
            <li>交歓会へのご参加も同じ２次元バーコードで受付いたします。</li>
        </ul>

        2023年度全国大会の総合案内は以下のページをご参照下さい。<br>
        <a href="https://www.scout.or.jp/member/zenkokutaikai2023/">2023（令和5）年度 全国大会 - ボーイスカウト日本連盟｜加盟員向け情報</a>
    </div>

    <div uk-sticky="position: bottom" style="background-color:#115740; color:#fff">
        <p class="uk-text-small uk-text-center">{{ config('app.name') }} <a href="{{ url('/login') }}"
                style="color: #FFF">&copy;</a></p>
    </div>
</body>

</html>
