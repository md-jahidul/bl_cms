@extends('layouts.admin')
@section('title', 'Profession Create')
@section('card_name', 'Profession Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('bl-labs/profession') }}">Profession List</a></li>
    <li class="breadcrumb-item active"> Profession Create</li>
@endsection
@section('action')
    <a href="{{ url('bl-labs/profession') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url('bl-labs/profession') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="offset-2">
                                    <div class="col-md-10 row">
                                        <div class="form-group col-md-12 {{ $errors->has('name_en') ? ' error' : '' }}">
                                            <label for="name_en" class="required">Name (English)</label>
                                            <input type="text" name="name_en"  class="form-control" placeholder="Enter profession name"
                                                   value="{{ old("name_en") ? old("name_en") : '' }}" required data-validation-required-message="Enter profession name in english">
                                            <div class="help-block"></div>
                                            @if ($errors->has('name_en'))
                                                <div class="help-block">  {{ $errors->first('name_en') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                            <label for="title" class="required mr-1">Status:</label>

                                            <input type="radio" name="status" value="1" id="Active" checked>
                                            <label for="Active" class="mr-1">Active</label>

                                            <input type="radio" name="status" value="0" id="Inactive">
                                            <label for="Inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="la la-check-square-o"></i> SAVE</button>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush
@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
    <script>
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        })
    </script>
@endpush






