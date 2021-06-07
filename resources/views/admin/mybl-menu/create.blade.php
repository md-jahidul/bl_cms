@extends('layouts.admin')
@section('title', 'Menu Create')
@section('card_name', 'Menu Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('mybl-menu') }}">Menu</a></li>
    @if($parent_id != 0)
        <li class="breadcrumb-item active">
            <a href="{{ ($parent_id == 0) ? url('mybl-menu') : url("mybl-menu/$parent_id/child-menu") }}">{{ $parentMenu->title_en }}</a>
        </li>
    @endif

    <li class="breadcrumb-item active">Create</li>
@endsection
@section('action')
    <a href="{{ $parent_id == 0 ? url('mybl-menu') : url("mybl-menu/$parent_id/child-menu") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('mybl-menu.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="offset-2">
                                    <div class="form-group col-md-10 {{ $errors->has('title_en') ? ' error' : '' }}">
                                        <label for="title" class="required">English Label</label>
                                        <input type="text" name="title_en"  class="form-control" placeholder="Enter english label"
                                               value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter menu english label">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_en'))
                                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-10 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                        <label for="title" class="required">Bangla Label</label>
                                        <input type="text" name="title_bn"  class="form-control" placeholder="Enter label in Bangla"
                                               value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter label in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_bn'))
                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>

                                    @if($parent_id != 0)
                                        <div class="form-group col-md-10 {{ $errors->has('icon') ? ' error' : '' }}">
                                            <label for="alt_text" class="required">Icon</label>
                                            <div class="custom-file">
                                                <input type="file" name="icon" class="custom-file-input dropify"
                                                       required data-validation-required-message="Icon field is required" data-height="80">
                                            </div>
                                            {{-- <span class="text-primary">Please given file type (.png, .jpg)</span>--}}
                                            <div class="help-block"></div>
                                            @if ($errors->has('icon'))
                                                <div class="help-block">  {{ $errors->first('icon') }}</div>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="col-md-10">
                                        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                            <label for="title" class="required mr-1">Status:</label>

                                            <input type="radio" name="status" value="1" id="input-radio-15" checked>
                                            <label for="input-radio-15" class="mr-1">Active</label>

                                            <input type="radio" name="status" value="0" id="input-radio-16">
                                            <label for="input-radio-16">Inactive</label>

                                            @if ($errors->has('status'))
                                                <div class="help-block">  {{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="la la-check-square-o"></i> SAVE</button>
                                </div>
                                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
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
@endpush
@push('page-js')
{{--    <script>--}}
{{--        $(function () {--}}
{{--            var externalLink = $('#externalLink');--}}
{{--            $('#external_link').click(function () {--}}
{{--                if($(this).prop("checked") == true){--}}
{{--                    externalLink.removeClass('d-none');--}}
{{--                }else{--}}
{{--                    externalLink.addClass('d-none')--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
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







