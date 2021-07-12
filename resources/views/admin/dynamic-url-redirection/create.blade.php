@extends('layouts.admin')
@section('title', 'Dynamic URL Redirection Create')
@section('card_name', 'Dynamic URL Redirection Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('dynamic-url-redirection.index') }}">Dynamic URL Redirection List</a></li>
    <li class="breadcrumb-item active"> Dynamic URL Redirection Create</li>
@endsection

@section('action')
    <a href="{{ route('dynamic-url-redirection.index') }}" class="btn btn-warning  btn-glow px-2">
        <i class="la la-list"></i> Cancel
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('dynamic-url-redirection.store') }}" method="POST"
                              novalidate>
                            @include('admin.dynamic-url-redirection.form', ['page' => 'create'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush

@push('page-js')
    <script>
        $('#redirection_for').change(function () {
            switch ($(this).val()) {
                case "product":
                    $('#identifier_notation').html("Enter Product Code");
                    break;
                case "dynamic_link":
                    $('#identifier_notation').html("Enter Dynamic Link");
                    break;
                default:
                    $('#identifier_notation').html("Enter according to selected Url For");
                    break;
            }

        });
    </script>
@endpush
