@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>参加者</h1>
                </div>
                @if (Auth::user()->is_pref == null)
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right" href="{{ route('participants.create') }}">
                            新規追加
                        </a>
                    </div>
                    <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
                        {{ Form::open(['url' => '/admin/search']) }}
                        {!! Form::text('furigana', old('furigana'), ['class' => 'uk-input', 'placeholder' => '氏名orふりがな']) !!}
                        {!! Form::submit('検索', ['class' => 'uk-button uk-button-primary']) !!}
                        {{ Form::close() }}
                    </div>
                    <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
                        {{ Form::open(['url' => '/admin/search']) }}
                        {{ Form::select(
                            'prefecture',
                            [
                                '' => '',
                                '一般' => '一般',
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
                                '荻窪' => '荻窪',
                                '日本' => '日本',
                            ],
                            '',
                            ['class' => 'form-control'],
                        ) }}
                        {!! Form::submit('カテゴリ検索', ['class' => 'uk-button uk-button-primary']) !!}
                        {{ Form::close() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('participants.table')
                {{-- {{ $participants->links() }} --}}
            </div>

        </div>
    </div>
@endsection
