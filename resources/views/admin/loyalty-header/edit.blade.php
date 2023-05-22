@extends('layouts.admin')
@section('title', 'Loyalty Menu Edit')
@section('card_name', 'Loyalty Menu Edit')
@section('breadcrumb')
    @php
        $liHtml = '<li class="breadcrumb-item"><a href="'. url('priyojon') .'">Priyojon</a></li>';
        for($i = count($menu_items) - 1; $i >= 0; $i--){
            $liHtml .=  $i == 0 ? '<li class="breadcrumb-item active">' .  $menu_items[$i]['title_en']  . '</li>' :
                                  '<li class="breadcrumb-item"><a href="'. url("priyojon/". $menu_items[$i]["id"] . "/child-menu") .'">' .  $menu_items[$i]['title_en']  . '</a></li>';
        }
    @endphp
    {!! $liHtml !!}
@endsection
@section('action')
    <a href="{{ $priyojonLanding->parent_id == 0 ? url('priyojon') : url("priyojon/$priyojonLanding->parent_id/child-menu") }}"
       class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("priyojon/ $priyojonLanding->id") }}" method="POST" novalidate>
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $priyojonLanding->id }}">
                                <input type="hidden" name="parent_id" value="{{ $priyojonLanding->parent_id }}">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter duration name in english"
                                           value="{{ $priyojonLanding->title_en }}" required data-validation-required-message="Enter duration name in english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter duration name in english"
                                           value="{{ $priyojonLanding->title_bn }}" required data-validation-required-message="Enter duration name in english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                @if($priyojonLanding->parent_id != 0)
{{--                                    <div class="form-group col-md-6 {{ $errors->has('url') ? ' error' : '' }}">--}}
{{--                                        <label for="url">Redirect Url</label>--}}
{{--                                        <input type="text" name="url"  class="form-control" placeholder="Enter redirect url"--}}
{{--                                               value="{{ $priyojonLanding->url }}">--}}
{{--                                        <div class="help-block"></div>--}}
{{--                                        @if ($errors->has('url'))--}}
{{--                                            <div class="help-block">  {{ $errors->first('url') }}</div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}

                                    <div class="col-md-6">
                                        <label></label>
                                        <div class="form-group">
                                            <label for="title" class="mr-1">Status:</label>
                                            <input type="radio" name="status" value="1" id="active" {{ $priyojonLanding->status == 1 ? "checked" : '' }}>
                                            <label for="active" class="mr-1">Active</label>

                                            <input type="radio" name="status" value="0" id="inactive" {{ $priyojonLanding->status == 0 ? "checked" : '' }}>
                                            <label for="inactive">Inactive</label>
                                        </div>
                                    </div>
                                @endif

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
    @if($priyojonLanding->parent_id == 0)
        <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title"><strong>Banner Image</strong></h4>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('priyojon.banner', $priyojonLanding->id) }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">

                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}
                                {{ $priyojonLanding->is_images == 1 ? '' : 'd-none' }}" id="banner_image_url">
                                    <label for="banner_image_url">Banner Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="banner_image_url" data-height="90" class="dropify"
                                                data-default-file="{{ config('filesystems.file_base_url') . $priyojonLanding->banner_image_url }}">
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_image_url'))
                                        <div class="help-block">  {{ $errors->first('banner_image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_video_url') ? ' error' : '' }}
                                {{ $priyojonLanding->is_images == 1 ? 'd-none' : '' }}" id="banner_video_url">
                                    <label for="banner_video_url" class="required">Banner Video URL</label>
                                    <input type="text" name="banner_video_url" class="form-control" placeholder="Enter URL"
                                            value="{{ $priyojonLanding->banner_video_url }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_video_url'))
                                        <div class="help-block">  {{ $errors->first('banner_video_url') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-2 mt-1">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="is_images">Is Images:</label>
                                        <input type="checkbox" name="is_images" value="1" id="is_images" {{ $priyojonLanding->is_images == 1 ? 'checked' : '' }}>
                                    </div>
                                </div>




                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text">Alt Text</label>
                                    <input type="text" name="alt_text_en" id="alt_text" class="form-control"
                                           placeholder="Enter alt text" value="{{ isset($priyojonLanding->alt_text_en) ? $priyojonLanding->alt_text_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">{{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
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
    @endif
@stop
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                },
            });

            var banner_video_url = $('#banner_video_url');
            var banner_image_url = $('#banner_image_url');

            $('#is_images').click(function () {
                if($(this).prop("checked") == true){
                    banner_video_url.addClass('d-none');
                    banner_image_url.removeClass('d-none');
                }else{
                    banner_image_url.addClass('d-none')
                    banner_video_url.removeClass('d-none')
                }
            });
        });
    </script>
@endpush














