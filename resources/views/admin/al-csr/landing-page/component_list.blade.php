@extends('layouts.admin')
@section('title', 'CSR Landing Page Component')
@section('card_name', 'CSR Landing Page')
@section('breadcrumb')
    <li class="breadcrumb-item ">CSR Landing Page Component</li>
@endsection
@section('action')
    <a href="{{ url("csr-landing-page-component/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Components List</strong></h4>
                    <table class="table table-striped table-bordered"> <!--Datatable class: zero-configuration-->
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="10%">Title</th>
                            <th width="8%">Component Type</th>
                            <th width="3%" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($componentList as $data)
                            <tr data-index="{{ $data->id }}" data-position="{{ $data->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $data->title_en }} {!! $data->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                <td>{{ str_replace('_', ' ', ucwords($data->component_type)) }}</td>
                                <td width="12%" class="text-right">
                                    <a href="{{ url("csr-landing-page-component/$data->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("csr-landing-page-component/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete">
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
{{--    <section>--}}
{{--        <div class="card">--}}
{{--            <div class="card-content collapse show">--}}
{{--                <div class="card-body card-dashboard">--}}
{{--                    <h4 class="menu-title"><strong>Banner Image</strong></h4>--}}
{{--                    <hr>--}}
{{--                    <div class="card-body card-dashboard">--}}
{{--                        <form role="form"--}}
{{--                              action="{{ route('banner_image_landing.upload') }}"--}}
{{--                              method="POST" novalidate enctype="multipart/form-data">--}}
{{--                            @csrf--}}
{{--                            {{method_field('POST')}}--}}
{{--                            <div class="row">--}}
{{--                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">--}}
{{--                                    <label for="mobileImg">Banner Image (Desktop)</label>--}}
{{--                                    <div class="custom-file">--}}
{{--                                        {{ dd($bannerImage->items['banner_image_url']) }}--}}
{{--                                        <input type="hidden" name="old_web_img" value="--}}{{----}}{{--{{ isset($fixedSectionData['image']) ? $fixedSectionData['image'] : '' }}--}}{{----}}{{--">--}}
{{--                                        <input type="file" name="banner_image_url" data-height="90" class="dropify"--}}
{{--                                               data-default-file="{{ isset($bannerImage->banner_image_url) ? config('filesystems.file_base_url') . $bannerImage->banner_image_url : '' }}">--}}
{{--                                    </div>--}}
{{--                                    <span class="text-primary">Please given file type (.png, .jpg)</span>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('banner_image_url'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('banner_image_url') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6 {{ $errors->has('banner_mobile_view') ? ' error' : '' }}">--}}
{{--                                    <label for="mobileImg">Banner Image (Mobile)</label>--}}
{{--                                    <div class="custom-file">--}}
{{--                                        <input type="hidden" name="old_mob_img" value="--}}{{----}}{{--{{ isset($fixedSectionData['banner_image_mobile']) ? $fixedSectionData['banner_image_mobile'] : '' }}--}}{{----}}{{--">--}}
{{--                                        <input type="file" name="banner_mobile_view" class="dropify" data-height="90"--}}
{{--                                               data-default-file="{{ isset($bannerImage->banner_mobile_view) ? config('filesystems.file_base_url') . $bannerImage->banner_mobile_view : '' }}">--}}
{{--                                    </div>--}}
{{--                                    <span class="text-primary">Please given file type (.png, .jpg)</span>--}}

{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('banner_mobile_view'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label for="alt_text">Alt Text</label>--}}
{{--                                    <input type="text" name="alt_text_en" id="alt_text" class="form-control"--}}
{{--                                           placeholder="Enter alt text" value="{{ isset($bannerImage->alt_text_en) ? $bannerImage->alt_text_en : '' }}">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('alt_text'))--}}
{{--                                        <div class="help-block">{{ $errors->first('alt_text') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label>Page Header</label>--}}
{{--                                    <textarea name="page_header" class="form-control" rows="4">{{ isset($bannerImage->page_header) ? $bannerImage->page_header : '' }}</textarea>--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label>Page Header BN</label>--}}
{{--                                    <textarea name="page_header_bn" class="form-control" rows="4">{{ isset($bannerImage->page_header_bn) ? $bannerImage->page_header_bn : '' }}</textarea>--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label>Schema Markup</label>--}}
{{--                                    <textarea name="schema_markup" class="form-control" rows="4">{{ isset($bannerImage->schema_markup) ? $bannerImage->schema_markup : '' }}</textarea>--}}
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
        var auto_save_url = "{{ url('csr-landing-page-sortable') }}";

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
