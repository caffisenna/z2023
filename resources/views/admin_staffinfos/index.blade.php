@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>スタッフ情報</h1>
                </div>
                @unless(isset($staffinfo))
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right" href="{{ route('admin_staffinfos.create') }}">
                            スタッフ登録
                        </a>
                    </div>
                @endunless
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('admin_staffinfos.table')
            </div>
        </div>
    </div>
@endsection
