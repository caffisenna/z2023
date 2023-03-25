<script type="text/javascript" charset="utf8" src="{{ url('/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url('/datatables/dataTables.fixedHeader.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/datatables/jquery.dataTables.css') }}">
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
    <table class="uk-table uk-table-divider" id="participants-table">
        <thead>
            <tr>
                <th>氏名</th>
                <th>カテゴリ</th>
                <th>座席</th>
                <th>理由</th>
                {{-- <th>操作</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <td><a href="{{ route('participants.show', [$participant->id]) }}">{{ $participant->name }}</a>
                        <span class="uk-text-warning">
                            @if (isset($participant->vs))
                                <br>VS:{{ $participant->vs->name }}
                            @endif
                            @if (isset($participant->bs))
                                <br>BS:{{ $participant->bs->name }}
                            @endif
                        </span>
                    </td>
                    <td>{{ $participant->pref }}</td>
                    </td>
                    <td>{{ $participant->seat_number }}</td>
                    <td>
                        @if ($participant->self_absent == '発熱NG')
                            <span class="uk-text-danger">{{ $participant->self_absent }}</span>
                        @else
                            {{ $participant->self_absent }}
                        @endif
                    </td>
                    {{-- <td>
                        <div class='btn-group'>
                            <a href="{{ url('/admin/cancel_absent') . "/?uuid=$participant->uuid" }}" uk-toggle
                                class="uk-button uk-button-danger">取消し</a>
                        </div>
                        {!! Form::close() !!}
                    </td> --}}
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
