@extends('layouts.admin')

@section('title', 'Deeplink Redirection Edit')
@section('card_name', 'Deeplink Redirection Edit')

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('deeplink-redirection.index') }}">
            Deeplink Redirection List</a>
    </li>
    <li class="breadcrumb-item active"> Deeplink Redirection Edit</li>
@endsection

@section('action')
    <a href="{{ route('deeplink-redirection.index') }}" class="btn btn-warning btn-glow px-2">
        <i class="la la-list"></i> Cancel
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("deeplink-redirection.update", $redirection->id) }}" method="POST" novalidate>
                            {{method_field('PUT')}}
                           @include('admin.deeplink-redirection.form', ['page' => 'edit'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop











