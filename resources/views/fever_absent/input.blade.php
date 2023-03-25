@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div style="background-color:#115740">
                <p class="uk-text-large uk-text-center" style="color:#FFF">発熱欠席入力</p>
            </div>
            <div class="card-body p-0">
                <div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
                    @include('flash::message')
                    <p class="uk-text-small"><span class="uk-text-danger">発熱者</span>を検索してください</p>
                    {{ Form::open() }}
                    {!! Form::text('furigana', old('furigana'), ['class' => 'uk-input', 'placeholder' => '氏名orふりがな']) !!}
                    {!! Form::submit('検索', ['class' => 'uk-button uk-button-primary']) !!}
                    {{ Form::close() }}
                </div>
                @if (isset($participants))
                    <table class="uk-table uk-table-hover uk-table-striped uk-table-small">
                        <tr>
                            <th>氏名</th>
                            <th>所属</th>
                            <th>発熱</th>
                        </tr>
                        @foreach ($participants as $participant)
                            <tr class="uk-text-small">
                                <td>{{ $participant->name }}<br>({{ $participant->furigana }})</td>
                                <td>{{ $participant->pref }}</td>
                                <td><a href="{{ url('/s/fever_absent/input?uuid=') . $participant->uuid }}"
                                        class="uk-button uk-button-danger uk-button-small"
                                        onclick="return confirm('{{ $participant->name }}の発熱欠席処理をしますか?')"><span uk-icon="ban"></span></a></td>
                            </tr>
                        @endforeach
                    </table>
                    {{-- {{ $participants->links() }} --}}
                @endif
            </div>
        </div>
    </div>
@endsection
