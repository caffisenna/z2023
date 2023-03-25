<div class="table-responsive">
    <table class="table" id="participants-table">
        <thead>
            <tr>
                <th>役務</th>
                <th>代理</th>
                <th>氏名</th>
                <th>座席</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <td>
                        @switch($participant->category)
                            @case('県連代表(1)')
                                理事長
                            @break

                            @case('県連代表(2)')
                                県コミッショナー
                            @break

                            @case('県連代表(3)')
                                事務局長
                            @break

                            @case('県連代表(4)')
                                引率指導者
                            @break

                            @case('県連代表(5)')
                                VSスカウト
                            @break

                            @case('県連代表(6)')
                                BSスカウト
                            @break

                            @default
                        @endswitch
                    </td>
                    <td>{{ $participant->is_proxy }}</td>
                    <td><a href="{{ route('pref_participants.show', [$participant->id]) }}">{{ $participant->name }}</a>
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
                    <td width="120">
                        <div class='btn-group'>
                            <a href="{{ route('pref_participants.edit', [$participant->id]) }}"
                                class='btn btn-default btn-xs'>
                                <span uk-icon="file-edit"></span>
                            </a>
                            @if (env('PREF_SEND_INVITATION') == 'true')
                                @unless($participant->category == '県連代表(5)' || $participant->category == '県連代表(6)')
                                    <a href="{{ url('/') }}/pref/sendmail?uuid={{ $participant->uuid }}"
                                        onclick="return confirm('{{ $participant->name }}さんへデジタルパスを送信します。よろしいですか？')">
                                        <span uk-icon="mail" class="uk-button-primary"></span></a>
                                @endunless
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
