@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div style="background-color:#115740">
                <p class="uk-text-large uk-text-center" style="color:#FFF">チェックイン</p>
            </div>
            <div class="card-body p-0">
                <div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
                    {{-- <h3 class="uk-card-title">検索</h3> --}}
                    @include('flash::message')
                    <p class="uk-text-warning uk-text-small">参列者を検索してください</p>
                    {{ Form::open() }}
                    {!! Form::text('furigana', old('furigana'), ['class' => 'uk-input', 'placeholder' => '氏名orふりがな']) !!}
                    {!! Form::submit('検索', ['class' => 'uk-button uk-button-primary']) !!}
                    {{ Form::close() }}
                </div>
                @if (isset($participants))
                    <table class="uk-table uk-table-hover uk-table-striped uk-table-small">
                        <tr>
                            <th>氏名</th>
                            <th>座席</th>
                            <th>所属</th>
                            <th>チェックイン</th>
                        </tr>
                        @foreach ($participants as $participant)
                            <tr class="uk-text-small">
                                <td>{{ $participant->name }}({{ $participant->furigana }})
                                    <span class="uk-text-warning">
                                        @if (isset($participant->vs))
                                            <br>VS:{{ $participant->vs->name }}
                                        @endif
                                        @if (isset($participant->bs))
                                            <br>BS:{{ $participant->bs->name }}
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $participant->seat_number }}</td>
                                <td>{{ $participant->pref }}</td>
                                <td><a href="{{ url('/s/check_in/input?uuid=') . $participant->uuid }}"
                                        class="uk-button uk-button-primary uk-button-small"
                                        onclick="return confirm('{{ $participant->name }}さんをチェックインしますか?')"><span uk-icon="sign-in"></span></a></td>
                            </tr>
                        @endforeach
                    </table>
                    {{-- {{ $participants->links() }} --}}
                @endif
            </div>
        </div>
    </div>
@endsection
