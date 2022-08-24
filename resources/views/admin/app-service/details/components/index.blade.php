@extends('layouts.admin')
@section('title', 'Component List')
@section('card_name', 'Component List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Component List</li>
@endsection

@section('action')
    <a href="{{ route('app_service.details.list', ['type' => $data['tab_type'], 'id' => $data['product_id'] ]) }}" id="syncBtn" class="btn btn-outline-blue-grey round btn-glow px-2">
        Go Back Section
    </a>

    @if( $section_has_multiple_component == 1 || count($component_list) < 1 )
        <a href="{{ route("app-service-product.create") }}" class="btn btn-primary  round btn-glow px-2" data-toggle="modal" data-target="#add_compoent_item"><i class="la la-plus"></i>
            Add Component
        </a>
    @endif
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Components</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <td width="3%">#</td>
                                <th width="20%">Component Title</th>
                                <th width="5%">Component Type</th>
                                <th width="5%" class="text-center">Status</th>
                                {{-- <th class="text-center" width="8%">Add component</th> --}}
                                <th width="12%" class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ dd($section_has_multiple_component) }} --}}
                            @if( !empty($component_list) )
                            {{ $i = 1 }}
                            @foreach($component_list as $list)
                                {{--@if($product->product != '')--}}
                                    {{-- @php $path = 'partner-offers-home'; @endphp --}}
                                    {{-- <tr data-index="{{ $product->id }}" data-position="{{ $product->display_order }}"> --}}
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ !empty($list->title_en) ? $list->title_en : 'Component '.$i  }}</td>
                                        <td>{{ $list->component_type }}</td>
                                        <td>{{ $list->status }}</td>

                                        <td>
                                            {{-- <a href="{{ url("app-service/component/$list->id/edit") }}" role="button" class="www btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a> --}}
                                            <a href="{{ route('appservice.component.edit', [ 'type' => $data['tab_type'], 'id' => $list->id]) }}" role="button" class="www btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>


                                            @if( isset($list->is_default) && $list->is_default != 0 )
                                                <a href="#" remove="{{ url("app-service-product/$list->id/delete") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $list->id }}" title="Delete">
                                                    <i class="la la-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                {{--@endif--}}
                                {{ $i++ }}
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>


{{-- {{ dd($data) }} --}}

{{--<div class="modal fade" id="add_compoent_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--          <div class="modal-header">--}}
{{--            <h5 class="modal-title" id="exampleModalLabel">Add component with type</h5>--}}
{{--            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--              <span aria-hidden="true">&times;</span>--}}
{{--            </button>--}}
{{--          </div>--}}
{{--            <form id="product_details_form" role="form" action="{{ route('appservice.component.create') }}" method="GET" novalidate enctype="multipart/form-data">--}}
{{--                @csrf--}}
{{--              <div class="modal-body">--}}
{{--                <input type="hidden" name="tab_type" value="{{ $data['tab_type'] }}">--}}
{{--                <input type="hidden" name="section_id" value="{{ $data['section_id'] }}">--}}

{{--                <div class="row">--}}

{{--                    <div class="form-group col-md-12">--}}
{{--                        <label for="category_type">Select Component Type</label>--}}
{{--                        <select class="form-control" name="component_type" aria-invalid="false">--}}
{{--                                <option value="text_with_image_right">Text with image right</option>--}}
{{--                                <option value="text_with_image_bottom">Text with image bottom</option>--}}
{{--                                <option value="slider_text_with_image_right">Slider text with image right</option>--}}
{{--                                <option value="title_text_editor">Title with table editor</option>--}}
{{--                                <option value="video_with_text_right">Video with text right</option>--}}
{{--                                <option value="multiple_image_banner">Multiple image banner</option>--}}
{{--                                <option value="editor_only">Text Editor Only</option>--}}
{{--                                <option value="accordion">Accordion</option>--}}
{{--                            </select>--}}
{{--                    </div>--}}



{{--                </div>--}}

{{--              </div>--}}
{{--              <div class="modal-footer">--}}
{{--                <a type="button" href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>--}}
{{--                <button type="submit" class="btn btn-primary">Create Component</button>--}}
{{--              </div>--}}
{{--          </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div><!-- /.modal -->--}}
{{--<!-- Modal -->--}}


@stop

@push('page-css')
{{--    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">--}}
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')

<script type="text/javascript">
    jQuery(document).ready(function($){


        $('input.section_name').on('keyup', function(){
            var sectionName = $('#product_details_form').find('.section_name').val();
            var sectionNameLower = sectionName.toLowerCase();
            var sectionNameRemoveSpace = sectionNameLower.replace(/\s+/g, '-');

            $('#product_details_form').find('.auto_slug').empty().val(sectionNameRemoveSpace);

            // console.log(sectionNameRemoveSpace);
        });



    });
</script>

@endpush





