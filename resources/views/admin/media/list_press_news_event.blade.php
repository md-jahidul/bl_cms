@extends('layouts.admin')
@section('title', 'Press News Event')
@section('card_name', 'Press News Event')
@section('breadcrumb')
    <li class="breadcrumb-item ">Press Release And News Event List</li>
@endsection
@section('action')
    <a href="{{ url("press-news-event/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Press News Event List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="20%">Title</th>
                            <th width="20%">Type</th>
                            <th width="8%">Image</th>
                            <th width="25%">Short Description</th>
                            <th width="25%">Long Description</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pressNewsEvents as $data)
                            <tr>
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td>{{ $data->title_en }} {!! $data->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                <td>{{ str_replace('_', ' ', ucfirst($data->type)) }}</td>
                                <td><img src="{{ config('filesystems.file_base_url') . $data->thumbnail_image }}" height="50" width="70"></td>
                                <td>{{ $data->short_details_en }}</td>
                                <td>{!! $data->long_details_en !!}</td>
                                <td width="12%" class="text-center">
                                    <a href="{{ url("press-news-event/$data->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("press-news-event/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

    <!-- Fixed sections -->
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title"><strong>Press Release Banner Image</strong></h4>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('banner_image_press_news.upload') }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <input type="hidden" value="{{ isset($pressBannerImage->id) ? $pressBannerImage->id : '' }}" name="press_release_id">
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

                                <div class="form-group col-md-6 {{ $errors->has('banner_name_en') ? ' error' : '' }}">
                                    <label for="banner_name_en">Banner Name EN</label>
                                    <input type="text" name="banner_name_en" id="banner_name_en" class="form-control"
                                           placeholder="Enter banner name en" value="{{ isset($pressBannerImage->banner_name_en) ? $pressBannerImage->banner_name_en : '' }}">
                                    @if ($errors->has('banner_name_en'))
                                        <div class="help-block text-danger">{{ $errors->first('banner_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_name_bn') ? ' error' : '' }}">
                                    <label for="banner_name_bn">Banner Name BN</label>
                                    <input type="text" name="banner_name_bn" id="banner_name_bn" class="form-control"
                                           placeholder="Enter banner name bn" value="{{ isset($pressBannerImage->banner_name_bn) ? $pressBannerImage->banner_name_bn : '' }}">
                                    @if ($errors->has('banner_name_bn'))
                                        <div class="help-block text-danger">{{ $errors->first('banner_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                    <label for="alt_text">Alt Text EN</label>
                                    <input type="text" name="alt_text_en" id="alt_text" class="form-control"
                                           placeholder="Enter alt text en" value="{{ isset($pressBannerImage->alt_text_en) ? $pressBannerImage->alt_text_en : '' }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label>Alt Text BN</label>
                                    <input type="text" name="alt_text_bn" id="alt_text" class="form-control"
                                           placeholder="Enter alt text bn" value="{{ isset($pressBannerImage->alt_text_bn) ? $pressBannerImage->alt_text_bn : '' }}">
                                </div>

                                <div class="col-md-12 mt-1"></div>
                                <h4><strong>News Event Banner Image</strong></h4>
                                <div class="form-actions col-md-12 mt-0"></div>

                                <input type="hidden" value="{{ isset($newsBannerImage->id) ? $newsBannerImage->id : '' }}" name="news_event_id">
                                <div class="form-group col-md-6 {{ $errors->has('news_banner_image_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Desktop)</label>
                                    <div class="custom-file">
                                        {{--{{ dd($bannerImage->items['news_banner_image_url']) }}--}}
                                        {{--<input type="hidden" name="old_web_img" value="--}}{{--{{ isset($fixedSectionData['image']) ? $fixedSectionData['image'] : '' }}--}}{{--">--}}
                                        <input type="file" name="news_news_banner_image_url" data-height="90" class="dropify"
                                               data-default-file="{{ isset($newsBannerImage->banner_image_url) ? config('filesystems.file_base_url') . $newsBannerImage->banner_image_url : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('news_banner_image_url'))
                                        <div class="help-block">  {{ $errors->first('news_banner_image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('news_banner_mobile_view') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Mobile)</label>
                                    <div class="custom-file">
                                        {{--                                        <input type="hidden" name="old_mob_img" value="--}}{{--{{ isset($fixedSectionData['banner_image_mobile']) ? $fixedSectionData['banner_image_mobile'] : '' }}--}}{{--">--}}
                                        <input type="file" name="news_banner_mobile_view" class="dropify" data-height="90"
                                               data-default-file="{{ isset($newsBannerImage->banner_mobile_view) ? config('filesystems.file_base_url') . $newsBannerImage->banner_mobile_view : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('news_banner_mobile_view'))
                                        <div class="help-block">  {{ $errors->first('news_banner_mobile_view') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('news_banner_name_en') ? ' error' : '' }}">
                                    <label for="news_banner_name_en">Banner Name EN</label>
                                    <input type="text" name="news_banner_name_en" id="news_banner_name_en" class="form-control"
                                           placeholder="Enter banner name en" value="{{ isset($newsBannerImage->banner_name_en) ? $newsBannerImage->banner_name_en : '' }}">
                                    @if ($errors->has('news_banner_name_en'))
                                        <div class="help-block text-danger">{{ $errors->first('news_banner_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('news_banner_name_bn') ? ' error' : '' }}">
                                    <label for="news_banner_name_bn">Banner Name BN</label>
                                    <input type="text" name="news_banner_name_bn" id="banner_name_bn" class="form-control"
                                           placeholder="Enter banner name bn" value="{{ isset($newsBannerImage->banner_name_bn) ? $newsBannerImage->banner_name_bn : '' }}">
                                    @if ($errors->has('news_banner_name_bn'))
                                        <div class="help-block text-danger">{{ $errors->first('news_banner_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                    <label for="alt_text">Alt Text EN</label>
                                    <input type="text" name="news_alt_text_en" id="alt_text" class="form-control"
                                           placeholder="Enter alt text en" value="{{ isset($newsBannerImage->alt_text_en) ? $newsBannerImage->alt_text_en : '' }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label>Alt Text BN</label>
                                    <input type="text" name="news_alt_text_bn" id="alt_text" class="form-control"
                                           placeholder="Enter alt text bn" value="{{ isset($newsBannerImage->alt_text_bn) ? $newsBannerImage->alt_text_bn : '' }}">
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
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
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
