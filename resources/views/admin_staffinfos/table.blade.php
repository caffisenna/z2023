<script type="text/javascript" charset="utf8" src="{{ url('/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url('/datatables/dataTables.fixedHeader.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/datatables/jquery.dataTables.css') }}">
<script type="text/javascript">
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#staffinfos-table thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#staffinfos-table thead');

        var table = $('#staffinfos-table').DataTable({
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
    <table class="uk-table uk-table-divider" id="staffinfos-table">
        <thead>
            <tr>
                <th>氏名</th>
                <th>チーム</th>
                <th>所属</th>
                <th>役務</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staffinfos as $staffinfo)
                <tr>
                    <td>
                        @if (isset($staffinfo->checkedin_at))
                            <span
                                class="uk-text-success">{{ $staffinfo->user->name }}<br>({{ $staffinfo->furigana }})</span>
                        @else
                            {{ $staffinfo->user->name }}<br>({{ $staffinfo->furigana }})
                        @endif
                    </td>
                    <td>{{ $staffinfo->team }}</td>
                    <td>{{ $staffinfo->prefecture }}連盟<br>{{ $staffinfo->district }}地区
                        {{ $staffinfo->dan }}団</td>
                    <td>{{ $staffinfo->role }}</td>
                    <td>
                        {!! Form::open(['route' => ['admin_staffinfos.destroy', $staffinfo->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin_staffinfos.edit', [$staffinfo->id]) }}"
                                class='btn btn-default btn-xs'>
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
            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#staffinfos-table').DataTable();
    });
</script>
