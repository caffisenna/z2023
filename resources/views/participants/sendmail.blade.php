@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>デジパス送信</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
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
                                <th>県連</th>
                                <th>所属</th>
                                <th>役務</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants as $participant)
                                <tr>
                                    <td><a
                                            href="{{ route('participants.show', [$participant->id]) }}">{{ $participant->name }}</a>
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
                                    <td>{{ $participant->district }}
                                        {{ $participant->dan }}{{ $participant->dan_number }}
                                    </td>
                                    <td>{{ $participant->role }}</td>
                                    <td>
                                        <div class='btn-group'>
                                            <a href="{{ url('/admin/sendmail') . "/?uuid=$participant->uuid" }}"
                                                onclick="return confirm('{{ $participant->name }}さんへデジタルパスを送信します。よろしいですか？')"
                                                class="uk-button uk-button-primary"><span uk-icon="mail"></span></a>
                                        </div>
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

                {{-- {{ $participants->links() }} --}}
            </div>

        </div>
    </div>
@endsection
