<table class=" uk-table uk-table-divider uk-table-hover">
    <tr>
        <td>氏名1</td>
        <td>{{ $staffinfo->user->name }}</td>
    </tr>
    <tr>
        <td>部署</td>
        <td>{!! Form::select(
            'team',
            [
                '' => '',
                'アテンド' => 'アテンド',
                'クローク' => 'クローク',
                'システム' => 'システム',
                '受付' => '受付',
                '誘導' => '誘導',
                '医療スタッフ' => '医療スタッフ',
                '式典部会員' => '式典部会員',
            ],
            null,
            [
                'class' => 'form-control custom-select',
            ],
        ) !!}
            @error('team')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    <tr>
        <td>ふりがな</td>
        <td>{!! Form::text('furigana', null, ['class' => 'form-control']) !!}
            @error('furigana')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <td>性別</td>
        <td>{!! Form::select('gender', ['' => '', '男' => '男', '女' => '女'], null, [
            'class' => 'form-control custom-select',
        ]) !!}
            @error('gender')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <td>生年月日</td>
        <td>{!! Form::text('birth_day', null, ['class' => 'form-control', 'placeholder' => '西暦で入力して下さい']) !!}
            @error('birth_day')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <td>登録番号</td>
        <td>{!! Form::text('bs_id', null, ['class' => 'form-control']) !!}
            @error('bs_id')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <td>県連盟</td>
        <td>{!! Form::select(
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
        </td>
    </tr>
    <tr>
        <td>地区:(無ければ"無し")</td>
        <td>{!! Form::text('district', null, ['class' => 'form-control']) !!}
            @error('district')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <td>団</td>
        <td>{!! Form::text('dan', null, ['class' => 'form-control']) !!}
            @error('dan')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <td>役務</td>
        <td>{!! Form::select(
            'role',
            ['' => '', 'RS' => 'RS', '指導者' => '指導者', 'RS年代の指導者' => 'RS年代の指導者'],
            null,
            [
                'class' => 'form-control custom-select',
            ],
        ) !!}
            @error('role')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <td>ケータイ</td>
        <td>{!! Form::text('cell_phone', null, ['class' => 'form-control']) !!}
            @error('cell_phone')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <td>郵便番号</td>
        <td>{!! Form::text('zip', null, ['class' => 'form-control']) !!}
            @error('zip')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <td>住所</td>
        <td>{!! Form::text('address', null, ['class' => 'form-control']) !!}
            @error('address')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <td>備考</td>
        <td>{!! Form::textarea('memo', null, ['class' => 'form-control']) !!}
            @error('memo')
                <div class="error text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
</table>
