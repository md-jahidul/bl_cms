@extends('layouts.admin')
@section('title', 'Menu Create')
@section('card_name', 'Menu Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('manage-category.index') }}">Category List</a></li>
{{--    @if($parent_id != 0)--}}
{{--        <li class="breadcrumb-item active">--}}
{{--            <a href="{{ ($parent_id == 0) ? url('mybl-menu') : url("mybl-menu/$parent_id/child-menu") }}">{{ $parentMenu->title_en }}</a>--}}
{{--        </li>--}}
{{--    @endif--}}

    <li class="breadcrumb-item active">Create</li>
@endsection
@section('action')
    <a href="{{ route('manage-category.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('manage-category.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="offset-2">
                                    <div class="form-group col-md-10 {{ $errors->has('type') ? ' error' : '' }}">
                                        <label for="title" class="required">Choose Category Type</label><hr class="mt-0">
                                        <div class="row skin skin-square">
                                            <div class="col-md-4 col-sm-12">
                                                <input type="radio" name="type" value="game" id="game">
                                                <label for="game">Game (<span class="text-warning">Redirect URL</span>)</label>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <input type="radio" name="type" value="slider" id="slider" >
                                                <label for="slider">Slider (<span class="text-warning">Image/Video</span>)</label>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <input type="radio" name="type" value="service" id="service">
                                                <label for="service">Service (<span class="text-warning">CTA Action</span>)</label>
                                            </div>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('type'))
                                            <div class="help-block">  {{ $errors->first('type') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-10 {{ $errors->has('content_for') ? ' error' : '' }}">
                                        <label for="title" class="required">Content For</label><hr class="mt-0">
                                        <div class="row skin skin-square">
                                            <div class="col-md-4 col-sm-12">
                                                <input type="radio" name="content_for" value="bl" checked>
                                                <label for="content_for">Banglalink User</label>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <input type="radio" name="content_for" value="non-bl" >
                                                <label for="content_for">Non Banglalink User</label>
                                            </div>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('content_for'))
                                            <div class="help-block">  {{ $errors->first('content_for') }}</div>
                                        @endif
                                    </div>

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
                                    <div class="form-group col-md-10 {{ $errors->has('icon') ? ' error' : '' }}">
                                        <label for="alt_text" >Icon</label>
                                        <div class="custom-file">
                                            <input type="file" name="icon" class="custom-file-input dropify"
                                                   data-height="80">
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('icon'))
                                            <div class="help-block">  {{ $errors->first('icon') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-10 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                        <label for="title" class="">Android Version Code</label>
                                        <input type="text" name="android_version_code"  class="form-control" placeholder="Enter Version Code">
                                        <div class="help-block"></div>
                                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                        <div class="help-block"></div>
                                        @if ($errors->has('android_version_code'))
                                            <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-10 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                                        <label for="title" class="">iOS Version Code</label>
                                        <input type="text" name="ios_version_code"  class="form-control" placeholder="Enter Version Code">
                                        <div class="help-block"></div>
                                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                        <div class="help-block"></div>
                                        @if ($errors->has('ios_version_code'))
                                            <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                                        @endif
                                    </div>

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







