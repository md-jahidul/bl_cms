@extends('layouts.admin')
@section('title', 'Program Create')
@section('card_name', 'Program Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('bl-labs/program') }}">Program List</a></li>
    <li class="breadcrumb-item active"> Program Edit</li>
@endsection
@section('action')
    <a href="{{ url('bl-labs/program') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("bl-labs/program/$data->id") }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-body">
                                <div class="offset-2">
                                    <div class="col-md-10 row">
                                        <div class="form-group col-md-12 {{ $errors->has('name_en') ? ' error' : '' }}">
                                            <label for="name_en" class="required">Name (English)</label>
                                            <input type="text" name="name_en"  class="form-control" placeholder="Enter duration name in english"
                                                   value="{{ $data->name_en }}" required data-validation-required-message="Enter duration name in english">
                                            <div class="help-block"></div>
                                            @if ($errors->has('name_en'))
                                                <div class="help-block">  {{ $errors->first('name_en') }}</div>
                                            @endif
                                        </div>

                                        <div id="image" class="form-group col-md-12 {{ $errors->has('icon') ? ' error' : '' }}">
                                            <label for="alt_text">Icon</label>
                                            <div class="custom-file">
                                                <input type="file" name="icon" class="custom-file-input dropify" data-height="80"
                                                       data-max-file-size="50K"
                                                       data-allowed-file-extensions='["png", "jpg", "jpeg", "gif"]'
                                                       data-default-file="{{ config('filesystems.file_base_url') . $data->icon }}">
                                            </div>
                                            <span class="text-primary">Please given file type (.png, .jpg, .jpeg, GIF) </span>|
                                            <span class="text-danger"> Icon upload maximum 50KB</span>
                                            <div class="help-block"></div>
                                            @if ($errors->has('icon'))
                                                <div class="help-block">  {{ $errors->first('icon') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                                <label for="title" class="required mr-1">Is clickable:</label>

                                                <input type="radio" name="is_clickable" value="1" id="input-radio-15" checked>
                                                <label for="input-radio-15" class="mr-1">Yes</label>

                                                <input type="radio" name="is_clickable" value="0" id="input-radio-16">
                                                <label for="input-radio-16">No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                                <label for="title" class="required mr-1">Status:</label>

                                                <input type="radio" name="status" value="1" id="Active" {{ $data->status == 1 ? "checked" : '' }}>
                                                <label for="Active" class="mr-1">Active</label>

                                                <input type="radio" name="status" value="0" id="Inactive" {{ $data->status == 0 ? "checked" : '' }}>
                                                <label for="Inactive">Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> UPDATE
                                        </button>
                                    </div>
                                </div>
                            </div>
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














