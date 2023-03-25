@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    @if (url()->current() == url('/admin/not_checked_in'))
                        <h1>未チェックイン</h1>
                    @else
                        <h1>チェックイン済み</h1>
                    @endif
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
                @include('participants.checked_table')
                {{ $participants->links() }}
            </div>

        </div>
    </div>
@endsection
