@extends('layouts.admin')
@section('title', 'Create Business Service Components')
@section('card_name', 'Add Components')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('business-other-services') }}"> Service List</a></li>
<li class="breadcrumb-item active"> Add Components</li>
@endsection
@section('action')
<a href="{{ url('business-other-services') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
<section>





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
                <input type="text" class="form-control" required name="price_bn[]">

                <label>Price (BN)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="price_bn[]">

            </div>
            <hr>

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



    //add package comparison table two element
    $('.component_wrapper').on('click', '.add_package_two', function () {

        var html = $(".package_comparison_two_single .pk2_new_package").clone();

        var position = $(this).parents('.package_two_wrap').find('.com_pc2_position').val();

        var pc2Title = "com_pk2_title[" + position + "][]";
        $(html).find('.com_pk2_title').attr('name', pc2Title);

        var pc2Name = "com_pk2_name[" + position + "][]";
        $(html).find('.com_pk2_name').attr('name', pc2Name);

        var pc2Data = "com_pk2_data[" + position + "][]";
        $(html).find('.com_pk2_data').attr('name', pc2Data);

        var pc2Days = "com_pk2_days[" + position + "][]";
        $(html).find('.com_pk2_days').attr('name', pc2Days);

        var pc2Price = "com_pk2_price[" + position + "][]";
        $(html).find('.com_pk2_price').attr('name', pc2Price);

        $(this).parents('.package_two_wrap').append(html);
    });

    //remove package comparison table two element
    $('.component_wrapper').on('click', '.remove_package_two', function () {
        $(this).parents('.col-md-6').fadeOut(300, function () {
            $(this).remove();
        });
    });


    //add price table body column
    $('.component_wrapper').on('click', '.add_price_table_clmn', function () {

        var html = $(".package_price_table_single .prict_table_new_columns").clone();

        var position = $(this).parents('.card').find('.com_prict_table_position').val();


        var ptPrice1 = "com_price_column_one[" + position + "][]";
        $(html).find('.com_price_column_one').attr('name', ptPrice1);

        var ptPrice2 = "com_price_column_two[" + position + "][]";
        $(html).find('.com_price_column_two').attr('name', ptPrice2);

        var ptPrice3 = "com_price_column_three[" + position + "][]";
        $(html).find('.com_price_column_three').attr('name', ptPrice3);

        $(this).parents('.form-group').find('.price_table_data_wrap').append(html);
    });

    //remove package comparison table two element
    $('.component_wrapper').on('click', '.remove_price_table_clmn', function () {
        $(this).parents('.prict_table_new_columns').fadeOut(300, function () {
            $(this).remove();
        });
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
//    //text editor for package details
//    $("textarea.textarea_details").summernote({
//        toolbar: [
//            ['style', ['bold', 'italic', 'underline', 'clear']],
//            ['font', ['strikethrough', 'superscript', 'subscript']],
//            ['fontsize', ['fontsize']],
//            ['color', ['color']],
//            // ['table', ['table']],
//            ['para', ['ul', 'ol', 'paragraph']],
//            ['view', ['codeview']]
//        ],
//        height: 170
//    });

});


</script>
@endpush




