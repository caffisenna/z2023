<h3 class="uk-text-primary">参加者情報</h3>
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '氏名:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Furigana Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'ふりがな:') !!}
    {!! Form::text('furigana', null, ['class' => 'form-control']) !!}
</div>
<div class="clearfix"></div>
<!-- Pref Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pref', '県連盟:') !!}
    {!! Form::select(
        'pref',
        [
            '' => '',
            '北海道' => '北海道',
            '青森' => '青森',
            '岩手' => '岩手',
            '宮城' => '宮城',
            '秋田' => '秋田',
            '山形' => '山形',
            '福島' => '福島',
            '茨城' => '茨城',
            '栃木' => '栃木',
            '群馬' => '群馬',
            '埼玉' => '埼玉',
            '千葉' => '千葉',
            '東京' => '東京',
            '神奈川' => '神奈川',
            '新潟' => '新潟',
            '富山' => '富山',
            '石川' => '石川',
            '福井' => '福井',
            '山梨' => '山梨',
            '長野' => '長野',
            '岐阜' => '岐阜',
            '静岡' => '静岡',
            '愛知' => '愛知',
            '三重' => '三重',
            '滋賀' => '滋賀',
            '京都' => '京都',
            '大阪' => '大阪',
            '兵庫' => '兵庫',
            '奈良' => '奈良',
            '和歌山' => '和歌山',
            '鳥取' => '鳥取',
            '島根' => '島根',
            '岡山' => '岡山',
            '広島' => '広島',
            '山口' => '山口',
            '徳島' => '徳島',
            '香川' => '香川',
            '愛媛' => '愛媛',
            '高知' => '高知',
            '福岡' => '福岡',
            '佐賀' => '佐賀',
            '長崎' => '長崎',
            '熊本' => '熊本',
            '大分' => '大分',
            '宮崎' => '宮崎',
            '鹿児島' => '鹿児島',
            '沖縄' => '沖縄',
            '荻窪' => '荻窪',
            '日本連盟' => '日本連盟',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<!-- Dan Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dan', '団名:') !!}
    {!! Form::text('dan', null, ['class' => 'form-control']) !!}
</div>

<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_dan', '団役務:') !!}
    {!! Form::select(
        'role_dan',
        [
            '' => '',
            '団委員長' => '団委員長',
            '団委員' => '団委員',
            '育成会員' => '育成会員',
            '隊指導者' => '隊指導者',
            'その他の役務' => 'その他の役務',
            'ローバースカウト' => 'ローバースカウト',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('role_district', '地区役務:') !!}
    {!! Form::select(
        'role_district',
        [
            '' => '',
            '協議会長、副会長' => '協議会長、副会長',
            '委員長、副委員長' => '委員長、副委員長',
            'コミッショナー、副コミッショナー' => 'コミッショナー、副コミッショナー',
            '上記以外の役務' => '上記以外の役務',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('role_council', '県連役務:') !!}
    {!! Form::select(
        'role_council',
        [
            '' => '',
            '連盟長' => '連盟長',
            '理事長' => '理事長',
            '県コミッショナー' => '県コミッショナー',
            '事務局長' => '事務局長',
            '上記以外の役務' => '上記以外の役務',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('role_saj', '日連役務:') !!}
    {!! Form::select(
        'role_saj',
        [
            '' => '',
            '理事、監事' => '理事、監事',
            '評議員' => '評議員',
            '各種委員会委員' => '各種委員会委員',
            '上記以外の役務' => '上記以外の役務',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', '電話:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('member', '加盟員/一般:') !!}
    {!! Form::select(
        'member',
        [
            '' => '',
            '加盟員' => '加盟員',
            '非加盟員' => '非加盟員(一般)',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<h3 class="uk-text-primary">表彰式</h3>

<div class="form-group col-sm-6">
    {!! Form::label('ceremony', '表彰式:') !!}
    {!! Form::select(
        'ceremony',
        [
            '' => '',
            '表彰式に参加する' => '表彰式に参加する',
            '同伴者と二人で参加する' => '同伴者と二人で参加する',
            '参加しない' => '参加しない',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('ceremony_with', '表彰式の同伴者:') !!}
    {!! Form::text('ceremony_with', null, ['class' => 'form-control']) !!}
</div>

<h3 class="uk-text-primary">交歓会</h3>

<div class="form-group col-sm-6">
    {!! Form::label('reception', '交歓会:') !!}
    {!! Form::select(
        'reception',
        [
            '' => '',
            '参加する' => '参加する',
            '同伴者（表彰同伴者）と二人で参加する' => '同伴者（表彰同伴者）と二人で参加する',
            '参加しない' => '参加しない',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<h3 class="uk-text-primary">参加会議</h3>

<div class="form-group col-sm-6">
    {!! Form::label('congress', '各種会議:') !!}
    {!! Form::select(
        'congress',
        [
            '' => '',
            '県連盟代表者会議' => '県連盟代表者会議',
            '県コミッショナー会議' => '県コミッショナー会議',
            'ＲＣＪ総会' => 'ＲＣＪ総会',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>


<h3 class="uk-text-primary">所属団体</h3>

<div class="form-group col-sm-6">
    {!! Form::label('organization', '所属団体:') !!}
    {!! Form::text('organization', null, ['class' => 'form-control']) !!}
</div>

<!-- Living Area Field -->
<div class="form-group col-sm-6">
    {!! Form::label('living_area', 'お住まいの地域:') !!}
    {!! Form::select(
        'living_area',
        [
            '' => '',
            '北海道' => '北海道',
            '青森' => '青森',
            '岩手' => '岩手',
            '宮城' => '宮城',
            '秋田' => '秋田',
            '山形' => '山形',
            '福島' => '福島',
            '茨城' => '茨城',
            '栃木' => '栃木',
            '群馬' => '群馬',
            '埼玉' => '埼玉',
            '千葉' => '千葉',
            '東京' => '東京',
            '神奈川' => '神奈川',
            '新潟' => '新潟',
            '富山' => '富山',
            '石川' => '石川',
            '福井' => '福井',
            '山梨' => '山梨',
            '長野' => '長野',
            '岐阜' => '岐阜',
            '静岡' => '静岡',
            '愛知' => '愛知',
            '三重' => '三重',
            '滋賀' => '滋賀',
            '京都' => '京都',
            '大阪' => '大阪',
            '兵庫' => '兵庫',
            '奈良' => '奈良',
            '和歌山' => '和歌山',
            '鳥取' => '鳥取',
            '島根' => '島根',
            '岡山' => '岡山',
            '広島' => '広島',
            '山口' => '山口',
            '徳島' => '徳島',
            '香川' => '香川',
            '愛媛' => '愛媛',
            '高知' => '高知',
            '福岡' => '福岡',
            '佐賀' => '佐賀',
            '長崎' => '長崎',
            '熊本' => '熊本',
            '大分' => '大分',
            '宮崎' => '宮崎',
            '鹿児島' => '鹿児島',
            '沖縄' => '沖縄',
            '荻窪' => '荻窪',
            '日本連盟' => '日本連盟',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<h3 class="uk-text-primary">テーマ集会</h3>

{{-- テーマ集会 --}}
<div class="form-group col-sm-6">
    {!! Form::label('theme_division', 'テーマ集会:') !!}
    {!! Form::select(
        'theme_division',
        [
            '' => '',
            '01組織拡充' => '01組織拡充',
            '02プログラム' => '02プログラム',
            '03信仰奨励' => '03信仰奨励',
            '04スカウティングにおける成人' => '04スカウティングにおける成人',
            '05スカウトソング' => '05スカウトソング',
            '06広報／社会連携' => '06広報／社会連携',
            '07資金造成' => '07資金造成',
            '08セーフ・フロム・ハーム' => '08セーフ・フロム・ハーム',
            '09スカウティングと安全' => '09スカウティングと安全',
            '10ＲＣＪ活動報告と海外派遣報告' => '10ＲＣＪ活動報告と海外派遣報告',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<h3 class="uk-text-primary">備考</h3>

<div class="form-group col-sm-6">
    {!! Form::label('memo', '備考:') !!}
    {!! Form::textarea('memo', null, ['class' => 'form-control']) !!}
</div>

