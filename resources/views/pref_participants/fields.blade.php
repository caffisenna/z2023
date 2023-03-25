<table class="uk-table uk-table-divider uk-table-responsive uk-table-striped">
    <tr>
        <td>カテゴリ</td>
        <td>{{$participant->category }}</td>
    </tr>
    <tr>
        <td>{!! Form::label('name', '氏名:') !!}</td>
        <td>{!! Form::text('name', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('name', 'ふりがな:') !!}</td>
        <td>{!! Form::text('furigana', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('pref', '県連盟:') !!}</td>
        <td>{{ $participant->pref }}</td>
        {!! Form::hidden('pref', $participant->pref) !!}
    </tr>
    <tr>
        <td>{!! Form::label('district', '地区:') !!}</td>
        <td>{!! Form::text('district', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('dan', '団名:') !!}</td>
        <td>{!! Form::text('dan', null, ['class' => 'form-control', 'placeholder' => '例:荻窪1']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('role', '県連代表役務:') !!}</td>
        <td>{{$participant->role }}</td>
    </tr>
    <tr>
        <td>{!! Form::label('is_proxy', '代理の場合の県連役務:') !!}</td>
        <td>{!! Form::text('is_proxy', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('email', 'Email:') !!}</td>
        <td>{!! Form::text('email', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('phone', '電話:') !!}</td>
        <td>{!! Form::text('phone', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('zip', '郵便番号:') !!}</td>
        <td>{!! Form::text('zip', null, ['class' => 'form-control']) !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('address', '住所:') !!}</td>
        <td>{!! Form::text('address', null, ['class' => 'form-control']) !!}</td>
    </tr>
</table>
