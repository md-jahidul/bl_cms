@extends('layouts.admin')
@section('title', 'Details Component List')
@section('card_name', 'Details Component List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ route('case-study-component.index', $sectionComponent->section_id) }}">Section Component List</a></li>
    <li class="breadcrumb-item ">Details Component List</li>
@endsection
@section('action')

<a href="{{ route("case-study-details.create", [$sectionComponent->id]) }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>Add Component</a>

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ $sectionComponent->title_en }} Components List</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <th width="5%">Component Type</th>
                                <th width="8%">Title</th>
                                <th width="12%" class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($components as $list)
                                <tr data-index="{{ $list->id }}" data-position="{{ $list->component_order }}">
                                    <td><i class="icon-cursor-move icons"></i></td>
                                    <td>{{ ucwords(str_replace('_', ' ', $list->component_type)) }} {!! $list->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                    <td>{{ $list->title_en  }}</td>
                                    <td class="text-right">
                                        <a href="{{ route("case-study-details.edit", [$sectionComponent->id, $list->id]) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ route('case-study-details.destroy', [$sectionComponent->id, $list->id]) }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $list->id }}" title="Delete">
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
                              action="{{ route('case-study-details-banner-image.upload') }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <input type="hidden" name="section_component_id" value="{{ $sectionComponent->id }}">
                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Desktop)</label>
                                    <div class="custom-file">
                                        <input type="file" name="banner_web" data-height="90" class="dropify"
                                               data-default-file="{{ isset($banner->banner_web) ? config('filesystems.file_base_url') . $banner->banner_web : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_web'))
                                        <div class="help-block">  {{ $errors->first('banner_web') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_mobile') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Mobile)</label>
                                    <div class="custom-file">
                                        <input type="file" name="banner_mobile" class="dropify" data-height="90"
                                               data-default-file="{{ isset($banner->banner_mobile) ? config('filesystems.file_base_url') . $banner->banner_mobile : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_mobile'))
                                        <div class="help-block">  {{ $errors->first('banner_mobile') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                    <label for="alt_text_en">Alt Text</label>
                                    <input type="text" name="alt_text_en" id="alt_text_en" class="form-control"
                                           placeholder="Enter alt text" value="{{ isset($banner->alt_text_en) ? $banner->alt_text_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_en'))
                                        <div class="help-block">{{ $errors->first('alt_text_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="alt_text">Alt Text Bangla</label>
                                    <input type="text" value="{{ isset($banner->alt_text_bn) ? $banner->alt_text_bn : '' }}"
                                           name="alt_text_bn"  class="form-control">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_bn'))
                                        <div class="help-block">{{ $errors->first('alt_text_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('image_name_en') ? ' error' : '' }}">
                                    <label for="image_name_en" class="required">Image Name En</label>
                                    <input type="text" name="image_name_en" class="form-control section_alt_text slug-convert"
                                           value="{{ isset($banner->image_name_en) ? $banner->image_name_en : '' }}" required>
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_en'))
                                        <div class="help-block">  {{ $errors->first('image_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                                    <label for="image_name_bn" class="required">Image Name Bn</label>
                                    <input type="text" name="image_name_bn" class="form-control section_alt_text slug-convert"
                                           value="{{ isset($banner->image_name_bn) ? $banner->image_name_bn : '' }}" required>
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_bn'))
                                        <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
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
        var auto_save_url = "{{ url('corporate/case-study-details-sort') }}";
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





