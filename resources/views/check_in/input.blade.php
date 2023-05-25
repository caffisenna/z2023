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
                @if (now()->between(env('CEREMONY1_ACCEPT_START'), env('CEREMONY1_ACCEPT_END')) ||
                        now()->between(env('CEREMONY2_ACCEPT_START'), env('CEREMONY2_ACCEPT_END')))
                    <h3>全体会チェックイン</h3>
                @elseif(now()->between(env('RECEPTION_ACCEPT_START'), env('RECEPTION_ACCEPT_END')))
                    <h3>交歓会チェックイン</h3>
                @else
                    <h3 class="uk-text-danger">チェックイン時間外!</h3>
                @endif

                @if (isset($participants))
                    <table class="uk-table uk-table-hover uk-table-striped uk-table-small">
                        <tr>
                            <th>氏名</th>
                            <th>県連</th>
                            <th>チェックイン</th>
                        </tr>
                        @foreach ($participants as $participant)
                            <tr class="uk-text-small">
                                <td>{{ $participant->name }}<br>({{ $participant->furigana }})</td>
                                <td>{{ $participant->pref }}</td>
                                <td>
                                    @if (now()->between(env('CEREMONY1_ACCEPT_START'), env('CEREMONY1_ACCEPT_END')) ||
                                            now()->between(env('CEREMONY2_ACCEPT_START'), env('CEREMONY2_ACCEPT_END')))
                                        @if (isset($participant->checkedin_at))
                                            済み
                                        @else
                                            <a href="{{ url('/s/check_in/input?uuid=') . $participant->uuid }}"
                                                class="uk-button uk-button-primary uk-button-small"
                                                onclick="return confirm('{{ $participant->name }}さんをチェックインしますか?')"><span
                                                    uk-icon="sign-in"></span></a>
                                        @endif
                                    @endif
                                    @if (now()->between(env('RECEPTION_ACCEPT_START'), env('RECEPTION_ACCEPT_END')))
                                        @if (isset($participant->reception_checkedin_at))
                                            済み
                                        @else
                                            <a href="{{ url('/s/check_in/input?uuid=') . $participant->uuid }}"
                                                class="uk-button uk-button-primary uk-button-small"
                                                onclick="return confirm('{{ $participant->name }}さんをチェックインしますか?')"><span
                                                    uk-icon="sign-in"></span></a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{-- {{ $participants->links() }} --}}
                @endif
            </div>
        </div>
    </div>
@endsection
