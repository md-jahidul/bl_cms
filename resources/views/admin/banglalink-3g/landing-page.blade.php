@extends('layouts.admin')
@section('title', 'Landing Page Data')
@section('card_name', '3G Landing Page')
@section('breadcrumb')
    <li class="breadcrumb-item ">3G Landing Page</li>
@endsection
@section('action')
{{--    <a href="{{ url("landing-page-component/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add New--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Components List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration"> <!--Datatable class: zero-configuration-->
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="10%">Title</th>
                            <th width="10%">Description</th>
{{--                            <th width="8%">Component Type</th>--}}
                            <th width="3%" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($componentList as $data)
                            <tr>
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td>{{ $data->title_en }} {!! $data->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                <td>{!! $data->description_en !!}</td>
{{--                                <td>{{ str_replace('_', ' ', ucwords($data->type)) }}</td>--}}
                                <td width="12%" class="text-right">
                                    <a href="{{ url("bl-3g-landing-page/$data->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
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
                        <form role="form" action="{{ route('three_g_banner_image.upload') }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <input type="hidden" value="banner_image" name="type">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Desktop)</label>
                                    <div class="custom-file">
{{--                                        {{ dd($bannerImage->other_attributes['banner_image_url']) }}--}}
{{--                                        <input type="hidden" name="old_web_img" value="--}}{{--{{ isset($fixedSectionData['image']) ? $fixedSectionData['image'] : '' }}--}}{{--">--}}
                                        <input type="file" name="other_attributes[banner_image_url]" data-height="90" class="dropify"
                                               data-default-file="{{ isset($bannerImage->other_attributes['banner_image_url']) ? config('filesystems.file_base_url') . $bannerImage->other_attributes['banner_image_url'] : '' }}">
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
                                        <input type="file" name="other_attributes[banner_mobile_view]" class="dropify" data-height="90"
                                               data-default-file="{{ isset($bannerImage->other_attributes['banner_mobile_view']) ? config('filesystems.file_base_url') . $bannerImage->other_attributes['banner_mobile_view'] : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_mobile_view'))
                                        <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="alt_text">Alt Text EN</label>
                                    <input type="text" name="other_attributes[alt_text_en]" id="alt_text" class="form-control"
                                           placeholder="Enter alt text en" value="{{ isset($bannerImage->other_attributes['alt_text_en']) ? $bannerImage->other_attributes['alt_text_en'] : '' }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="alt_text">Alt Text BN</label>
                                    <input type="text" name="other_attributes[alt_text_bn]" id="alt_text" class="form-control"
                                           placeholder="Enter alt text bn" value="{{ isset($bannerImage->other_attributes['alt_text_bn']) ? $bannerImage->other_attributes['alt_text_bn'] : '' }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="alt_text">Banner Name EN</label>
                                    <input type="text" name="other_attributes[banner_name_en]" id="alt_text" class="form-control"
                                           placeholder="Enter banner name en" value="{{ isset($bannerImage->other_attributes['banner_name_en']) ? $bannerImage->other_attributes['banner_name_en'] : '' }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="alt_text">Banner Name BN</label>
                                    <input type="text" name="other_attributes[banner_name_bn]" id="alt_text" class="form-control"
                                           placeholder="Enter alt text bn" value="{{ isset($bannerImage->other_attributes['banner_name_bn']) ? $bannerImage->other_attributes['banner_name_bn'] : '' }}">
                                </div>

                                <h5><strong>3G Landing Page Info</strong></h5>
                                <div class="form-actions col-md-12 mt-0"></div>

                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Page Header (HTML)</label>
                                    <textarea class="form-control" rows="7" name="other_attributes[page_header]">{{ isset($bannerImage->other_attributes['page_header']) ? $bannerImage->other_attributes['page_header'] : null }}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Page Header Bangla (HTML)</label>
                                    <textarea class="form-control" rows="7" name="other_attributes[page_header_bn]">{{ isset($bannerImage->other_attributes['page_header_bn']) ? $bannerImage->other_attributes['page_header_bn'] : null }}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('schema_markup') ? ' error' : '' }}">
                                    <label>Schema Markup</label>
                                    <textarea class="form-control" rows="7" name="other_attributes[schema_markup]">{{ isset($bannerImage->other_attributes['schema_markup']) ? $bannerImage->other_attributes['schema_markup'] : null }}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> JSON-LD (Recommended by Google)
                                    </small>
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
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
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
        // Sortable URL
        var auto_save_url = "{{ url('landing-page-sortable') }}";

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
    </script>
@endpush
