@extends('layouts.admin')
@section('title', 'Create Business Service Components')
@section('card_name', 'Add Components')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('business-others-components-list/'.$serviceId) }}"> Service Details</a></li>
<li class="breadcrumb-item active"> Add Components</li>
@endsection
@section('action')
<a href="{{ url('business-others-components-list/'.$serviceId) }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
<section>
    <div class="row">
        <div class="col-md-12 col-xs-12 text-center">
            <h4>Service: {{ $serviceName}}</h4>
            <hr>
        </div>
        <div class="col-md-3 col-xs-12 pull-right">
            <div class="form-group">
                <select class="form-control component_list" name="type">
                    <option value="">Select Component</option>
                    <option value="photo_text">Photo with Text</option>
                    <option value="package_comparison_one">Package Comparison One</option>
                    <option value="package_comparison_two">Package Comparison Two</option>
                    <option value="product_features">Product Features</option>
                    <option value="package_price_table">Product Price Table</option>
                    <option value="video_component">Video Component</option>
                    <option value="photo_component">Photo Component</option>
                </select>

            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <a href="javascript:;" class="btn btn-info pull-left add_component">
                    Add Component
                </a>
            </div>
        </div>
        
        
    </div>




    <div class="component_wrapper">
        <form method="POST" action="{{ route('business.component.save')}}" class="form home_news_form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="service_id" value="{{$serviceId}}">

            <div class="component_box"></div>

            <div class="form-group submit_btn"></div>
        </form>
    </div>


</section>


<div class="display-hidden">



    @include('admin.business.partials.com_photo_text_add')
    @include('admin.business.partials.com_pk_comparison_one_add')
    @include('admin.business.partials.com_pk_comparison_two_add')
    @include('admin.business.partials.com_feature_add')
    @include('admin.business.partials.com_price_table_add')
    @include('admin.business.partials.com_video_add')
    @include('admin.business.partials.com_photo_add')

</div>


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

    //success and error msg
