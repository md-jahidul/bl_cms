@extends('layouts.admin')
@section('title', 'Create Business Service Components')
@section('card_name', 'Edit Components')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('business-others-components-list/'.$serviceId) }}"> Component List</a></li>
<li class="breadcrumb-item active"> Edit Components</li>
@endsection
@section('action')
<a href="{{ url('business-others-components-list/'.$serviceId) }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
<section>

    <div class="col-md-12 col-xs-12 text-center">
        <h4>Service: {{ $serviceName}}</h4>
        <hr>
    </div>



    <div class="component_wrapper">
        <form method="POST" action="{{ route('business.component.update')}}" class="form home_news_form" enctype="multipart/form-data">


            @csrf

            <input type="hidden" name="service_id" value="{{$serviceId}}">

            @if($type == "Photo with Text")

            @include('admin.business.partials.com_photo_text_edit')

            @endif

            @if($type == "Package Comparison One")

            @include('admin.business.partials.com_pk_comparison_one_edit')

            @endif

            @if($type == "Package Comparison Two")

            @include('admin.business.partials.com_pk_comparison_two_edit')

            @endif

            @if($type == "Product Features")

            @include('admin.business.partials.com_feature_edit')

            @endif

            @if($type == "Product Price Table")

            @include('admin.business.partials.com_price_table_edit')

            @endif

            @if($type == "Video Component")

            @include('admin.business.partials.com_video_edit')

            @endif

            @if($type == "Photo Component")

            @include('admin.business.partials.com_photo_edit')

            @endif

            <div class="form-group submit_btn"><button type="submit" class="btn btn-info pull-right">Update</button></div>

        </form>
    </div>


    <div class="display-hidden package_comparison_one_single">
        <div class="col-md-4 col-xs-12 pc1_new_package">
            <div class="container-fluid  bg-light p-2 mr-1 mt-1">
                <input type="hidden" name="com_id[]" value="">
                <div class="form-group">

                    <label class="display-block">Package Name (EN) <span class="text-danger">*</span> 

                        <a href="javascript:;" class="remove_package_one pull-right text-danger">
                            <i class="la la-minus-square"></i>
                        </a>

                        <a href="javascript:;" class="add_package_one pull-right">
                            <i class="la la-plus-square"></i>
                        </a>
                    </label>
                    <input type="text" class="form-control" required name="table_head_en[]">

                    <label class="display-block">Package Name (BN) <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" required name="table_head_bn[]">

                </div>

                <div class="form-group">

                    <label>Feature Text (EN)<span class="text-danger">*</span></label>
                    <textarea type="text" name="feature_text_en[]" required class="form-control textarea_details_new"></textarea>

                    <label>Feature Text (BN)<span class="text-danger">*</span></label>
                    <textarea type="text" name="feature_text_bn[]" required class="form-control textarea_details_new"></textarea>

                </div>

                <div class="form-group">

                    <label>Price (EN)<span class="text-danger">*</span></label>
                    <input type="text" class="form-control price_input" required name="price_en[]">

                </div>
            </div>


        </div>
    </div>



    <div class="display-hidden package_comparison_two_single">

        <div class="col-md-6 col-xs-12 pk2_new_package">
            <div class="container-fluid  bg-light p-2 mr-1 mt-1">

                <div class="form-group row">
                    <input type="hidden" name="com_id[]" value="">

                    <div class="col-md-6 col-xs-12">
                        <label>Title (EN) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="title_en[]">
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <label class="display-block">Title (BN) <span class="text-danger">*</span>
                            <a href="javascript:;" class="remove_package_two pull-right text-danger">
                                <i class="la la-minus-square"></i>
                            </a>
                            <a href="javascript:;" class="add_package_two pull-right">
                                <i class="la la-plus-square"></i>
                            </a>
                        </label>
                        <input type="text" class="form-control" required name="title_bn[]">
                    </div>

                </div>


                <div class="form-group row">

                    <div class="col-md-6 col-xs-12">
                        <label>Name (EN) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="package_name_en[]">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label>Name (BN) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="package_name_bn[]">
                    </div>


                </div>

                <div class="form-group row">

                    <div class="col-md-6 col-xs-12">
                        <label>Data Limit (EN) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="data_limit_en[]">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label>Data Limit (BN) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="data_limit_bn[]">
                    </div>

                </div>


                <div class="form-group row">
                    <div class="col-md-6 col-xs-12">
                        <label>Package Days (EN) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="package_days_en[]">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label>Package Days (BN) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="package_days_bn[]">
                    </div>

                </div>


                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label>Package Price (EN) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control price_input" required name="price_en[]">
                    </div>



                </div>
            </div>

        </div>
    </div>


    <div class="display-hidden package_price_table_single">

        <div class="prict_table_new_columns_en">
            <div class="row column_body_wrap">
                <input type="text" required class="form-control col-md-4 pull-left" name="column_one_en[]">
                <input type="text" required class="form-control col-md-4 pull-left" name="column_two_en[]">
                <input type="text" required class="form-control col-md-3 pull-left" name="column_three_en[]">
            </div>

            <div class="clearfix"></div>
            <br>
        </div>

        <div class="prict_table_new_columns_bn">
            <div class="row column_body_wrap">
                <input type="text" required class="form-control col-md-4 pull-left" name="column_one_bn[]">
                <input type="text" required class="form-control col-md-4 pull-left" name="column_two_bn[]">
                <input type="text" required class="form-control col-md-3 pull-left" name="column_three_bn[]">

                <a href="javascript:;" class="remove_price_table_clmn text-center text-danger">
                    <i class="la la-minus-square"></i>
                </a>
            </div>

            <div class="clearfix"></div>
            <br>
        </div>


    </div>


</section>




@stop

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
<link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">

@endpush
@push('page-js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

<script>
$(function () {


    //show dropify for photo
    $('.dropify').dropify({
        messages: {
            'default': 'Browse for photo',
            'replace': 'Click to replace',
            'remove': 'Remove',
            'error': 'Choose correct file format'
        }
    });

    $(".card").on("keypress keyup blur", '.price_input', function (event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });





//
//    //show dropify for package photo
//    $('.dropify_package').dropify({
//        messages: {
//            'default': 'Browse for banner photo',
//            'replace': 'Click to replace',
//            'remove': 'Remove',
//            'error': 'Choose correct file format'
//        }
//    });
//
//


});


</script>
@endpush




