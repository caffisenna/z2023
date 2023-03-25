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
    <table class="uk-table uk-table-divider uk-table-hover" id="participants-table">
        <thead>
            <tr>
                <th>カテゴリ</th>
                <th>役務</th>
                <th>氏名</th>
                <th>座席</th>
                <th>参加費</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <td>{{ $participant->pref }}</td>
                    <td>
                        @switch($participant->category)
                            @case('県連代表(1)')
                                <span class="uk-text-success">理事長</span>
                            @break

                            @case('県連代表(2)')
                                <span class="uk-text-success">県コミッショナー</span>
                            @break

                            @case('県連代表(3)')
                                <span class="uk-text-success">事務局長</span>
                            @break

                            @case('県連代表(4)')
                                <span class="uk-text-success">引率指導者</span>
                            @break

                            @case('県連代表(5)')
                                <span class="uk-text-success">VSスカウト</span>
                            @break

                            @case('県連代表(6)')
                                <span class="uk-text-success">BSスカウト</span>
                            @break

                            @default
                                任意参加者
                        @endswitch
                        @if (isset($participant->is_proxy) && $participant->is_proxy !== '')
                            <br><span class="uk-text-small">(代理:{{ $participant->is_proxy }})</span>
                        @endif
                    </td>
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
                    <td>
                        @if (isset($participant->seat_number))
                            式典:{{ $participant->seat_number }}
                            @if (isset($participant->self_absent))
                                <span class="uk-text-danger">(欠)</span>
                            @endif
                        @endif
                        @if (isset($participant->reception_seat_number))
                            <br>レセ:{{ $participant->reception_seat_number }}
                            @if (isset($participant->reception_self_absent))
                                <span class="uk-text-danger">(欠)</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if (isset($participant->fee_checked_at))
                            済み
                        @endif
                    </td>
                    <td>
                        {!! Form::open(['route' => ['participants.destroy', $participant->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('participants.edit', [$participant->id]) }}"
                                class='btn btn-default btn-xs'>
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
