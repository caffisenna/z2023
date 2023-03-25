<!-- Furigana Field -->
<div class="form-group col-sm-6">
    {!! Form::label('furigana', 'ふりがな:') !!}
    {!! Form::text('furigana', null, ['class' => 'form-control']) !!}
    @error('furigana')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', '性別:') !!}
    {!! Form::select('gender', ['' => '', '男' => '男', '女' => '女'], null, [
        'class' => 'form-control custom-select',
    ]) !!}
    @error('gender')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- birth_day Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birth_day', '生年月日:YYYY-MM-DD') !!}
    {!! Form::text('birth_day', null, ['class' => 'form-control', 'placeholder' => '西暦で入力して下さい']) !!}
    @error('birth_day')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Bs Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bs_id', '登録番号:') !!}
    {!! Form::text('bs_id', null, ['class' => 'form-control']) !!}
    @error('bs_id')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Prefecture Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prefecture', '県連盟:') !!}
            {!! Form::select(
                'prefecture',
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
                    '神奈川' => '神奈川',
                    '山梨' => '山梨',
                    '東京' => '東京',
                    '新潟' => '新潟',
                    '富山' => '富山',
                    '石川' => '石川',
                    '福井' => '福井',
                    '長野' => '長野',
                    '岐阜' => '岐阜',
                    '静岡' => '静岡',
                    '愛知' => '愛知',
                    '三重' => '三重',
                    '滋賀' => '滋賀',
                    '京都' => '京都',
                    '兵庫' => '兵庫',
                    '奈良' => '奈良',
                    '和歌山' => '和歌山',
                    '大阪' => '大阪',
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
                ],
                null,
                ['class' => 'form-control custom-select'],
            ) !!}
    @error('prefecture')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- District Field -->
<div class="form-group col-sm-6">
    {!! Form::label('district', '地区:地区がなければ無しと入力') !!}
    {!! Form::text('district', null, ['class' => 'form-control']) !!}
    @error('district')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Dan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dan', '団:') !!}
    {!! Form::text('dan', null, ['class' => 'form-control']) !!}
    @error('dan')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', '役務:') !!}
    {!! Form::select('role', ['' => '', 'RS' => 'RS', '指導者' => '指導者'], null, [
        'class' => 'form-control custom-select',
    ]) !!}
    @error('role')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Cell Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cell_phone', 'ケータイ:') !!}
    {!! Form::text('cell_phone', null, ['class' => 'form-control']) !!}
    @error('cell_phone')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Zip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('zip', '郵便番号:') !!}
    {!! Form::text('zip', null, ['class' => 'form-control']) !!}
    @error('zip')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', '住所:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
    @error('address')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- memo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('memo', '備考:') !!}
    {!! Form::textarea('memo', null, ['class' => 'form-control']) !!}
    @error('memo')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Team Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('team', '部署:') !!}
    {!! Form::text('team', null, ['class' => 'form-control']) !!}
    @error('team')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div> --}}
