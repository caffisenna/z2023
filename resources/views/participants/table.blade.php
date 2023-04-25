<link rel="stylesheet" type="text/css" href="{{ url('/datatables/jquery.dataTables.css') }}">
<script type="text/javascript" charset="utf8" src="{{ url('/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url('/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#participants-table thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#participants-table thead');

        var table = $('#participants-table').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function() {
                var api = this.api();

                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title +
                            '" style="width:60px" />');

                        // On every keypress in this input
                        $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('keyup change', function(e) {
                                e.stopPropagation();

                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr =
                                    '({search})'; //$(this).parents('th').find('select').val();

                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value +
                                            ')))') :
                                        '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();

                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
        });
    });
</script>
<div class="table-responsive">
    <table class="uk-table uk-table-divider uk-table-hover uk-table-small" id="participants-table">
        <thead>
            <tr>
                <th>県連</th>
                <th>役務</th>
                <th>氏名</th>
                <th>表彰式</th>
                <th>交歓会</th>
                <th>テーマ</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <td>{{ $participant->pref }}</td>
                    <td> {{ $participant->dan }}</td>
                    <td><a href="{{ route('participants.show', [$participant->id]) }}">{{ $participant->name }}</a></td>
                    <td>
                        @if ($participant->ceremony == '表彰式に参加する')
                            参加
                        @elseif($participant->ceremony == '同伴者と二人で参加する')
                            参加(同伴者)
                        @else
                        @endif
                    </td>
                    <td>
                        @if ($participant->reception == '参加する')
                            参加
                        @endif
                    </td>
                    <td>{{ $participant->theme_division }}</td>
                    <td>
                        {!! Form::open(['route' => ['participants.destroy', $participant->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('participants.edit', [$participant->id]) }}" class='btn btn-default btn-xs'>
                                <span uk-icon="file-edit"></span>
                            </a>
                            {!! Form::button('<span uk-icon="trash"></span>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('本当に削除しますか?')",
                            ]) !!}
                            <a href="{{ url('/admin/absent/') }}/?q=ceremony&uuid={{ $participant->uuid }}"
                                class='btn btn-default btn-xs uk-button-danger'>式典</a>
                            <a href="{{ url('/admin/absent/') }}/?q=reception&uuid={{ $participant->uuid }}"
                                class='btn btn-default btn-xs uk-button-danger'>レセ</a>
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#participants-table').DataTable();
    });
</script>
