@extends('layouts.admin')
@section('title', 'Menu Create')
@section('card_name', 'Menu Create')
@section('breadcrumb')
    @php
        $liHtml = '<li class="breadcrumb-item"><a href="'. url('menu') .'">Menu</a></li>';
        for($i = count($menu_items) - 1; $i >= 0; $i--){
            $liHtml .=  $i == 0 ? '<li class="breadcrumb-item active">' .  $menu_items[$i]['en_label_text']  . '</li>' :
                                  '<li class="breadcrumb-item"><a href="'. url("menu/". $menu_items[$i]["id"] . "/child-menu") .'">' .  $menu_items[$i]['en_label_text']  . '</a></li>';
        }
    @endphp

    {!! $liHtml !!}
@endsection
@section('action')
    <a href="{{ $parent_id == 0 ? url('menu') : url("menu/$parent_id/child-menu") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('menu.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                <div class="form-group col-md-6 {{ $errors->has('en_label_text') ? ' error' : '' }}">
                                    <label for="title" class="required">English Label</label>
                                    <input type="text" name="en_label_text"  class="form-control" placeholder="Enter english label"
                                           value="{{ old("en_label_text") ? old("en_label_text") : '' }}" required data-validation-required-message="Enter footer menu english label">
                                    <div class="help-block"></div>
                                    @if ($errors->has('en_label_text'))
                                        <div class="help-block">  {{ $errors->first('en_label_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('bn_label_text') ? ' error' : '' }}">
                                    <label for="title" class="required">Bangla Label</label>
                                    <input type="text" name="bn_label_text"  class="form-control" placeholder="Enter label in Bangla"
                                           value="{{ old("bn_label_text") ? old("bn_label_text") : '' }}" required data-validation-required-message="Enter label in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('bn_label_text'))
                                        <div class="help-block">  {{ $errors->first('bn_label_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('key') ? ' error' : '' }}" id="pageDynamic">
                                    <label for="code">Page URL</label>
                                    <select class="select2 form-control" name="code">
                                        <option value="">---Select Page---</option>
                                        @foreach($dynamicRoutes as $route)
                                            <option value="{{ $route->key }}">{{ $route->url }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('key'))
                                        <div class="help-block">  {{ $errors->first('key') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url') ? ' error' : '' }} d-none" id="externalLink">
                                    <label for="url" class="required">External URL</label>
                                    <input type="text" name="url" class="form-control slug-convert" placeholder="Enter URL"
                                           value="{{ old("url") ? old("url") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="external_link">Is External Menu:</label>
                                        <input type="checkbox" name="external_site" value="1" id="external_link">
                                    </div>
                                </div>

                                @if($parent_id != 0)
                                    <div class="form-group col-md-4 {{ $errors->has('description_en') ? ' error' : '' }}">
                                        <label>Description En</label>
                                        <textarea class="form-control" rows="5" name="description_en"></textarea>
                                    </div>

                                    <div class="form-group col-md-4 {{ $errors->has('description_bn') ? ' error' : '' }}">
                                        <label>Description BN</label>
                                        <textarea class="form-control" rows="5" name="description_bn"></textarea>
                                    </div>

                                    <div class="form-group col-md-4 {{ $errors->has('icon') ? ' error' : '' }}">
                                        <label for="mobileImg">Icon</label>
                                        <div class="custom-file">
                                            <input type="file" name="icon" data-height="90" class="dropify">
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('icon'))
                                            <div class="help-block">  {{ $errors->first('icon') }}</div>
                                        @endif
                                    </div>
                                @endif

                                <div class="col-md-6 float-left">
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

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(function () {
            var externalLink = $('#externalLink');
            var pageDynamic = $('#pageDynamic');

            $('#external_link').click(function () {
                if($(this).prop("checked") == true){
                    externalLink.removeClass('d-none');
                    pageDynamic.addClass('d-none');
                }else{
                    pageDynamic.removeClass('d-none')
                    externalLink.addClass('d-none')
                }
            })
            // Image Dropify
            $(function () {
                $('.dropify').dropify({
                    messages: {
                        'default': 'Browse for an Image File to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct file format'
                    },
                });
            });
        })
    </script>
@endpush







