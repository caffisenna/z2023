<div class="form-group col-sm-6">
    {!! Form::label('category', '招待カテゴリ:') !!}
    {!! Form::select(
        'category',
        [
            '' => '',
            '県連代表(1)' => '県連代表(理事長)',
            '県連代表(2)' => '県連代表(県コミッショナー)',
            '県連代表(3)' => '県連代表(事務局長)',
            '県連代表(4)' => '県連代表(引率指導者)',
            '県連代表(5)' => '県連代表(VSスカウト)',
            '県連代表(6)' => '県連代表(BSスカウト)',
            '連盟長' => '連盟長',
            '日連役員' => '日連役員',
            '高額寄付者S' => '高額寄付者S',
            '高額寄付者A' => '高額寄付者A',
            '高額寄付者B' => '高額寄付者B',
            '経団連' => '経団連',
            '任意参加者' => '任意参加者',
            '議連議員' => '議連議員',
            '総理' => '総理',
            '文科大臣' => '文科大臣',
            '諸団体' => '諸団体',
            '明治神宮関係' => '明治神宮関係',
            '宗教代表者' => '宗教代表者',
            '表彰者' => '表彰者',
            '企業(18NSJ)' => '企業(18NSJ)',
            '企業(新チャレ、イオン)' => '企業(新チャレ、イオン)',
            'アンバサダー' => 'アンバサダー',
            'ライオンズ等' => 'ライオンズ等',
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('is_proxy', '代理(代理人の県連役務):') !!}
    {!! Form::text('is_proxy', null, ['class' => 'form-control']) !!}
</div>

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
        ],
        null,
        ['class' => 'form-control custom-select'],
    ) !!}
</div>

<!-- District Field -->
<div class="form-group col-sm-6">
    {!! Form::label('district', '地区:') !!}
    {!! Form::text('district', null, ['class' => 'form-control']) !!}
</div>

<!-- Dan Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dan', '団名:') !!}
    {!! Form::text('dan', null, ['class' => 'form-control']) !!}
</div>

<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', '役務:') !!}
    {!! Form::text('role', null, ['class' => 'form-control']) !!}
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
    {!! Form::label('zip', '郵便番号:') !!}
    {!! Form::text('zip', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('adderss', '住所:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('seat_number', '座席番号(記念式典):') !!}
    {!! Form::text('seat_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('reception_seat_number', '座席番号(レセプション):') !!}
    {!! Form::text('reception_seat_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('fee_checked_at', '参加費振込:') !!}
    {!! Form::text('fee_checked_at', null, ['class' => 'form-control']) !!}
</div>
