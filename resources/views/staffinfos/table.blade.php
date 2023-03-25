@if (isset($staffinfo))
    <div class="table-responsive">
        <table class="uk-table uk-table-divider uk-table-small" id="staffinfos-table">
            <tr>
                <th>氏名</td>
                <td class="uk-text-small">{{ Auth::user()->name }} ({{ $staffinfo->furigana }})</td>
            </tr>
            <tr>
                <th>性別</th>
                <td class="uk-text-small">{{ $staffinfo->gender }}</td>
            </tr>
            <tr>
                <th>生年月日</th>
                <td class="uk-text-small">{{ $staffinfo->birth_day }}</td>
            </tr>
            <tr>
                <th>登録番号</th>
                <td class="uk-text-small">{{ $staffinfo->bs_id }}</td>
            </tr>
            <tr>
                <th>所属</th>
                <td class="uk-text-small">{{ $staffinfo->prefecture }}連盟<br>{{ $staffinfo->district }}地区 {{ $staffinfo->dan }}団</td>
            </tr>
            <tr>
                <th>役務</th>
                <td class="uk-text-small">{{ $staffinfo->role }}</td>
            </tr>
            <tr>
                <th>メール</th>
                <td class="uk-text-small">{{ Auth::user()->email }}</td>
            </tr>
            <tr>
                <th>ケータイ</th>
                <td class="uk-text-small">{{ $staffinfo->cell_phone }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td class="uk-text-small">{{ $staffinfo->zip }}<br>{{ $staffinfo->address }}</td>
            </tr>
            <tr>
                <th>備考</th>
                <td class="uk-text-small">{{ $staffinfo->memo }}</td>
            </tr>
            <tr>
                <th>部署</th>
                <td class="uk-text-small">{{ $staffinfo->team }}</td>
            </tr>
            <tr>
                <td width="120">
                    {!! Form::open(['route' => ['staffinfos.destroy', $staffinfo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('staffinfos.edit', [$staffinfo->id]) }}" class='btn btn-default btn-xs'>
                            編集
                        </a>
                        {!! Form::button('削除', [
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-xs',
                            'onclick' => "return confirm('スタッフ情報を削除しますか?')",
                        ]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        </table>
    </div>
@endif
