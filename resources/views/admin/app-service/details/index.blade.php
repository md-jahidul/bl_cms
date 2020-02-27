@extends('layouts.admin')
@section('title', 'Product Details Section List')
@section('card_name', 'Product Details Section List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Product Details Section List</li>
@endsection
@section('action')
{{--    <a href="#" id="syncBtn" class="btn btn-outline-blue-grey round btn-glow px-2">--}}
{{--        Sync Core Product--}}
{{--    </a>--}}
    <a href="{{ route("app-service-product.create") }}" class="btn btn-primary  round btn-glow px-2" data-toggle="modal" data-target="#add_details_with_compoent"><i class="la la-plus"></i>
        Add section
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Section List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <td width="3%">#</td>
                                <th width="20%">Section Name</th>
                                <th width="5%">Tab</th>
                                {{-- <th>Category</th> --}}
                                <th width="5%" class="text-center">Status</th>
                                <th class="text-center" width="8%">Add compoent</th>
                                <th width="12%" class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( !empty($section_list) )
                            {{ $i = 1 }}
                            @foreach($section_list as $list)
                                {{--@if($product->product != '')--}}
                                    @php $path = 'partner-offers-home'; @endphp
                                    {{-- <tr data-index="{{ $product->id }}" data-position="{{ $product->display_order }}"> --}}
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $list->section_name }}</td>
                                        <td>{{ $list->tab_type }}</td>
                                        <td>{{ $list->status }}</td>
                                        
                                        <td class="text-center">
                                             <a href="{{ route( "appservice.component.list", ['type' => $data['tab_type'], 'id' => $list->id] ) }}" class="btn-sm btn-outline-warning border">component</a>
                                        </td>
                                        
                                        <td>
                                            <a href="{{ url("app-service-product/$list->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                            
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
    
    {{-- {{ dd($data['tab_type']) }} --}}

    <div class="modal fade" id="add_details_with_compoent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add App and Service details with component</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form id="product_details_form" role="form" action="{{ route('app_service.details.store', [ 'type' => $data['tab_type'], 'id' => $data['product_id'] ]) }}" method="POST" novalidate enctype="multipart/form-data">
                    @csrf
                  <div class="modal-body">
                    
                    <div class="row">

                        <div class="form-group col-md-6 {{ $errors->has('section_name') ? ' error' : '' }}">
                            <label for="section_name" class="required">Section Name</label>
                            <input type="text" name="section_name" id="section_name" class="form-control section_name" placeholder="Give section a name"
                                   value="{{ old("section_name") ? old("section_name") : '' }}" required data-validation-required-message="This field can not be empty">
                            <div class="help-block"></div>
                            @if ($errors->has('section_name'))
                                <div class="help-block">{{ $errors->first('section_name') }}</div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 {{ $errors->has('slug') ? ' error' : '' }}">
                            <label for="slug" class="required">Section Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control auto_slug"
                                   value="{{ old("slug") ? old("slug") : '' }}" readonly required data-validation-required-message="This field can not be empty">
                            <div class="help-block"></div>
                            @if ($errors->has('slug'))
                                <div class="help-block">{{ $errors->first('slug') }}</div>
                            @endif
                        </div>
                        
                        <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                            <label for="title_en">Title (English)</label>
                            <input type="text" name="title_en" id="title_en" class="form-control" placeholder="Enter offer name in English"
                                   value="{{ old("title_en") ? old("title_en") : '' }}">
                            <div class="help-block"></div>
                            @if ($errors->has('title_en'))
                                <div class="help-block">{{ $errors->first('title_en') }}</div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                            <label for="title_bn">Title (Bangla)</label>
                            <input type="text" name="title_bn" id="title_bn" class="form-control" placeholder="Enter offer name in Bangla"
                                   value="{{ old("title_bn") ? old("title_bn") : '' }}">
                            <div class="help-block"></div>
                            @if ($errors->has('title_bn'))
                                <div class="help-block">{{ $errors->first('title_bn') }}</div>
                            @endif
                        </div>

                        {{-- <div class="form-group col-md-6">
                            <label for="category_type">Select Component Type</label>
                            <select class="form-control" name="component_type" aria-invalid="false">
                                    <option value="text_with_image_right">Text with image right</option>
                                    <option value="text_with_image_bottom">Text with image bottom</option>
                                    <option value="slider_text_with_image_right">Slider text with image right</option>
                                    <option value="title_text_editor">Title with table editor</option>
                                    <option value="video_with_text_right">Video with text right</option>
                                    <option value="multiple_image_banner">Multiple image banner</option>
                                </select>
                        </div> --}}

                        <div class="form-group col-md-6">
                            <label for="category_type">Section has multiple component</label>
                            <select class="form-control" name="multiple_component" aria-invalid="false">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="mr-1">Status:</label>
                                <input type="radio" name="status" value="1" id="active" checked>
                                <label for="active" class="mr-1">Active</label>

                                <input type="radio" name="status" value="0" id="inactive">
                                <label for="inactive">Inactive</label>
                            </div>
                        </div>
                        
                    </div>

                  </div>
                  <div class="modal-footer">
                    <a type="button" href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
              </form>
            </div>
        </div>
    </div><!-- /.modal -->
    <!-- Modal -->




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





