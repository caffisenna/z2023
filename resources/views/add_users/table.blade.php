<div class="table-responsive">
    <table class="table" id="addUsers-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($addUsers as $addUser)
                <tr>
                    <td>{{ $addUser->name }}</td>
                    <td>{{ $addUser->email }}</td>
                    <td>{{ $addUser->role }}</td>
                    <td>
                        {!! Form::open(['route' => ['addUsers.destroy', $addUser->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {!! Form::button('<span uk-icon="icon: trash"></span>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('本当に削除しますか?')",
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
