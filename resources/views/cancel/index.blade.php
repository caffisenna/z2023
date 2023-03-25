@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ url('/datatables/jquery.dataTables.css') }}">
    <script type="text/javascript" charset="utf8" src="{{ url('/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ url('/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#cancel_table thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#cancel_table thead');

            var table = $('#cancel_table').DataTable({
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
    <div class="container">
        <div class="card">
            <div style="background-color:#115740">
                <p class="uk-text-large uk-text-center" style="color:#FFF">キャンセル入力</p>
            </div>
            @include('flash::message')
            <div class="card-body p-0">
                @if (isset($participants))
                    <table class="uk-table uk-table-small" id="cancel_table">
                        <thead>
                            <tr>
                                <th>氏名</th>
                                <th>チェックイン</th>
                                <th>欠席</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants as $participant)
                                <tr class="uk-text-small">
                                    <td>{{ $participant->name }}<br>({{ $participant->furigana }})</td>
                                    {{-- チェックイン処理 --}}
                                    <td>
                                        @if (isset($participant->checkedin_at))
                                            <a href="{{ url('/s/cancel/?cat=checkin&uuid=') . $participant->uuid }}"
                                                class="uk-button uk-button-danger uk-button-small"
                                                onclick="return confirm('{{ $participant->name }}のチェックイン処理を取り消しますか?')"><span
                                                    uk-icon="ban"></span></a>
                                        @endif
                                    </td>
                                    {{-- 欠席処理 --}}
                                    <td>
                                        @if (isset($participant->self_absent))
                                            <a href="{{ url('/s/cancel/?cat=absent&uuid=') . $participant->uuid }}"
                                                class="uk-button uk-button-danger uk-button-small"
                                                onclick="return confirm('{{ $participant->name }}の欠席処理を取り消しますか?')"><span
                                                    uk-icon="ban"></span></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $participants->links() }} --}}
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cancel_table').DataTable();
        });
    </script>
@endsection
