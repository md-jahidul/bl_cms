<?php
function matchRelatedProduct($id, $relatedProductIds)
{
    if ($relatedProductIds) {
        foreach ($relatedProductIds as $productId) {
            if ($productId == $id) {
                return true;
            }
        }
    }
    return false;
}

?>

@extends('layouts.admin')
@section('title', 'App & Service')
@section('card_name', 'App & Service Product Details')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ route('app-service-product.index') }}">App Service Product List</a></li>
    <li class="breadcrumb-item ">Section List</li>
@endsection
@section('action')
    <a href="{{ route("app_service.details.create", [$tab_type, $product_id]) }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>Add Component</a>
@endsection
@section('content')
    <section>
        <!-- include tab wise product details -->
        @if($tab_type == "app")
            @include('admin.app-service.details.section.tab-details.app_tab_details')
        @elseif($tab_type == "vas")
            @include('admin.app-service.details.section.tab-details.vas_tab_details')
        @elseif($tab_type == "financial")
            @include('admin.app-service.details.section.tab-details.financial_tab_details')
        @elseif($tab_type == "others")
            @include('admin.app-service.details.section.tab-details.others_tab_details')
        @endif

        @yield('component_type_selector')

        <!-- # Section list with component card -->
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Section Component List</strong></h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="15%">Component Name</th>
                            <th width="15%">Preview</th>
                            <th width="15%">Title</th>
                            {{-- <th>Category</th> --}}
                            <th width="5%" class="">Status</th>
                            <th width="8%" class="">Action</th>
                        </tr>
                        </thead>
                        <tbody id="section_sortable">
                        {{--                            @if( !empty($section_list) )--}}
                        @foreach($section_list['section_body'] as $list)

                            @php $path = 'partner-offers-home'; @endphp
                            {{-- <tr> --}}
                            <tr data-index="{{ $list->id }}" data-position="{{ $list->section_order }}">
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $list->section_name }} {!! $list->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>

                                <td>
                                    @if( isset($list->section_type) )
                                        <div class="component_preview" style="max-width: 400px;">
                                            <img class="img-fluid" style="border: 1px solid #eee;"
                                                 src="{{asset('app-assets/images/app_services/'.$list->section_type.'.png')}}"
                                                 alt="">
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    @if( !empty($list->title_en) )
                                        {{ $list->title_en }}
                                    @else
                                        @if( isset($list->sectionComponent->first()->title_en) && !empty($list->sectionComponent->first()->title_en) )
                                            {{ $list->sectionComponent->first()->title_en }}
                                        @elseif( isset($list->sectionComponent->first()->description_en) && !empty($list->sectionComponent->first()->description_en) )
                                            {{ $list->sectionComponent->first()->description_en }}
                                        @endif
                                    @endif
                                </td>

                                <td>
                                    @if( $list->status == 1 )
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                    {{-- <a href="{{ route( "appservice.component.list", ['type' => $tab_type, 'id' => $list->id] ) }}" class="btn-sm btn-outline-warning border">component</a> --}}
                                </td>

                                <td>
                                    @if($list->section_type == "slider_text_with_image_right" ||
                                        $list->section_type == "multiple_image_banner" ||
                                        $list->section_type == "pricing_sections"
                                        )

                                        <a href="{{ route("app_service.details.edit", [$tab_type, $product_id, $list->id]) }}"
                                           role="button" class="btn-sm btn-outline-info border-0 section_component_edit"
                                           data-sections="{{$list->section_type}}">
                                            <i class="la la-pencil" aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{ route("app_service.details.edit", [$tab_type, $product_id, $list->id]) }}"
                                           class="btn-sm btn-outline-info border-0"
                                           data-sections="{{$list->section_type}}">
                                            <i class="la la-pencil" aria-hidden="true"></i></a>
                                    @endif

                                    @if( $list->is_default == 0 )
                                        <a href="#"
                                           remove="{{ route("app_service.sections.destroy", [$tab_type, $product_id, $list->id]) }}"
                                           class="border-0 btn-sm btn-outline-danger delete_btn"
                                           data-id="{{ $list->id }}" title="Delete">
                                            <i class="la la-trash"></i>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        {{--                            @endif--}}
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
                    <h4 class="menu-title"><strong>Banner</strong></h4>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('app_service.details.fixed-section', [$tab_type, $product_id ]) }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <input type="hidden" name="category" value="app_banner_fixed_section"
                                       class="custom-file-input" id="imgTwo">

                                <div class="form-group col-md-6 {{ $errors->has('image_url') ? ' error' : '' }}">
                                    <label for="alt_text">Banner Image (Desktop)</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input dropify" data-height="80"
                                               data-default-file="{{ config('filesystems.file_base_url') . $fixedSectionData['image'] }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg, .svg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('image_url'))
                                        <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('image_url') ? ' error' : '' }}">
                                    <label for="alt_text">Banner Image (Mobile)</label>
                                    <div class="custom-file">
                                        <input type="file" name="banner_image_mobile" class="custom-file-input dropify" data-height="80"
                                               data-default-file="{{ config('filesystems.file_base_url') . $fixedSectionData['banner_image_mobile'] }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg, .svg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('image_url'))
                                        <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text">Alt Text</label>
                                    <input type="text" name="alt_text" id="alt_text" class="form-control"
                                           placeholder="Enter alt text" value="{{ isset($fixedSectionData['alt_text']) ? $fixedSectionData['alt_text'] : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">{{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_name') ? ' error' : '' }}">
                                    <label for="banner_name">Banner Name</label>
                                    <input type="text" name="banner_name" id="banner_name" class="form-control"
                                           placeholder="Enter offer name in English"
                                           value="{{ isset($fixedSectionData['banner_name']) ? $fixedSectionData['banner_name'] : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_name'))
                                        <div class="help-block">{{ $errors->first('banner_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_title_en') ? ' error' : '' }}">
                                    <label for="banner_title_en">Banner Title En</label>
                                    <input type="text" name="banner_title_en" id="banner_title_en" class="form-control"
                                           placeholder="Enter offer name in English"
                                           value="{{ isset($fixedSectionData['banner_title_en']) ? $fixedSectionData['banner_title_en'] : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_title_en'))
                                        <div class="help-block">{{ $errors->first('banner_title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_title_bn') ? ' error' : '' }}">
                                    <label for="banner_title_bn">Banner Title Bn</label>
                                    <input type="text" name="banner_title_bn" id="banner_title_bn" class="form-control"
                                           placeholder="Enter offer name in English"
                                           value="{{ isset($fixedSectionData['banner_title_bn']) ? $fixedSectionData['banner_title_bn'] : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_title_bn'))
                                        <div class="help-block">{{ $errors->first('banner_title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_desc_en') ? ' error' : '' }}">
                                    <label for="banner_desc_en">Banner Description En</label>
                                    <textarea rows="5" name="banner_desc_en" id="banner_desc_en" class="form-control"
                                              placeholder="Enter offer name in English">{{ isset($fixedSectionData['banner_desc_en']) ? $fixedSectionData['banner_desc_en'] : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_desc_en'))
                                        <div class="help-block">{{ $errors->first('banner_desc_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_desc_bn') ? ' error' : '' }}">
                                    <label for="banner_desc_bn">Banner Description Bn</label>
                                    <textarea rows="5" name="banner_desc_bn" id="banner_desc_bn" class="form-control"
                                              placeholder="Enter offer name in English">{{ isset($fixedSectionData['banner_desc_bn']) ? $fixedSectionData['banner_desc_bn'] : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_desc_bn'))
                                        <div class="help-block">{{ $errors->first('banner_desc_bn') }}</div>
                                    @endif
                                </div>
                            </div>

                            <h5 class="menu-title"><strong>Related Product</strong></h5>
                            <hr>

                            <div class="row">
                                {{--                                @if($tab_type == "app" || $tab_type == "vas")--}}
                                <div class="form-group col-md-4 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en">Title (English)</label>
                                    <input type="text" name="title_en" id="title_en" class="form-control"
                                           placeholder="Enter offer name in English"
                                           value="{{ isset($fixedSectionData['title_en']) ? $fixedSectionData['title_en'] : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">{{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn">Title (Bangla)</label>
                                    <input type="text" name="title_bn" id="title_bn" class="form-control"
                                           placeholder="Enter offer name in Bangla"
                                           value="{{ isset($fixedSectionData['title_bn']) ? $fixedSectionData['title_bn'] : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group select-role col-md-4 mb-0 {{ $errors->has('role_id') ? ' error' : '' }}">
                                    <label for="role_id">Related Product</label>
                                    <div class="role-select">
                                        <select class="select2 form-control" multiple="multiple"
                                                name="other_attributes[related_product_id][]">
                                            @foreach($products as $product)
                                                <option
                                                    value="{{ $product->id }}" {{ isset($fixedSectionData['other_attributes']['related_product_id']) && matchRelatedProduct($product->id, $fixedSectionData['other_attributes']['related_product_id']) ? 'selected' : '' }}>{{$product->name_en}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('role_id'))
                                        <div class="help-block">  {{ $errors->first('role_id') }}</div>
                                    @endif
                                </div>
                                {{--                                @endif--}}

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

    @yield('component_modal_toadd')


@stop


@push('page-css')
    {{-- <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet"> --}}
    {{--    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">--}}
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td {
            padding-top: 15px !important;
            padding-bottom: 15px !important;
        }

        form .select-role.validate input:focus, form .select-role.issue input:focus, form .select-role.validate input {
            border-color: unset;
            -webkit-box-shadow: unset;
            -moz-box-shadow: unset;
            box-shadow: unset;
            border-width: 0;
            color: unset;
        }

        .modal-lg.modal_lg_custom {
            max-width: 1200px;
        }

        .note-editable {
            font-size: 14px;
        }
    </style>
@endpush

@push('page-js')
    {{--    <script src="{{ asset('app-assets/vendors/js/editors/summernote_0.8.18/summernote-lite.min.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('app-assets/vendors/js/editors/summernote_0.8.18/summernote-table-headers.js') }}" type="text/javascript"></script>--}}
    <script type="text/javascript">

        // $("textarea.js_editor_box").summernote({
        //     popover: {
        //         toolbar: [
        //             ['style', ['style'],['bold', 'italic', 'underline', 'clear']],
        //             ['font', ['strikethrough', 'superscript', 'subscript']],
        //             ['fontsize', ['fontsize']],
        //             ['color', ['color']],
        //             ['table', ['table']],
        //             ['para', ['ul', 'ol', 'paragraph']],
        //             ['view', ['fullscreen', 'codeview']]
        //         ],
        //
        //         table: [
        //             ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
        //             ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
        //             ['custom', ['tableHeaders']]
        //         ],
        //     },
        //
        //     height:150
        // })

        jQuery(document).ready(function ($) {
            // Preview changes on component selection
            $('#component_type').on('change', function () {
                var assetUrl = "{{asset('app-assets/images/app_services/')}}"
                $('#component_preview_img').attr('src', assetUrl + '/' + $(this).val() + '.png');
                $('#add_component_btn').attr('data-target', '#' + $(this).val());
            });

            $('#add_component_btn').click(function () {
                $('.table_component_wrap').find("input[name='component_title_en']").val('');
                $('.table_component_wrap').find("input[name='component_title_bn']").val('');
                $('#pricing_sections').find('.left_table').empty()
                $('#pricing_sections').find('.right_table').empty()
            })

        }); // Doc ready


        // Edit section components
        $('.section_component_edit').on('click', function (e) {
            e.preventDefault();

            // alert("Hii")

            var editUrl = $(this).attr('href');
            var modalComponent = $(this).attr('data-sections');

            console.log(editUrl)

            $.ajax({
                url: editUrl,
                cache: false,
                type: "GET",
                success: function (result) {

                    console.log(result)

                    if (result.status == 'SUCCESS') {
                        var $parentSelector = $('#' + modalComponent);
                        var baseUrl = "{{ config('filesystems.file_base_url') }}";

                        console.log($parentSelector)

                        $parentSelector.find('#form_save').hide();
                        $parentSelector.find('#form_update').show();

                        // Check component is slider?
                        if (result.data.sections.section_type == 'slider_text_with_image_right') {

                            var $parentSelectorEdit = $('#edit_' + modalComponent);


                            $parentSelectorEdit.modal('show');

                            // Set all sections
                            $.each(result.data.sections, function (k, v) {

                                if (k == 'title_en') {
                                    $parentSelectorEdit.find("input[name='sections[title_en]']").val(v);
                                }

                                if (k == 'title_bn') {
                                    $parentSelectorEdit.find("input[name='sections[title_bn]']").val(v);
                                }

                            });

                            // Add section id
                            $parentSelectorEdit.find('.section_id').val(result.data.sections.id);

                            $("input[name='sections[status]']").each(function (sk, sv) {
                                // console.log($(sv).val());
                                if ($(sv).val() == result.data.sections.status) {
                                    $(sv).attr('checked', true);
                                }

                            });


                            // Compoent foreach
                            $.each(result.data.component, function (cpk, cpv) {

                                $.each(cpv, function (ck, cv) {

                                    if (ck == 'id') {
                                        $parentSelectorEdit.find("input[name='component[" + cpk + "][id]']").val(cv);
                                        $('.tablecompoent_' + cpk).attr('data-component_id', cv);
                                    }

                                    // Multiple attribute parse
                                    if (ck == 'multiple_attributes') {

                                        if (typeof cv !== 'undefined') {
                                            var multiData = eval(JSON.parse(cv));
                                            $('#slider_sortable').empty();

                                            var component_id = $('.tablecompoent_' + cpk).attr('data-component_id');

                                            $.each(multiData, function (mck, mcv) {

                                                var html = '';

                                                if (mcv.status == "1") {
                                                    var statusText = 'Active';
                                                } else {
                                                    var statusText = 'Inactive';
                                                }

                                                html += '<tr data-index="' + mcv.id + '" data-position="' + mcv.display_order + '"><td>' + mck + '</td><td><img class="img-fluid" src="' + baseUrl + mcv.image_url + '" alt="" style="max-width:100px;" /></td><td>' + mcv.title_en + '</td><td>' + statusText + '</td><td><a href="#" class="multi_item_edit btn-sm btn-outline-info border-0" data-item_id="' + mcv.id + '" data-component_id="' + component_id + '"><i class="la la-pencil" aria-hidden="true"></i></a><a href="#" class="border-0 btn-sm btn-outline-danger delete_multi_attr_item" data-item_id="' + mcv.id + '" data-component_id="' + component_id + '" title="Delete"><i class="la la-trash"></i></a></td></tr>';

                                                $('#slider_sortable').append(html);

                                            });


                                            // Enable sortable for slider
                                            $("#slider_sortable").sortable({
                                                update: function (event, ui) {
                                                    $(this).children().each(function (index) {

                                                        if ($(this).attr('data-position') != (index + 1)) {
                                                            $(this).attr('data-position', (index + 1));
                                                        }
                                                        $(this).addClass('sorting_updated');
                                                    });
                                                    saveNewPositionsMultiAttr($(this));
                                                }
                                            });

                                        }
                                    }


                                    // Other attribute parse
                                    if (ck == 'other_attributes') {
                                        if (typeof cv !== 'undefined') {
                                            var otherAttrData = eval(JSON.parse(cv));

                                            $.each(otherAttrData, function (ock, ocv) {

                                                $parentSelectorEdit.find("input[name='component[" + cpk + "][other_attr][" + ock + "]']").val(ocv);

                                            });

                                        }
                                    }


                                });

                            });
                        }
                        // Check component is multiple banner image?
                        else if (result.data.sections.section_type == 'multiple_image_banner') {

                            var $parentSelectorEdit = $('#edit_' + modalComponent);


                            $parentSelectorEdit.modal('show');


                            // Add section id
                            $parentSelectorEdit.find('.section_id').val(result.data.sections.id);

                            $("input[name='sections[status]']").each(function (sk, sv) {
                                // console.log($(sv).val());
                                if ($(sv).val() == result.data.sections.status) {
                                    $(sv).attr('checked', true);
                                }

                            });


                            // Compoent foreach
                            $.each(result.data.component, function (cpk, cpv) {

                                $.each(cpv, function (ck, cv) {

                                    if (ck == 'id') {
                                        $parentSelectorEdit.find("input[name='component[" + cpk + "][id]']").val(cv);
                                        $('.tablecompoent_' + cpk).attr('data-component_id', cv);
                                    }

                                    // Multiple attribute parse
                                    if (ck == 'multiple_attributes') {
                                        // console.log(cv);

                                        if (typeof cv !== 'undefined') {
                                            var multiData = eval(JSON.parse(cv));
                                            $parentSelectorEdit.find('#slider_sortable').empty();

                                            var component_id = $('.tablecompoent_' + cpk).attr('data-component_id');

                                            $.each(multiData, function (mck, mcv) {

                                                var html = '';

                                                if (mcv.status == "1") {
                                                    var statusText = 'Active';
                                                } else {
                                                    var statusText = 'Inactive';
                                                }

                                                html += '<tr data-index="' + mcv.id + '" data-position="' + mcv.display_order + '"><td>' + mck + '</td><td><img class="img-fluid" src="' + baseUrl + mcv.image_url + '" alt="" style="max-width:100px;" /></td><td>' + mcv.alt_text + '</td><td>' + statusText + '</td><td><a href="#" class="banner_multi_item_edit btn-sm btn-outline-info border-0" data-item_id="' + mcv.id + '" data-component_id="' + component_id + '"><i class="la la-pencil" aria-hidden="true"></i></a><a href="#" class="border-0 btn-sm btn-outline-danger delete_multi_attr_item" data-item_id="' + mcv.id + '" data-component_id="' + component_id + '" title="Delete"><i class="la la-trash"></i></a></td></tr>';

                                                $parentSelectorEdit.find('#slider_sortable').append(html);

                                            });


                                            // Enable sortable for slider
                                            $parentSelectorEdit.find("#slider_sortable").sortable({
                                                update: function (event, ui) {
                                                    $(this).children().each(function (index) {

                                                        if ($(this).attr('data-position') != (index + 1)) {
                                                            $(this).attr('data-position', (index + 1));
                                                        }
                                                        $(this).addClass('sorting_updated');
                                                    });
                                                    saveNewPositionsMultiAttr($(this));
                                                }
                                            });

                                        }
                                    }


                                    // Other attribute parse
                                    if (ck == 'other_attributes') {
                                        if (typeof cv !== 'undefined') {
                                            var otherAttrData = eval(JSON.parse(cv));

                                            $.each(otherAttrData, function (ock, ocv) {

                                                $parentSelectorEdit.find("input[name='component[" + cpk + "][other_attr][" + ock + "]']").val(ocv);

                                            });

                                        }
                                    }


                                });

                            });


                        }
                        // Check component is Accordion?
                        else if (result.data.sections.section_type == 'accordion_section') {
                            var $parentSelectorEdit = $('#' + modalComponent);
                            $parentSelectorEdit.find('#accordion').empty();
                            $parentSelectorEdit.modal('show');
                            // Add section id
                            $parentSelectorEdit.find('.section_id').val(result.data.sections.id);
                            $("input[name='sections[status]']").each(function (sk, sv) {
                                // console.log($(sv).val());
                                if ($(sv).val() == result.data.sections.status) {
                                    $(sv).attr('checked', true);
                                }
                            });
                            // Compoent foreach
                            $.each(result.data.component, function (cpk, cpv) {
                                $.each(cpv, function (ck, cv) {
                                    if (ck == 'id') {
                                        $parentSelectorEdit.find("input[name='component[" + cpk + "][id]']").val(cv);
                                        $('.accordion_compoent_' + cpk).attr('data-component_id', cv);
                                    }
                                    // Multiple attribute parse
                                    if (ck == 'multiple_attributes') {
                                        // console.log(cv);
                                        if (typeof cv !== 'undefined') {
                                            var multiData = eval(JSON.parse(cv));
                                            // $parentSelectorEdit.find('#slider_sortable').empty();
                                            var lastItemId = multiData[multiData.length - 1].id;
                                            $parentSelectorEdit.find("input[name='component[" + cpk + "][multi_item_count]']").val(lastItemId);
                                            var component_id = $('.accordion_compoent_' + cpk).attr('data-component_id');

                                            $.each(multiData, function (mck, mcv) {

                                                console.log(mcv.editor_en)

                                                var html = '';

                                                mck++;

                                                html += '<div class="card accordion collapse-icon accordion-icon-rotate" data-index="' + mcv.id + '" data-position="' + mcv.display_order + '">' +
                                                    '<input type="hidden" name="component[0][multi_item][id-' + mck + ']" value="' + mcv.id + '">' +
                                                    '<input type="hidden" name="component[0][multi_item][display_order-' + mck + ']" value="' + mcv.display_order + '">' +
                                                    '<div class="card-header bg-info info"> ' +
                                                    '<div class="row"> ' +
                                                    '<div class="col-sm-12 m_bottom_6">' +
                                                    ' <a class="card-link collapsed" data-toggle="collapse" href="#collapse_' + mck + '" aria-expanded="false"> ' +
                                                    '<strong><i class="la la-sort"></i> Accordion Title #' + mck + '</strong> ' +
                                                    '</a> ' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '<div class="row card_header_extra"> ' +
                                                    '<div class="form-group col-md-6 "> ' +
                                                    '<label for="title_en" class="required">Title (English)</label>' +
                                                    ' <input type="text" name="component[0][multi_item][title_en-' + mck + ']" class="form-control" value="' + mcv.title_en + '" required> ' +
                                                    '<div class="help-block">' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '<div class="form-group col-md-6 ">' +
                                                    ' <label for="title_bn" class="required">Title (Bangla)</label> ' +
                                                    '<input type="text" name="component[0][multi_item][title_bn-' + mck + ']" class="form-control" value="' + mcv.title_bn + '" required>' +
                                                    ' <div class="help-block">' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '<div id="collapse_' + mck + '" class="collapse show1 border-info" data-parent="#accordion"> ' +
                                                    '<div class="card-body"> ' +
                                                    '<div class="row">' +
                                                    ' <div class="col-md-6">' +
                                                    ' <div class="form-group"> ' +
                                                    '<label for="exampleInputPassword1">Accordion content (English)</label> ' +
                                                    '<textarea name="component[0][multi_item][editor_en-' + mck + ']" class="form-control js_editor_box" rows="5" placeholder="Enter description">' + mcv.editor_en + '</textarea> ' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '<div class="col-md-6">' +
                                                    ' <div class="form-group">' +
                                                    ' <label for="exampleInputPassword1">Accordion content (Bangla)</label> <textarea name="component[0][multi_item][editor_bn-' + mck + ']" class="form-control js_editor_box" rows="5" placeholder="Enter description">' + mcv.editor_bn + '</textarea> </div></div></div></div><div class="card-footer"> <div class="row"> <div class="col-md-6"> <div class="form-group1">';

                                                if (mcv.status == "1") {
                                                    html += '<label for="title" class="mr-1">Status:</label> <input type="radio" name="component[0][multi_item][status-' + mck + ']" value="1" checked> <label for="active" class="mr-1">Active</label> <input type="radio" name="component[0][multi_item][status-' + mck + ']" value="0"> <label for="inactive">Inactive</label>';
                                                } else {
                                                    html += '<label for="title" class="mr-1">Status:</label> <input type="radio" name="component[0][multi_item][status-' + mck + ']" value="1"> <label for="active" class="mr-1">Active</label> <input type="radio" name="component[0][multi_item][status-' + mck + ']" value="0" checked> <label for="inactive">Inactive</label>';
                                                }


                                                html += '</div></div><div class="col-md-6"> <div class="float-right"> <a href="#" class="border-0 btn-sm btn-outline-danger delete_accordion_item" data-item_id="' + mck + '" title="Delete"> <i class="la la-trash"></i> </a> </div></div></div></div></div></div>';

                                                $parentSelectorEdit.find('#accordion').append(html);

                                            });

                                            // Enable sortable for slider
                                            $parentSelectorEdit.find("#accordion").sortable({
                                                connectWith: "#accordion",
                                                handle: ".card-header .card-link",
                                                cancel: ".portlet-toggle",
                                                placeholder: "portlet-placeholder ui-corner-all",
                                                update: function (event, ui) {
                                                    $(this).children().each(function (index) {

                                                        if ($(this).attr('data-position') != (index + 1)) {
                                                            $(this).attr('data-position', (index + 1));
                                                        }
                                                        $(this).addClass('sorting_updated');
                                                    });
                                                    saveNewPositionsMultiAttr($(this));
                                                }
                                            });

                                        }
                                    }


                                    // Other attribute parse
                                    if (ck == 'other_attributes') {
                                        if (typeof cv !== 'undefined') {
                                            var otherAttrData = eval(JSON.parse(cv));

                                            $.each(otherAttrData, function (ock, ocv) {

                                                $parentSelectorEdit.find("input[name='component[" + cpk + "][other_attr][" + ock + "]']").val(ocv);

                                            });

                                        }
                                    }


                                });

                            });


                            // editor reload
                            $('.js_editor_box').each(function (k, v) {
                                $(this).summernote({
                                    toolbar: [
                                        ['style', ['bold', 'italic', 'underline', 'clear']],
                                        ['font', ['strikethrough', 'superscript', 'subscript']],
                                        ['fontsize', ['fontsize']],
                                        ['color', ['color']],
                                        // ['table', ['table']],
                                        ['para', ['ul', 'ol', 'paragraph']],
                                        ['view', ['fullscreen', 'codeview']]
                                    ],
                                    height: 200
                                });
                            });


                        }

                        // Check component is Table?
                        else if (result.data.sections.section_type == "pricing_sections") {

                            // alert(modalComponent)

                            $('#pricing_sections' /*+ modalComponent*/).modal('show');
                            var tableData = result.data.sections.section_component[0];
                            var tableParseEn = $.parseJSON(tableData.editor_en)
                            var tableParseBn = $.parseJSON(tableData.editor_bn)

                            var sectionId = tableData.section_details_id
                            var componentId = tableData.id

                            $parentSelector.find("input[name='component_title_en']").val(result.data.sections.title_en);
                            $parentSelector.find("input[name='component_title_bn']").val(result.data.sections.title_bn);

                            $parentSelector.find("input[name='sections[id]']").val(sectionId);
                            $parentSelector.find("input[name='component[0][id]']").val(componentId);

                            var leftTable = '';
                            var leftTitleEn = (tableParseEn.left_table_title_en) ? tableParseEn.left_table_title_en : '';
                            var leftTitleBn = (tableParseBn.left_table_title_bn) ? tableParseBn.left_table_title_bn : '';

                            leftTable += '<div class="col-md-6 mt-1">' +
                                '<label><b>Left Table Title English</b></label>' +
                                '<input type="text" class="form-control" value="'+leftTitleEn+'" name="left_table_title_en">' +
                                '</div>';


                            leftTable += '<div class="col-md-6 mt-1">' +
                                '<label><b>Left Table Title Bangla</b></label>' +
                                '<input type="text" class="form-control" value="'+leftTitleBn+'" name="left_table_title_bn">' +
                                '</div>';

                            // left table Head En
                            leftTable += '<div class="col-md-12">\n' +
                                '<label class="label pt-2"><b>Left Table (English)</b></label>\n' +
                                '<table class="table table-bordered">\n' +
                                '<thead>\n' +
                                '<tr>';
                            $.each(tableParseEn.left_head_en, function (k, v) {
                                var value = (v !== null) ? v : "";
                                // leftTable += '<input type="text" placeholder="Head (EN) 1" value="'+value+'" name="left_head_en[2][]" width="33.333333333333336%">'
                                leftTable += '<th><input type="text" class="form-control" value="'+value+'" placeholder="Table head English" name="left_head_en[2][]"></th>';
                            });
                            leftTable += "</tr>\n" +
                                "</thead>";

                            // left table Row En
                            leftTable += "<tbody>";

                            $.each(tableParseEn.left_rows_en, function (k, v) {
                                leftTable += "<tr>";
                                $.each(v, function (ckey, childData) {
                                    var value = (childData !== null) ? childData : "";
                                    leftTable += '<td><input type="text" class="form-control" name="left_col_en[2]['+k+'][]" value="'+value+'"></td>';
                                });
                                leftTable += "<tr>";
                            });
                            leftTable += "</tbody><table><div>";

                            //========= left table BN head ===============
                            leftTable += '<div class="col-md-12 pl-0">\n' +
                                '<label class="label"><b>Left Table (Bangla)</b></label>\n' +
                                '<table class="table table-bordered">\n' +
                                '<thead>\n' +
                                '<tr>';

                            $.each(tableParseBn.left_head_bn, function (k, v) {
                                var value = (v !== null) ? v : "";
                                leftTable += '<th><input type="text" class="form-control" placeholder="Table head Bangla" value="'+value+'" name="left_head_bn[2][]"></th>';
                            });
                            leftTable += "</tr>\n" +
                                "</thead>";
                            // left table BN head

                            // left table BN Row
                            leftTable += "<tbody>";
                            $.each(tableParseBn.left_rows_bn, function (k, v) {
                                leftTable += '<tr>';
                                $.each(v, function (ckey, childData) {
                                    var value = (childData !== null) ? childData : "";
                                    leftTable += '<td><input type="text" class="form-control" name="left_col_bn[2]['+k+'][]" value="'+value+'"></td>'
                                });
                                leftTable += '</tr>';
                            });
                            leftTable += "</tbody><table><div>"
                            // left table BN Row
                            $(".left_table").html(leftTable);


                            // Right table Heaf En

                            if (tableParseEn.right_head_en) {
                                var rightTable = '';
                                var rightTitleEn = (tableParseEn.right_table_title_en) ? tableParseEn.right_table_title_en : '';
                                var rightTitleBn = (tableParseBn.right_table_title_bn) ? tableParseBn.right_table_title_bn : '';

                                rightTable += '<div class="col-md-6 mt-1">' +
                                    '<label><b>Right Table Title English</b></label>' +
                                    '<input type="text" class="form-control" value="'+rightTitleEn+'" name="right_table_title_en">' +
                                    '</div>';

                                rightTable += "<div class='col-md-6 mt-1'>" +
                                    '<label>Right Table Title Bangla</label>' +
                                    '<input type="text" class="form-control" value="'+rightTitleBn+'" name="right_table_title_bn">' +
                                    '</div>';

                                rightTable += '<div class="col-md-12">\n' +
                                    '<label class="label pt-2"><b>Right Table (English)</b></label>\n' +
                                    '<table class="table table-bordered">\n' +
                                    '<thead>\n' +
                                    '<tr>';
                                $.each(tableParseEn.right_head_en, function (k, v) {
                                    var value = (v !== null) ? v : "";
                                    rightTable += '<th><input type="text" class="form-control" placeholder="Table head English" value="'+value+'" name="right_head_en[2][]"></th>'
                                });
                                rightTable += "</tr></thead>";

                                // ======== Right Table Row En ===========
                                rightTable += "<tbody>";
                                $.each(tableParseEn.right_rows_en, function (k, v) {
                                    rightTable += '<tr>';
                                    $.each(v, function (ckey, childData) {
                                        var value = (childData !== null) ? childData : "";
                                        rightTable += '<td><input type="text" class="form-control" name="right_col_en[2]['+k+'][]" value="'+value+'"></td>';
                                    });
                                    rightTable += '</tr>';
                                });
                                rightTable += "</tbody><table><div>";


                                //========= Right table BN head ===============
                                rightTable += '<div class="col-md-12 pl-0">\n' +
                                    '<label class="label"><b>Right Table (Bangla)</b></label>\n' +
                                    '<table class="table table-bordered">\n' +
                                    '<thead>\n' +
                                    '<tr>';
                                $.each(tableParseBn.right_head_bn, function (k, v) {
                                    var value = (v !== null) ? v : "";
                                    rightTable += '<th><input type="text" class="form-control" placeholder="Table head English" value="'+value+'" name="right_head_bn[2][]"></th>';
                                });
                                rightTable += "</tr></thead>";
                                // Right table BN head

                                // ============== Right table BN Row ===================
                                rightTable += "<tbody>";
                                $.each(tableParseBn.right_rows_bn, function (k, v) {
                                    rightTable += '<tr>';
                                    $.each(v, function (ckey, childData) {
                                        var value = (childData !== null) ? childData : "";
                                        rightTable += '<td><input type="text" class="form-control" name="right_col_bn[2]['+k+'][]" value="'+value+'"></td>'
                                    });
                                    rightTable += '</tr>';
                                });
                                rightTable += "</tbody><table><div>";
                                // Right table BN Row

                                $(".right_table").html(rightTable);
                            }

                        }

                        else {
                            $('#' + modalComponent).modal('show');

                            // Set all sections
                            $.each(result.data.sections, function (k, v) {

                                if (k == 'title_en') {
                                    $parentSelector.find("input[name='sections[title_en]']").val(v);
                                }

                                if (k == 'title_bn') {
                                    $parentSelector.find("input[name='sections[title_bn]']").val(v);
                                }

                            });

                            // Add section id
                            $parentSelector.find('.section_id').val(result.data.sections.id);

                            $("input[name='sections[status]']").each(function (sk, sv) {
                                // console.log($(sv).val());
                                if ($(sv).val() == result.data.sections.status) {
                                    $(sv).attr('checked', true);
                                }

                            });


                            // Compoent foreach
                            $.each(result.data.component, function (cpk, cpv) {

                                $.each(cpv, function (ck, cv) {

                                    if (ck == 'title_en') {
                                        $parentSelector.find("input[name='component[" + cpk + "][title_en]']").val(cv);
                                    }

                                    if (ck == 'title_bn') {
                                        $parentSelector.find("input[name='component[" + cpk + "][title_bn]']").val(cv);
                                    }

                                    if (ck == 'alt_text') {
                                        $parentSelector.find("input[name='component[" + cpk + "][alt_text]']").val(cv);
                                    }


                                    if (ck == 'image') {
                                        $parentSelector.find('.imgDisplay').attr('src', baseUrl + cv).show();
                                    }

                                    if (ck == 'id') {
                                        $parentSelector.find("input[name='component[" + cpk + "][id]']").val(cv);
                                    }

                                    if (ck == 'video') {
                                        $parentSelector.find("input[type='text'][name='component[" + cpk + "][video_url]']").val(cv);
                                    }

                                    if (ck == 'description_en') {
                                        $parentSelector.find("textarea[name='component[" + cpk + "][description_en]']").val(cv);
                                    }

                                    if (ck == 'description_bn') {
                                        $parentSelector.find("textarea[name='component[" + cpk + "][description_bn]']").val(cv);
                                    }

                                    if (ck == 'editor_en') {
                                        $parentSelector.find("textarea[name='component[" + cpk + "][editor_en]']").val(cv);
                                        $parentSelector.find("textarea[name='component[" + cpk + "][editor_en]']").siblings('.note-editor').children('.note-editing-area').find('.note-editable').html(cv);
                                    }

                                    if (ck == 'editor_bn') {
                                        $parentSelector.find("textarea[name='component[" + cpk + "][editor_bn]']").val(cv);
                                        $parentSelector.find("textarea[name='component[" + cpk + "][editor_bn]']").siblings('.note-editor').children('.note-editing-area').find('.note-editable').html(cv);
                                    }


                                    // Other attribute parse
                                    if (ck == 'other_attributes') {
                                        if (typeof cv !== 'undefined') {
                                            var otherAttrData = eval(JSON.parse(cv));


                                            $.each(otherAttrData, function (ock, ocv) {

                                                // $parentSelector.find("input[name='component["+cpk+"][other_attr]["+ock+"]']").val(ocv);

                                                if (ock == 'video_type') {
                                                    if (ocv == 'youtube_video') {

                                                        $parentSelector.find('#select_video_type').children("option[value='youtube_video']").attr('selected', true).siblings().attr('selected', false);

                                                        $parentSelector.find('.youtube_video.form-group').show();
                                                        $parentSelector.find('.uploaded_video.form-group').hide();

                                                    } else if (ocv == 'uploaded_video') {
                                                        $parentSelector.find('#select_video_type').children("option[value='uploaded_video']").attr('selected', true).siblings().attr('selected', false);

                                                        $parentSelector.find('.uploaded_video.form-group').show();
                                                        $parentSelector.find('.youtube_video.form-group').hide();
                                                    }
                                                } else {
                                                    $parentSelector.find("input[name='component[" + cpk + "][other_attr][" + ock + "]']").val(ocv);
                                                }

                                            });

                                        }
                                    }


                                });

                            });
                        }
                    }


                },
                error: function (data) {
                    swal.fire({
                        title: 'Status change process failed!',
                        type: 'error',
                    });
                }
            });

        });


        // multi attribute sortable
        function saveNewPositionsMultiAttr($this) {
            var positions = [];
            $('.sorting_updated').each(function () {
                positions.push([
                    $(this).attr('data-index'),
                    $(this).attr('data-position')
                ]);
            });
            // var component_id = null;

            var componentID = $this.attr('data-component_id');

            // console.log(componentID);

            $.ajax({
                methods: "POST",
                url: "{{ url('app-service-component-attribute-sortable') }}",
                data: {
                    update: 1,
                    position: positions,
                    component_id: componentID,
                },
                success: function (data) {
                    console.log(data)
                },
                error: function () {
                    // window.location.replace(auto_save_url);
                }
            });
        }


        // Delete multiple attribute items
        $(document).on('click', '.delete_multi_attr_item', function (e) {
            e.preventDefault();

            // var confirm = confirm('Are you sure?');
            $this = $(this);

            if (confirm("Are you sure?")) {

                var itemID = $this.attr('data-item_id');
                var componentID = $this.attr('data-component_id');

                $.ajax({
                    type: "POST",
                    url: "{{ route('appservice.component.itemattr.destory') }}",
                    data: {
                        item_id: itemID,
                        component_id: componentID,
                        _token: "{{csrf_token()}}"
                    },
                    success: function (data) {
                        console.log(data)

                        if (data.status == "SUCCESS") {

                            $this.parents('tr').remove();
                        }

                    },
                    error: function () {
                        // window.location.replace(auto_save_url);
                    }
                });

            }


        });


        // Section sortable
        $("#section_sortable").sortable({
            update: function (event, ui) {
                $(this).children().each(function (index) {

                    if ($(this).attr('data-position') != (index + 1)) {
                        $(this).attr('data-position', (index + 1));
                    }
                    $(this).addClass('sorting_updated');
                });
                saveNewPositionsSections($(this));
            }
        });


        // multi attribute sortable
        function saveNewPositionsSections($this) {
            var positions = [];
            $('.sorting_updated').each(function () {
                positions.push([
                    $(this).attr('data-index'),
                    $(this).attr('data-position')
                ]);
            });

            $.ajax({
                methods: "POST",
                url: "{{ url('app-service-sections-sortable') }}",
                data: {
                    update: 1,
                    position: positions
                },
                success: function (data) {
                    console.log(data)
                },
                error: function () {
                    window.location.replace(auto_save_url);
                }
            });

        }

        $('.dropify').dropify({
            messages: {
                'default': 'Browse for an Image File to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct file format'
            }
        });

        // Image with Preview
        $(document).on('change', '.image_with_preview', function () {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).parents('.form-group').next('.form-group').find('.imgDisplay').css('display', 'block');
                    $(input).parents('.form-group').next('.form-group').find('.imgDisplay').attr('src', e.target.result);

                }
                reader.readAsDataURL(input.files[0]);
            }
            // console.log(input.files[0]);
        });
    </script>
@endpush





