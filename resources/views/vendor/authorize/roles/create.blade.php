{{--@extends('vendor.authorize.layouts.auth')--}}

{{--@section('content')--}}
{{--    <div class="panel panel-default">--}}
{{--        <div class="panel-heading">Create New Role</div>--}}
{{--        <div class="panel-body">--}}

{{--            @if ($errors->any())--}}
{{--                <ul class="alert alert-danger">--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            @endif--}}

{{--            {!! Form::open(['url' => '/' . Config("authorization.route-prefix") . '/roles', 'class' => 'form-horizontal', 'files' => true]) !!}--}}

{{--            @include ('vendor.authorize.roles.form')--}}

{{--            {!! Form::close() !!}--}}

{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}


@extends('layouts.admin')
@section('title', 'User Create')
@section('card_name', 'User Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('partners') }}"> User List</a></li>
    <li class="breadcrumb-item active"> User Create</li>
@endsection
@section('action')
    <a href="{{ url('partners') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        {!! Form::open(['url' => '/' . Config("authorization.route-prefix") . '/roles', 'class' => 'form-horizontal', 'files' => true]) !!}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name') ? ' error' : '' }}">
                                    <label for="name" class="required">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter company name english"
                                           value="{{ old("name") ? old("name") : '' }}" required data-validation-required-message="Enter role name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <div class="help-block">  {{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alias') ? ' error' : '' }}">
                                    <label for="alias" class="required">Alias</label>
                                    <input type="text" name="alias" id="alias" class="form-control" placeholder="alias" readonly
                                           value="{{ old("alias") ? old("alias") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alias'))
                                        <div class="help-block">  {{ $errors->first('alias') }}</div>
                                    @endif
                                </div>


                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        {!! Form::close() !!}
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
        var convertName2Alias = function () {
            var name = $(this).val().trim().toLowerCase().replace(/\s+/g, '_');
            var alias = $('#alias').val();
            if (alias == '') {
                $('#alias').val(name);
            }
        };
        $(function () {
            $('#name').on('change', convertName2Alias);
        });
    </script>
@endpush







