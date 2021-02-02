@extends('layouts.admin')
@section('title', 'TVC Video List')
@section('card_name', 'TVC Video List')
@section('breadcrumb')
    <li class="breadcrumb-item ">TVC Video List</li>
@endsection
@section('action')
    <a href="{{ url("tvc-video/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>TVC Video List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="10%">Title</th>
                            <th width="8%">Video</th>
                            <th width="3%" class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tvcVideos as $data)
                            <tr>
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td>{{ $data->title_en }} {!! $data->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                <td><iframe width="300" height="150" src="{{ $data->video_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
                                <td width="12%" class="text-center">
                                    <a href="{{ url("tvc-video/$data->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("tvc-video/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete">
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
                    <h4 class="menu-title"><strong>Banner Image</strong></h4>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('banner_image_tvc_video.upload') }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <input type="hidden" value="{{ isset($bannerImage->id) ? $bannerImage->id : '' }}"  name="tvc_banner_id">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Desktop)</label>
                                    <div class="custom-file">
                                        {{--                                        {{ dd($bannerImage->items['banner_image_url']) }}--}}
                                        {{--                                        <input type="hidden" name="old_web_img" value="--}}{{--{{ isset($fixedSectionData['image']) ? $fixedSectionData['image'] : '' }}--}}{{--">--}}
                                        <input type="file" name="banner_image_url" data-height="90" class="dropify"
                                               data-default-file="{{ isset($bannerImage->banner_image_url) ? config('filesystems.file_base_url') . $bannerImage->banner_image_url : '' }}">
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
                                               data-default-file="{{ isset($bannerImage->banner_mobile_view) ? config('filesystems.file_base_url') . $bannerImage->banner_mobile_view : '' }}">
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
                                           placeholder="Enter banner name en" value="{{ isset($bannerImage->banner_name_en) ? $bannerImage->banner_name_en : '' }}">
                                    @if ($errors->has('banner_name_en'))
                                        <div class="help-block text-danger">{{ $errors->first('banner_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_name_bn') ? ' error' : '' }}">
                                    <label for="banner_name_bn">Banner Name BN</label>
                                    <input type="text" name="banner_name_bn" id="banner_name_bn" class="form-control"
                                           placeholder="Enter banner name bn" value="{{ isset($bannerImage->banner_name_bn) ? $bannerImage->banner_name_bn : '' }}">
                                    @if ($errors->has('banner_name_bn'))
                                        <div class="help-block text-danger">{{ $errors->first('banner_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text">Alt Text</label>
                                    <input type="text" name="alt_text_en" id="alt_text" class="form-control"
                                           placeholder="Enter alt text" value="{{ isset($bannerImage->alt_text_en) ? $bannerImage->alt_text_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">{{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Page Header</label>
                                    <textarea name="page_header" class="form-control" rows="4">{{ isset($bannerImage->page_header) ? $bannerImage->page_header : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Page Header BN</label>
                                    <textarea name="page_header_bn" class="form-control" rows="4">{{ isset($bannerImage->page_header_bn) ? $bannerImage->page_header_bn : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Schema Markup</label>
                                    <textarea name="schema_markup" class="form-control" rows="4">{{ isset($bannerImage->schema_markup) ? $bannerImage->schema_markup : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                    <label for="alt_text">Alt Text EN</label>
                                    <input type="text" name="alt_text_en" id="alt_text" class="form-control"
                                           placeholder="Enter alt text en" value="{{ isset($bannerImage->alt_text_en) ? $bannerImage->alt_text_en : '' }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label>Alt Text BN</label>
                                    <input type="text" name="alt_text_bn" id="alt_text" class="form-control"
                                           placeholder="Enter alt text bn" value="{{ isset($bannerImage->alt_text_bn) ? $bannerImage->alt_text_bn : '' }}">
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
