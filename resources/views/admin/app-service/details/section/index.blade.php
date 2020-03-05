<?php
function matchRelatedProduct($id, $roles)
{
    if ($roles) {
        foreach ($roles as $role) {
            if ($role == $id) {
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
    
@endsection
@section('content')
    <section>
        
        <!-- # Section add component -->
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Add section components</strong></h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="category_type">Select Component Type</label>
                                <select id="component_type" class="form-control" name="component_type" aria-invalid="false">
                                    <option value="text_with_image_right">Text with image right</option>
                                    <option value="text_with_image_bottom">Text with image bottom</option>
                                    <option value="slider_text_with_image_right">Slider text with image right</option>
                                    <option value="video_with_text_right">Video with text right</option>
                                    <option value="multiple_image_banner">Multiple image banner</option>
                                    <option value="pricing_mutiple_table">Pricing Multiple table</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <a id="add_component_btn" href="{{ route("app-service-product.create") }}" class="btn btn-primary  round btn-glow px-1" data-toggle="modal" data-target="#text_with_image_right"><i class="la la-plus"></i>
                                    Add Component
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="category_type">Component Preview</label>
                                <div id="component_preview" class="component_preview" style="max-width: 400px;min-height: 200px;">
                                    <img id="component_preview_img" class="img-fluid" style="border: 1px solid #eee;" src="{{asset('app-assets/images/app_services/text_with_image_right.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        

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
                                <th width="20%">Component Name</th>
                                <th width="15%">Preview</th>
                                {{-- <th width="5%">Section Title</th> --}}
                                {{-- <th>Category</th> --}}
                                <th width="12%" class="">Status</th>
                                <th width="12%" class="">Action</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
{{--                            @if( !empty($section_list) )--}}
                                @foreach($section_list['section_body'] as $list)

                                        @php $path = 'partner-offers-home'; @endphp
                                        {{-- <tr> --}}
                                        <tr data-index="{{ $list->id }}" data-position="{{ $list->section_order }}">
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $list->section_name }} {!! $list->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>

                                            <td>
                                                @if( isset($list->sectionComponent[0]->component_type) )
                                                <div class="component_preview" style="max-width: 400px;">
                                                <img class="img-fluid" style="border: 1px solid #eee;" src="{{asset('app-assets/images/app_services/'.$list->sectionComponent[0]->component_type.'.png')}}" alt="">
                                                </div>
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
                                                <a href="{{ route("app_service.details.edit", [$tab_type, $product_id, $list->id]) }}" role="button" class="btn-sm btn-outline-info border-0 section_component_edit">
                                                    <i class="la la-pencil" aria-hidden="true"></i></a>
                                                {{-- <a href="#" remove="{{ url("offers/$list->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $list->id }}" title="Delete">
                                                    <i class="la la-trash"></i>
                                                </a> --}}
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
                    <h4 class="menu-title"><strong>Banner And Related Product</strong></h4><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('app_service.details.fixed-section', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <input type="hidden" name="category" value="{{ $tab_type }}_banner_image" class="custom-file-input" id="imgTwo">

                                <div class="form-group col-md-6 {{ $errors->has('mobile_view_img') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_image'))
                                        <div class="help-block">  {{ $errors->first('image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    @if($fixedSectionData['image'])
                                        <img src="{{ config('filesystems.file_base_url') . $fixedSectionData['image'] }}" height="100" width="200" id="imgDisplay">
                                    @else
                                        <img height="100" width="200" id="imgDisplay" style="display: none">
                                    @endif
                                </div>

                                @if($tab_type == "app" || $tab_type == "vas")
                                    <div class="form-group col-md-4 {{ $errors->has('title_en') ? ' error' : '' }}">
                                        <label for="title_en">Title (English)</label>
                                        <input type="text" name="title_en" id="title_en" class="form-control" placeholder="Enter offer name in English"
                                               value="{{ $fixedSectionData['title_en'] }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_en'))
                                            <div class="help-block">{{ $errors->first('title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                        <label for="title_bn">Title (Bangla)</label>
                                        <input type="text" name="title_bn" id="title_bn" class="form-control" placeholder="Enter offer name in Bangla"
                                               value="{{ $fixedSectionData['title_bn'] }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_bn'))
                                            <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group select-role col-md-4 mb-0 {{ $errors->has('role_id') ? ' error' : '' }}">
                                        <label for="role_id">Related Product</label>
                                        <div class="role-select">
                                            <select class="select2 form-control" multiple="multiple" name="other_attributes[related_product_id][]">
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" {{ matchRelatedProduct($product->id, $fixedSectionData['other_attributes']['related_product_id']) ? 'selected' : '' }}>{{$product->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('role_id'))
                                            <div class="help-block">  {{ $errors->first('role_id') }}</div>
                                        @endif
                                    </div>
                                @endif

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


    <!-- # Component modal -->
    @include('admin.app-service.details.components.component_modal.text_with_image_right')
    @include('admin.app-service.details.components.component_modal.text_with_image_bottom')
    @include('admin.app-service.details.components.component_modal.video_with_text_right')
    @include('admin.app-service.details.components.component_modal.pricing_mutiple_table')


    <!-- Modal -->
    <div class="modal fade" id="add_details_with_compoent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add App and Service details with component</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form id="product_details_form" role="form" action="{{ route('app_service.details.store', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">
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
    {{-- <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 15px !important;
            padding-bottom: 15px !important;
        }

        form .select-role.validate input:focus, form .select-role.issue input:focus, form .select-role.validate input{
            border-color: unset;
            -webkit-box-shadow: unset;
            -moz-box-shadow: unset;
            box-shadow: unset;
            border-width: 0;
            color : unset;
        }
    </style>
@endpush

@push('page-js')

<script type="text/javascript">
    
    var auto_save_url = "{{ url('app-service-sections-sortable') }}";

    jQuery(document).ready(function($){
        // Preview changes on component selection
        $('#component_type').on('change', function(){

            var assetUrl = "{{asset('app-assets/images/app_services/')}}"
            $('#component_preview_img').attr('src', assetUrl +'/'+ $(this).val() +'.png' );

            $('#add_component_btn').attr('data-target', '#'+$(this).val());

            // console.log($(this).val());
        });


    }); // Doc ready




    // Edit section components
    $('.section_component_edit').on('click', function(e){
        e.preventDefault();

        var editUrl = $(this).attr('href');

        console.log(editUrl);

        $.ajax({
            url: editUrl,
            cache: false,
            type: "GET",
            success: function (result) {

                // console.log(result);

                if( result.status == 'SUCCESS' ){
                     var $parentSelector = $('#text_with_image_right');
                     var baseUrl = "{{ config('filesystems.file_base_url') }}";

                     $parentSelector.find('#form_save').hide();
                     $parentSelector.find('#form_update').show();


                    $('#text_with_image_right').modal('show');

                    // Set all sections
                    // $.each(result.data.sections, function(k, v){

                    //     if( k == 'status' ){     

                    //        // $parentSelector.find("").val();


                    //         // $('#text_with_image_right').find("input[name='component[title_en]']").val(v);
                    //     }
                        
                    // });

                    // Add section id
                    $('#section_id').val(result.data.sections.id);

                    $("input[name='sections[status]']").each(function(sk, sv){
                       // console.log($(sv).val());
                       if( $(sv).val() == result.data.sections.status ){
                           $(sv).attr('checked', true);
                       }

                    });


                    // Compoent foreach
                    $.each(result.data.component, function(cpk, cpv){

                        $.each(cpv, function(ck, cv){

                           if( ck == 'title_en' ){                            
                             $parentSelector.find("input[name='component["+cpk+"][title_en]']").val(cv);
                           }

                           if( ck == 'title_bn' ){                            
                             $parentSelector.find("input[name='component["+cpk+"][title_bn]']").val(cv);
                           }

                           if( ck == 'alt_text' ){                            
                             $parentSelector.find("input[name='component["+cpk+"][alt_text]']").val(cv);
                           }


                           if( ck == 'image' ){
                             $parentSelector.find('.imgDisplay').attr('src', baseUrl + cv).show();
                           }

                           if( ck == 'id' ){
                              $parentSelector.find("input[name='component["+cpk+"][id]']").val(cv);
                           }

                        });

                    });


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

</script>

@endpush





