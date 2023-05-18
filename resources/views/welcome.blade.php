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

        <h2>表彰式</h2>
        <p class="uk-text-warning">記念式典の詳細につきましてはご案内のメールをご参照下さい。</p>
        <h3>デジタルパスの使用方法</h3>
        <ol>
            <li>会場受付に並ぶ際、メールに記載してあるURLへアクセスしてデジタルパスをケータイ端末に表示してください。</li>
            <li>画面を受付スタッフに提示して、チェックイン処理を受け、身元確認、手荷物チェックを受けてご入場下さい。</li>
            <li>記念式典の退場時に同画面をスタッフにお見せのうえ記念品をお受け取り下さい。</li>
        </ol>


        <h3>案内メールをパソコンでご覧になっている方</h3>
        <ul>
            <li>デジタルパスのURLをご自分のスマートフォンへ転送し、表示できるようにしてください。</li>
            <li>デジタルパスのURLへパソコンからアクセスし、表示されるページ(二次元コード)を印刷してご持参ください。</li>
        </ul>


        <h3 class="uk-text-danger">重要事項</h3>
        <ul class="uk-text-danger">
            <li>式典会場には招待を受けたご本人のみ入場可能であり、事前に登録のない方は入場できません。</li>
            <li>身分証による身元確認を行います。公的機関発行の写真付き身分証を必ずご用意下さい。身元確認ができない場合は入場をお断りします。</li>
            <li>本人確認書類の不備、間際の混雑、金属類持込み再検査、その他確認事項などで、着席時間を過ぎてしまった場合も入場できません。</li>
            <li>スカウトは学生証、保険証などを持参するようご指導下さい。</li>
            <li>12:00以降の入場は警備の関係上認められません。余裕を持った受付をお願いします。(原宿駅から徒歩で約20分かかります。)</li>
            <li>レセプションに参加される方で、記念式典の入場時間に間に合わない方は16:00からレセプション会場にお向かいください。</li>
            <li>入場時、金属探知機による検査を行います。反応する金属の特定ができない場合、特定できるまで、繰り返し検査を行わせて頂きます。</li>
            <li>手荷物確認を行います。危険物は持ち込みはできません。</li>
            <li>緊急時は以下までご連絡をお願い致します。(額谷さんを指名 => 15日の部会で確認する)</li>
            <li>携帯電話は、式場内では電源をお切り頂くか、マナーモードに設定のうえ、通話はご遠慮ください。</li>
            <li>式典の撮影・録画・録音はできません。</li>
        </ul>



        <h3>手荷物に関して(記念式典)</h3>

        <ul>
            <li>式典会場内には、缶・ペットボトル等の飲料水、傘、カメラを含め、手荷物の持ち込みはできません。(A5サイズ程度の女性用ハンドバッグは除く)</li>
            <li>会場内にはウォーターサーバーを設置致します。</li>
            <li>手荷物や上着等が有る場合は、会場内のクロークにお預け頂きます。できる限り、手荷物の持参はお控えください。</li>
        </ul>

        <h3>コロナ対応に関して</h3>
        <ul>
            <li>三密を避け、会場内ではマスク着用をお願い致します。</li>
            <li>入場時に検温を実施致します。発熱(37.5℃以上)がある方、体調不良の方は入場をお断り致します。</li>
            <li>新型コロナウイルス感染症陽性とされた方との濃厚接触がある方、また同居のご家族や身近な知人に感染が疑われる方がいらっしゃる方も入場をお断り致します。</li>
            <li>式典後10日以内に新型コロナウイルス感染が発覚した場合は <a href="mailto:rsvp-100th@scout.or.jp">rsvp-100th@scout.or.jp</a>
                までお知らせ下さい</li>
        </ul>

        <h3>送迎</h3>
        <ul>
            <li>式典会場及び周辺道路では、指定された乗用車等以外の車両を駐停車することができなくなります。</li>
            <li>交通渋滞等の混雑緩和のため、車での送迎はご遠慮ください。</li>
        </ul>



        <h3>お体の不自由な方へ</h3>
        <ul>
            <li>介添え者を同伴される方又は車いすで来場される方は、下記までお知ら下さい。</li>
            <li>介添え者が参列者御本人とともに会場内に入場される場合は、御本人同様に出席登録をお願いすることとなりますので、 介添え者の住所、氏名、連絡先を下記までお知らせください。</li>
            連絡先: <a href="mailto:rsvp-100th@scout.or.jp">rsvp-100th@scout.or.jp</a>
        </ul>

        <h3>よくある質問(記念式典)</h3>
        <dl>
            <dt>Q: 事前登録が必要ですか?</dt>
            <dd>A: 警備の関係上、事前登録は必ず必要です。</dd>
        </dl>
        <dl>
            <dt>Q: デジタルパスを忘れてしまった(受け取っていない)</dt>
            <dd>A: 受付でスタッフへお名前をお伝え下さい。</dd>
        </dl>
        <dl>
            <dt>Q: デジタルパスを携帯電話等で表示できない</dt>
            <dd>A: 受付でスタッフへお名前をお伝え下さい。</dd>
        </dl>

        <dl>
            <dt>Q: ボーイスカウトとベンチャースカウトのチェックインはどうすればいいですか?</dt>
            <dd>A: 引率指導者の方と一緒に受付へお越し下さい。引率指導者のデジタルパスで同時にチェックインを行います。</dd>
        </dl>

        <dl>
            <dt>Q: 引率指導者が欠席になった場合、スカウトの受付はどうしたらいいですか?</dt>
            <dd>A: 臨時受付ブースにて受付をします。</dd>
        </dl>
        <dl>
            <dt>Q: 急遽参加できなくなってしまった場合はどうすればいいですか?</dt>
            <dd>A: デジタルパスから欠席入力ができるようになっていますので、ご自身で欠席入力をお願い致します。ボーイスカウトとベンチャースカウトの欠席入力は引率指導者のデジタルパスからできるようになっています。</dd>
        </dl>



        ​<h2>交歓会</h2>
        <p class="uk-text-warning">記念式典の詳細につきましてはご案内のメールをご参照下さい。</p>

        <h3>手荷物に関して(レセプション)</h3>
        <ul>
            <li>手荷物やコート等が有る場合は、クロークをご利用ください。</li>
        </ul>



        <h3>よくある質問(レセプション)</h3>
        <dl>
            <dt>Q: 事前登録が必要ですか?</dt>
            <dd>A: 座席とお食事のご用意の為、事前登録は必ず必要です。</dd>
        </dl>

        <dl>
            <dt>Q: 食事内容について食物アレルギーへの対応は可能でしょうか?</dt>
            <dd>A: 出来る限り対応いたします。詳細はメールのご案内をご参照ください。
            </dd>
        </dl>

        <dl>
            <dt>Q: 急遽参加できなくなってしまった場合はどうすればいいですか?</dt>
            <dd>A: デジタルパスから欠席入力ができるようになっていますので、ご自身で欠席入力をお願い致します。</dd>
        </dl>

    </div>

    <footer class="main-footer" style="background-color:#115740; color:#fff">
        <p class="uk-text-small uk-text-center">{{ config('app.name') }} <a href="{{ url('/login') }}"
                style="color: #FFF">&copy;</a></p>
    </footer>
</body>

</html>
