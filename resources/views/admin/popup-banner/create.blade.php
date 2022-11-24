@extends('layouts.admin')
@section('title', 'Menu Create')
@section('card_name', 'Menu Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('popup-banner.index') }}">Popup Banner List</a></li>
{{--    @if($parent_id != 0)--}}
{{--        <li class="breadcrumb-item active">--}}
{{--            <a href="{{ ($parent_id == 0) ? url('mybl-menu') : url("mybl-menu/$parent_id/child-menu") }}">{{ $parentMenu->title_en }}</a>--}}
{{--        </li>--}}
{{--    @endif--}}

    <li class="breadcrumb-item active">Create</li>
@endsection
@section('action')
    <a href="{{ route('popup-banner.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                            action="{{ $page == 'create' ? route('popup-banner.store') : route('popup-banner.update', $popup->id)}}"
                            method="POST" novalidate enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="required">Banner Image</label>
                                    <input type="file"
                                            name="banner_data"
                                            data-max-file-size="2M"
                                            {{-- data-allowed-formats="portrait square" --}}
                                            data-allowed-file-extensions="jpeg png jpg"
                                            class="dropify"/>
                                </div>

                                <div class="form-group col-md-10 {{ $errors->has('deeplink') ? ' error' : '' }}">
                                    <label for="title" class="required">Deep Link</label>
                                    <input type="text" name="deeplink"  class="form-control" placeholder="Enter Deep Link"
                                            value="{{ old("deeplink") ? old("deeplink") : '' }}" required data-validation-required-message="Enter menu english label">
                                    <div class="help-block"></div>
                                    @if ($errors->has('deeplink'))
                                        <div class="help-block">  {{ $errors->first('deeplink') }}</div>
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







