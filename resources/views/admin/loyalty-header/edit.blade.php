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

    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title"><strong>Banner Image</strong></h4>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('banner_image_press_news.upload') }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Desktop)</label>
                                    <div class="custom-file">
                                        {{--                                        {{ dd($bannerImage->items['banner_image_url']) }}--}}
                                        {{--                                        <input type="hidden" name="old_web_img" value="--}}{{--{{ isset($fixedSectionData['image']) ? $fixedSectionData['image'] : '' }}--}}{{--">--}}
                                        <input type="file" name="banner_image_url" data-height="90" class="dropify"
                                               data-default-file="{{ isset($pressBannerImage->banner_image_url) ? config('filesystems.file_base_url') . $pressBannerImage->banner_image_url : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_image_url'))
                                        <div class="help-block">  {{ $errors->first('banner_image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_mobile_view') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Mobile)</label>
                                    <div class="custom-file">
                                        {{--                                        <input type="hidden" name="old_mob_img" value="--}}{{--{{ isset($fixedSectionData['banner_image_mobile']) ? $fixedSectionData['banner_image_mobile'] : '' }}--}}{{--">--}}
                                        <input type="file" name="banner_mobile_view" class="dropify" data-height="90"
                                               data-default-file="{{ isset($pressBannerImage->banner_mobile_view) ? config('filesystems.file_base_url') . $pressBannerImage->banner_mobile_view : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_mobile_view'))
                                        <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text">Alt Text</label>
                                    <input type="text" name="alt_text_en" id="alt_text" class="form-control"
                                           placeholder="Enter alt text" value="{{ isset($pressBannerImage->alt_text_en) ? $pressBannerImage->alt_text_en : '' }}">
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
        });
    </script>
@endpush














