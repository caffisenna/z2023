@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>デジパス送信(県連単位)</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                <ul class="uk-list">
                    @foreach ($prefs as $pref)
                        <li>
                            <a href="{{ url('/admin/sendmail_pref') . '/?pref=' }}{{ $pref }}"
                                onclick="return confirm('{{ $pref }}連盟へデジタルパスを送信します。よろしいですか？')"
                                class="uk-button uk-button-primary uk-width-1-3"><span
                                    uk-icon="mail">{{ $pref }}</span></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
