<table class="uk-table uk-table-hover uk-table-striped">
    <tr>
        <th>氏名</th>
        <td>{{ $participant->name }} ({{ $participant->furigana }})</td>
    </tr>
    <tr>
        <th>表彰式</th>
        <td>{{ $participant->ceremony }} {{ $participant->ceremony_with }}</td>
    </tr>
    <tr>
        <th>交歓会</th>
        <td>{{ $participant->reception }}</td>
    </tr>
    <tr>
        <th>参加会議</th>
        <td>{{ $participant->congress }}</td>
    </tr>
    <tr>
        <th>テーマ集会</th>
        <td>{{ $participant->theme_division }}</td>
    </tr>
    <tr>
        <th>県連盟</th>
        <td>{{ $participant->pref }}</td>
    </tr>
    <tr>
        <th>所属</th>
        <td>{{ $participant->dan }} {{ $participant->role_dan }}</td>
    </tr>
    <tr>
        <th>地区役務</th>
        <td>{{ $participant->role_district }}</td>
    </tr>
    <tr>
        <th>県連役務</th>
        <td>{{ $participant->role_council }}</td>
    </tr>
    <tr>
        <th>日連役務</th>
        <td>{{ $participant->role_saj }}</td>
    </tr>
    <tr>
        <th>email</th>
        <td>{{ $participant->email }}</td>
    </tr>
    <tr>
        <th>電話</th>
        <td>{{ $participant->phone }}</td>
    </tr>
    <tr>
        <th>UUID<br>マイページ</th>
        <td><a href="{{ url('/mypage?id=').$participant->uuid }}">{{ $participant->uuid }}</a></td>
    </tr>
    <tr>
        <th>2次元コード</th>
        <td>{!! QrCode::size(150)->generate(url('/mypage?id=') . $participant->uuid) !!}</td>
    </tr>
    <tr>
        <th>チェックイン(表彰式)</th>
        <td>{{ $participant->checkedin_at }}</td>
    </tr>
    <tr>
        <th>チェックイン(交歓会)</th>
        <td>{{ $participant->reception_checkedin_at }}</td>
    </tr>
    <tr>
        <th>備考</th>
        <td>{{ $participant->memo }}</td>
    </tr>
    <tr>
        <th>申込日</th>
        <td>{{ $participant->created_at }}</td>
    </tr>
</table>
