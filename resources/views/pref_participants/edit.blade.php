@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{ Auth::user()->is_pref }}連盟 参加者情報編集</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($participant, ['route' => ['pref_participants.update', $participant->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('pref_participants.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('pref_participants.index') }}" class="btn btn-default">キャンセル</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
