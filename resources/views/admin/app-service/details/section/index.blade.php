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
                                <th class="text-center" width="8%">Components</th>
                                <th width="12%" class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
{{--                            @if( !empty($section_list) )--}}
                                @foreach($section_list['section_body'] as $list)

                                        @php $path = 'partner-offers-home'; @endphp
                                        {{-- <tr data-index="{{ $product->id }}" data-position="{{ $product->display_order }}"> --}}
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $list->section_name }} {!! $list->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                            <td>{{ $list->tab_type }}</td>
                                            <td class="text-center">
                                                 <a href="{{ route( "appservice.component.list", [$tab_type, $product_id, $list->id] ) }}" class="btn-sm btn-outline-warning border">component</a>
                                            </td>

                                            <td>
                                                <a href="{{ route("app_service.details.edit", [$tab_type, $product_id, $list->id]) }}" role="button" class="btn-sm btn-outline-info border-0">
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
{{--    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">--}}
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
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
    jQuery(document).ready(function($){
        $('input.section_name').on('keyup', function(){
            var sectionName = $('#product_details_form').find('.section_name').val();
            var sectionNameLower = sectionName.toLowerCase();
            var sectionNameRemoveSpace = sectionNameLower.replace(/\s+/g, '-');
            $('#product_details_form').find('.auto_slug').empty().val(sectionNameRemoveSpace);
            // console.log(sectionName);
        });
    });
</script>

@endpush





