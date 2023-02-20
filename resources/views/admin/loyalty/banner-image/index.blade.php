{{--@extends('layouts.admin')--}}
{{--@section('title', 'Press News Event')--}}
{{--@section('card_name', 'Banner Images')--}}
{{--@section('breadcrumb')--}}
{{--    <li class="breadcrumb-item "> List</li>--}}
{{--@endsection--}}
{{--@section('action')--}}
{{--    <a href="{{ url("press-news-event/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add New--}}
{{--    </a>--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--    <!-- Fixed sections -->--}}
{{--    <section>--}}
{{--        <div class="card">--}}
{{--            <div class="card-content collapse show">--}}
{{--                <div class="card-body card-dashboard">--}}
{{--                    <h4 class="menu-title"><strong>Loyalty Banner Image</strong></h4>--}}
{{--                    <hr>--}}
{{--                    <div class="card-body card-dashboard">--}}
{{--                        <form role="form"--}}
{{--                              action="{{ url('about-page/banner-image/upload') }}"--}}
{{--                              method="POST" novalidate enctype="multipart/form-data">--}}
{{--                            @csrf--}}
{{--                            {{method_field('POST')}}--}}
{{--                            <div class="row">--}}
{{--                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">--}}
{{--                                    <label for="mobileImg">Banner Image (Desktop)</label>--}}
{{--                                    <div class="custom-file">--}}
{{--                                        <input type="hidden" name="loyalty_web_banner_old" value="{{ isset($aboutLoyalty->banner_image_url) ? $aboutLoyalty->banner_image_url : '' }}">--}}
{{--                                        <input type="file" name="banner_image_url" data-height="90" class="dropify"--}}
{{--                                               data-default-file="{{ isset($aboutLoyalty->banner_image_url) ? config('filesystems.file_base_url') . $aboutLoyalty->banner_image_url : '' }}">--}}
{{--                                    </div>--}}
{{--                                    <span class="text-primary">Please given file type (.png, .jpg)</span>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('banner_image_url'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('banner_image_url') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('banner_mobile_view'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label for="alt_text">Alt Text</label>--}}
{{--                                    <input type="text" name="alt_text_en" id="alt_text" class="form-control"--}}
{{--                                           placeholder="Enter alt text" value="{{ isset($aboutLoyalty->alt_text_en) ? $aboutLoyalty->alt_text_en : '' }}">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('alt_text'))--}}
{{--                                        <div class="help-block">{{ $errors->first('alt_text') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('banner_mobile_view'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label for="alt_text">Alt Text</label>--}}
{{--                                    <input type="text" name="alt_text_en" id="alt_text" class="form-control"--}}
{{--                                           placeholder="Enter alt text" value="{{ isset($aboutLoyalty->alt_text_en) ? $aboutLoyalty->alt_text_en : '' }}">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('alt_text'))--}}
{{--                                        <div class="help-block">{{ $errors->first('alt_text') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="col-md-12 mt-1"></div>--}}
{{--                                <h4><strong>Reword Point Banner Image</strong></h4>--}}
{{--                                <div class="form-actions col-md-12 mt-0"></div>--}}

{{--                                <div class="form-group col-md-6 {{ $errors->has('reward_banner_image_url') ? ' error' : '' }}">--}}
{{--                                    <label for="mobileImg">Banner Image (Desktop)</label>--}}
{{--                                    <div class="custom-file">--}}
{{--                                        <input type="hidden" name="reward_web_banner_old" value="{{ isset($aboutReward->banner_image_url) ? $aboutReward->banner_image_url : '' }}">--}}
{{--                                        <input type="file" name="reward_banner_image_url" data-height="90" class="dropify"--}}
{{--                                               data-default-file="{{ isset($aboutReward->banner_image_url) ? config('filesystems.file_base_url') . $aboutReward->banner_image_url : '' }}">--}}
{{--                                    </div>--}}
{{--                                    <span class="text-primary">Please given file type (.png, .jpg)</span>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('reward_banner_image_url'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('reward_banner_image_url') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6 {{ $errors->has('reward_banner_mobile_view') ? ' error' : '' }}">--}}
{{--                                    <label for="mobileImg">Banner Image (Mobile)</label>--}}
{{--                                    <div class="custom-file">--}}
{{--                                        <input type="hidden" name="reward_mobile_banner_old" value="{{ isset($aboutReward->banner_mobile_view) ? $aboutReward->banner_mobile_view : '' }}">--}}
{{--                                        <input type="file" name="reward_banner_mobile_view" class="dropify" data-height="90"--}}
{{--                                               data-default-file="{{ isset($aboutReward->banner_mobile_view) ? config('filesystems.file_base_url') . $aboutReward->banner_mobile_view : '' }}">--}}
{{--                                    </div>--}}
{{--                                    <span class="text-primary">Please given file type (.png, .jpg)</span>--}}

{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('reward_banner_mobile_view'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('reward_banner_mobile_view') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6 {{ $errors->has('reward_alt_text_en') ? ' error' : '' }}">--}}
{{--                                    <label for="reward_alt_text_en">Alt Text</label>--}}
{{--                                    <input type="text" name="reward_alt_text_en" id="reward_alt_text_en" class="form-control"--}}
{{--                                           placeholder="Enter alt text" value="{{ isset($aboutReward->alt_text_en) ? $aboutReward->alt_text_en : '' }}">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('reward_alt_text_en'))--}}
{{--                                        <div class="help-block">{{ $errors->first('reward_alt_text_en') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-actions col-md-12">--}}
{{--                                    <div class="pull-right">--}}
{{--                                        <button type="submit" class="btn btn-primary"><i--}}
{{--                                                class="la la-check-square-o"></i> Save--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@stop--}}

{{--@push('page-css')--}}
{{--    <style>--}}
{{--        #sortable tr td{--}}
{{--            padding-top: 5px !important;--}}
{{--            padding-bottom: 5px !important;--}}
{{--        }--}}
{{--    </style>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">--}}
{{--@endpush--}}

{{--@push('page-js')--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>--}}
{{--    <script type="text/javascript">--}}
{{--        $(function () {--}}
{{--            $('.dropify').dropify({--}}
{{--                messages: {--}}
{{--                    'default': 'Browse for an Image File to upload',--}}
{{--                    'replace': 'Click to replace',--}}
{{--                    'remove': 'Remove',--}}
{{--                    'error': 'Choose correct file format'--}}
{{--                },--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