<?php
if (Session::has('sussess')) {
    ?>
        swal.fire({
            title: "{{ Session::get('sussess') }}",
            type: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    <?php
}
if (Session::has('error')) {
    ?>
        swal.fire({
            title: "{{ Session::get('error') }}",
            type: 'error',
            timer: 2000,
            showConfirmButton: false
        });

<?php } ?>

    var position = 1;
    //append components
    $('.add_component').on('click', function () {
        var component = $(".component_list").val();
        var htmlClass = "." + component + " .card";
        var html = $(htmlClass).clone();


        //photo text component positon
        if (component == 'photo_text') {
            var photoName = "com_pt_photo[" + position + "]";
            $(html).find('.com_pt_photo').attr('name', photoName);

            var altText = "com_pt_alt_text[" + position + "]";
            $(html).find('.com_pt_alt_text').attr('name', altText);

            var textNameEn = "com_pt_text_en[" + position + "]";
            $(html).find('.com_pt_text_en').attr('name', textNameEn);

            var textNameBn = "com_pt_text_bn[" + position + "]";
            $(html).find('.com_pt_text_bn').attr('name', textNameBn);
        }

        //package comrarison one position
        if (component == 'package_comparison_one') {
            var pc1Position = "com_pc1_position[" + position + "]";
            $(html).find('.com_pc1_position').attr('name', pc1Position).val(position);

            var pc1TableHeadEn = "com_pc1_table_head_en[" + position + "][]";
            $(html).find('.com_pc1_table_head_en').attr('name', pc1TableHeadEn);

            var pc1TableHeadBn = "com_pc1_table_head_bn[" + position + "][]";
            $(html).find('.com_pc1_table_head_bn').attr('name', pc1TableHeadBn);

            var pc1FeatureTextEn = "com_pc1_feature_text_en[" + position + "][]";
            $(html).find('.com_pc1_feature_text_en').attr('name', pc1FeatureTextEn);

            var pc1FeatureTextBn = "com_pc1_feature_text_bn[" + position + "][]";
            $(html).find('.com_pc1_feature_text_bn').attr('name', pc1FeatureTextBn);

            var pc1PriceEn = "com_pc1_price_en[" + position + "][]";
            $(html).find('.com_pc1_price_en').attr('name', pc1PriceEn);

            var pc1PriceBn = "com_pc1_price_bn[" + position + "][]";
            $(html).find('.com_pc1_price_bn').attr('name', pc1PriceBn);
        }

        //package comrarison two position
        if (component == 'package_comparison_two') {
            var pc2Position = "com_pc2_position[" + position + "]";
            $(html).find('.com_pc2_position').attr('name', pc2Position).val(position);

            var pc2TitleEn = "com_pk2_title_en[" + position + "][]";
            $(html).find('.com_pk2_title_en').attr('name', pc2TitleEn);

            var pc2TitleBn = "com_pk2_title_bn[" + position + "][]";
            $(html).find('.com_pk2_title_bn').attr('name', pc2TitleBn);

            var pc2NameEn = "com_pk2_name_en[" + position + "][]";
            $(html).find('.com_pk2_name_en').attr('name', pc2NameEn);

            var pc2NameBn = "com_pk2_name_bn[" + position + "][]";
            $(html).find('.com_pk2_name_bn').attr('name', pc2NameBn);

            var pc2DataEn = "com_pk2_data_en[" + position + "][]";
            $(html).find('.com_pk2_data_en').attr('name', pc2DataEn);

            var pc2DataBn = "com_pk2_data_bn[" + position + "][]";
            $(html).find('.com_pk2_data_bn').attr('name', pc2DataBn);

            var pc2DaysEn = "com_pk2_days_en[" + position + "][]";
            $(html).find('.com_pk2_days_en').attr('name', pc2DaysEn);

            var pc2DaysBn = "com_pk2_days_bn[" + position + "][]";
            $(html).find('.com_pk2_days_bn').attr('name', pc2DaysBn);

            var pc2PriceEn = "com_pk2_price_en[" + position + "][]";
            $(html).find('.com_pk2_price_en').attr('name', pc2PriceEn);

            var pc2PriceBn = "com_pk2_price_bn[" + position + "][]";
            $(html).find('.com_pk2_price_bn').attr('name', pc2PriceBn);

        }
        //component feature position
        if (component == 'product_features') {

            var titleEn = "com_ft_title_en[" + position + "]";
            $(html).find('.com_ft_title_en').attr('name', titleEn);

            var titleBn = "com_ft_title_bn[" + position + "]";
            $(html).find('.com_ft_title_bn').attr('name', titleBn);

            var ftTextEn = "com_ft_text_en[" + position + "]";
            $(html).find('.com_ft_text_en').attr('name', ftTextEn);

            var ftTextBn = "com_ft_text_bn[" + position + "]";
            $(html).find('.com_ft_text_bn').attr('name', ftTextBn);

        }

        //package price table position
        if (component == 'package_price_table') {
            var ptPosition = "com_prict_table_position[" + position + "]";
            $(html).find('.com_prict_table_position').attr('name', ptPosition).val(position);

            var ptTitleEn = "com_price_title_en[" + position + "]";
            $(html).find('.com_price_title_en').attr('name', ptTitleEn);

            var ptTitleBn = "com_price_title_bn[" + position + "]";
            $(html).find('.com_price_title_bn').attr('name', ptTitleBn);

            var ptHeadEn = "com_price_head_en[" + position + "][]";
            $(html).find('.com_price_head_en').attr('name', ptHeadEn);

            var ptHeadBn = "com_price_head_bn[" + position + "][]";
            $(html).find('.com_price_head_bn').attr('name', ptHeadBn);

            var ptPrice1En = "com_price_column_one_en[" + position + "][]";
            $(html).find('.com_price_column_one_en').attr('name', ptPrice1En);

            var ptPrice1Bn = "com_price_column_one_bn[" + position + "][]";
            $(html).find('.com_price_column_one_bn').attr('name', ptPrice1Bn);

            var ptPrice2En = "com_price_column_two_en[" + position + "][]";
            $(html).find('.com_price_column_two_en').attr('name', ptPrice2En);

            var ptPrice2Bn = "com_price_column_two_bn[" + position + "][]";
            $(html).find('.com_price_column_two_bn').attr('name', ptPrice2Bn);

            var ptPrice3En = "com_price_column_three_en[" + position + "][]";
            $(html).find('.com_price_column_three_en').attr('name', ptPrice3En);

            var ptPrice3Bn = "com_price_column_three_bn[" + position + "][]";
            $(html).find('.com_price_column_three_bn').attr('name', ptPrice3Bn);

        }





        //video component position
        if (component == 'video_component') {
            var vidNameEn = "com_vid_name_en[" + position + "]";
            $(html).find('.com_vid_name_en').attr('name', vidNameEn);

            var vidNameBn = "com_vid_name_bn[" + position + "]";
            $(html).find('.com_vid_name_bn').attr('name', vidNameBn);

            var vidEmbed = "com_vid_embed[" + position + "]";
            $(html).find('.com_vid_embed').attr('name', vidEmbed);

            var vidTitleEn = "com_vid_title_en[" + position + "]";
            $(html).find('.com_vid_title_en').attr('name', vidTitleEn);

            var vidTitleBn = "com_vid_title_bn[" + position + "]";
            $(html).find('.com_vid_title_bn').attr('name', vidTitleBn);

            var vidDescriptionEn = "com_vid_description_en[" + position + "]";
            $(html).find('.com_vid_description_en').attr('name', vidDescriptionEn);

            var vidDescriptionBn = "com_vid_description_bn[" + position + "]";
            $(html).find('.com_vid_description_bn').attr('name', vidDescriptionBn);
        }


        //photo component position
        if (component == 'photo_component') {

            var photoOne = "com_photo_one[" + position + "]";
            $(html).find('.com_photo_one').attr('name', photoOne);

            var photoOneAlt = "com_photo_one_alt[" + position + "]";
            $(html).find('.com_photo_one_alt').attr('name', photoOneAlt);

            var photoTwo = "com_photo_two[" + position + "]";
            $(html).find('.com_photo_two').attr('name', photoTwo);

            var photoTwoAlt = "com_photo_two_alt[" + position + "]";
            $(html).find('.com_photo_two_alt').attr('name', photoTwoAlt);

            var photoThree = "com_photo_three[" + position + "]";
            $(html).find('.com_photo_three').attr('name', photoThree);

            var photoThreeAlt = "com_photo_three_alt[" + position + "]";
            $(html).find('.com_photo_three_alt').attr('name', photoThreeAlt);

            var photoFour = "com_photo_four[" + position + "]";
            $(html).find('.com_photo_four').attr('name', photoFour);

            var photoFourAlt = "com_photo_four_alt[" + position + "]";
            $(html).find('.com_photo_four_alt').attr('name', photoFourAlt);


        }


        $('.component_wrapper form .component_box').append(html);




        if (position == 1) {
            var submitBtn = '<button type="submit" class="btn btn-info pull-right">Save</button>';
            $('.component_wrapper form .submit_btn').append(submitBtn);
        }

        position++;

        //show dropify for package photo
        $('.component_wrapper form .dropify_package').dropify({
            messages: {
                'default': 'Browse for banner photo',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct file format'
            }
        });


        //text editor for package details
        $(".component_wrapper form textarea.textarea_details").summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                // ['table', ['table']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['codeview']]
            ],
            height: 170
        });

    });

    //remove component
    $(".component_wrapper").on('click', '.remove_component', function () {
        $(this).parents('.card').fadeOut(300, function () {
            $(this).remove();
        });
    });



    //add package comparison table one element
    $('.component_wrapper').on('click', '.add_package_one', function () {
        var html = $(".package_comparison_one_single .pc1_new_package").clone();

        var position = $(this).parents('.package_one_wrap').find('.com_pc1_position').val();

        var pc1TableHeadEn = "com_pc1_table_head_en[" + position + "][]";
        $(html).find('.com_pc1_table_head_en').attr('name', pc1TableHeadEn);

        var pc1TableHeadBn = "com_pc1_table_head_bn[" + position + "][]";
        $(html).find('.com_pc1_table_head_bn').attr('name', pc1TableHeadBn);

        var pc1FeatureTextEn = "com_pc1_feature_text_en[" + position + "][]";
        $(html).find('.com_pc1_feature_text_en').attr('name', pc1FeatureTextEn);

        var pc1FeatureTextBn = "com_pc1_feature_text_bn[" + position + "][]";
        $(html).find('.com_pc1_feature_text_bn').attr('name', pc1FeatureTextBn);

        var pc1PriceEn = "com_pc1_price_en[" + position + "][]";
        $(html).find('.com_pc1_price_en').attr('name', pc1PriceEn);

        var pc1PriceBn = "com_pc1_price_bn[" + position + "][]";
        $(html).find('.com_pc1_price_bn').attr('name', pc1PriceBn);

        //text editor for package details
        $(html).find("textarea.textarea_details").summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                // ['table', ['table']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['codeview']]
            ],
            height: 170
        });

        $(this).parents('.package_one_wrap').append(html);
    });

    //remove package comparison table one element
    $('.component_wrapper').on('click', '.remove_package_one', function () {
        $(this).parents('.col-md-4').fadeOut(300, function () {
            $(this).remove();
        });
    });

    $(".component_wrapper").on("keypress keyup blur", '.price_input', function (event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

//    $(".component_wrapper").find('.price_input').number( true, 2 );

    //add package comparison table two element
    $('.component_wrapper').on('click', '.add_package_two', function () {

        var html = $(".package_comparison_two_single .pk2_new_package").clone();

        var position = $(this).parents('.package_two_wrap').find('.com_pc2_position').val();

        var pc2TitleEn = "com_pk2_title_en[" + position + "][]";
        $(html).find('.com_pk2_title_en').attr('name', pc2TitleEn);

        var pc2TitleBn = "com_pk2_title_bn[" + position + "][]";
        $(html).find('.com_pk2_title_bn').attr('name', pc2TitleBn);

        var pc2NameEn = "com_pk2_name_en[" + position + "][]";
        $(html).find('.com_pk2_name_en').attr('name', pc2NameEn);

        var pc2NameBn = "com_pk2_name_bn[" + position + "][]";
        $(html).find('.com_pk2_name_bn').attr('name', pc2NameBn);

        var pc2DataEn = "com_pk2_data_en[" + position + "][]";
        $(html).find('.com_pk2_data_en').attr('name', pc2DataEn);

        var pc2DataBn = "com_pk2_data_bn[" + position + "][]";
        $(html).find('.com_pk2_data_bn').attr('name', pc2DataBn);

        var pc2DaysEn = "com_pk2_days_en[" + position + "][]";
        $(html).find('.com_pk2_days_en').attr('name', pc2DaysEn);

        var pc2DaysBn = "com_pk2_days_bn[" + position + "][]";
        $(html).find('.com_pk2_days_bn').attr('name', pc2DaysBn);

        var pc2PriceEn = "com_pk2_price_en[" + position + "][]";
        $(html).find('.com_pk2_price_en').attr('name', pc2PriceEn);

        var pc2PriceBn = "com_pk2_price_bn[" + position + "][]";
        $(html).find('.com_pk2_price_bn').attr('name', pc2PriceBn);

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

        var totalRow = $('.total_row').val();

        var htmlEn = $(".package_price_table_single .prict_table_new_columns_en").clone();

        var position = $(this).parents('.card').find('.com_prict_table_position').val();

        var ptPrice1En = "com_price_column_one_en[" + position + "][]";
        $(htmlEn).find('.com_price_column_one_en').attr('name', ptPrice1En);

        var ptPrice2En = "com_price_column_two_en[" + position + "][]";
        $(htmlEn).find('.com_price_column_two_en').attr('name', ptPrice2En);

        var ptPrice3En = "com_price_column_three_en[" + position + "][]";
        $(htmlEn).find('.com_price_column_three_en').attr('name', ptPrice3En);


        $(htmlEn).find('.column_body_wrap').addClass('column_body_wrap_' + totalRow);
        $(this).parents('.card').find('.price_table_wrap_en').append(htmlEn);



        var htmlBn = $(".package_price_table_single .prict_table_new_columns_bn").clone();
        var ptPrice1Bn = "com_price_column_one_bn[" + position + "][]";
        $(htmlBn).find('.com_price_column_one_bn').attr('name', ptPrice1Bn);

        var ptPrice2Bn = "com_price_column_two_bn[" + position + "][]";
        $(htmlBn).find('.com_price_column_two_bn').attr('name', ptPrice2Bn);

        var ptPrice3Bn = "com_price_column_three_bn[" + position + "][]";
        $(htmlBn).find('.com_price_column_three_bn').attr('name', ptPrice3Bn);



        $(htmlBn).find('.column_body_wrap').addClass('column_body_wrap_' + totalRow);
        $(htmlBn).find('.remove_price_table_clmn').attr('column', totalRow);
        $(this).parents('.card').find('.price_table_wrap_bn').append(htmlBn);

        var newTotalRow = parseInt(totalRow) + 1;
        $('.total_row').val(newTotalRow);
    });


    //remove package comparison table two element
//    $('.component_wrapper').on('click', '.remove_price_table_clmn', function () {
//        $(this).parents('.prict_table_new_columns').fadeOut(300, function () {
//            $(this).remove();
//        });
//    });
    
     //remove package comparison table two element
        $('.component_wrapper').on('click', '.remove_price_table_clmn', function () {
            var sl = $(this).attr('column');
            var selector = ".column_body_wrap_" + sl;
            $(this).parents('.price_table_data_wrap').find(selector).parent('.prict_table_new_columns_en').remove();
            $(this).parents('.price_table_data_wrap').find(selector).parent('.prict_table_new_columns_bn').remove();
            $(this).parents('.price_table_data_wrap').find(selector).remove();
            $(this).closest('br').remove();
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




