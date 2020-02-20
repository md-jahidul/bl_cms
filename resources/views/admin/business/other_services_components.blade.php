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
    <div class="row">
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

    <div class="photo_text">

        <div class="card" data-index="0" data-position="0">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

                    <div class="row">

                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label for="Banner Photo">Photo <span class="text-danger">*</span></label>
                                <input type="file" class="dropify_package com_pt_photo" required name="" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                            </div>

                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="Package Name"> Text <span class="text-danger">*</span></label>
                                <textarea type="text" name="" class="form-control com_pt_text"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Sample </label>
                                <img src="{{asset('app-assets/images/business/photo_text_demo.png')}}" width="100%">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="package_comparison_one">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

                    <div class="row">
                        <div class="col-md-10 col-xs-12">
                            <div class="row package_one_wrap">
                                <div class="col-md-4 col-xs-12">

                                    <input type="hidden" class="com_pc1_position">

                                    <div class="form-group">
                                        <label class="display-block">Package Name <span class="text-danger">*</span> 

                                            <a href="javascript:;" class="add_package_one pull-right">
                                                <i class="la la-plus-square"></i>
                                            </a>
                                        </label>
                                        <input type="text" class="form-control com_pc1_table_head" name="">
                                    </div>

                                    <div class="form-group">
                                        <label>Feature Text <span class="text-danger">*</span></label>
                                        <textarea type="text" name="" class="form-control com_pc1_feature_text textarea_details"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Price <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control com_pc1_price" name="">
                                    </div>

                                </div>

                                <div class="col-md-4 col-xs-12">

                                    <div class="form-group">
                                        <label class="display-block">Package Name <span class="text-danger">*</span> 

                                            <a href="javascript:;" class="remove_package_one pull-right text-danger">
                                                <i class="la la-minus-square"></i>
                                            </a>
                                            <a href="javascript:;" class="add_package_one pull-right">
                                                <i class="la la-plus-square"></i>
                                            </a>

                                        </label>
                                        <input type="text" class="form-control com_pc1_table_head" name="">
                                    </div>

                                    <div class="form-group">
                                        <label>Feature Text <span class="text-danger">*</span></label>
                                        <textarea type="text" name="" class="form-control com_pc1_feature_text textarea_details"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Price <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control com_pc1_price" name="">
                                    </div>

                                </div>

                                <div class="col-md-4 col-xs-12">

                                    <div class="form-group">
                                        <label class="display-block">Package Name <span class="text-danger">*</span> 

                                            <a href="javascript:;" class="remove_package_one pull-right text-danger">
                                                <i class="la la-minus-square"></i>
                                            </a>
                                            <a href="javascript:;" class="add_package_one pull-right">
                                                <i class="la la-plus-square"></i>
                                            </a>

                                        </label>
                                        <input type="text" class="form-control com_pc1_table_head" name="">
                                    </div>

                                    <div class="form-group">
                                        <label>Feature Text <span class="text-danger">*</span></label>
                                        <textarea type="text" name="" class="form-control com_pc1_feature_text textarea_details"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Price <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control com_pc1_price" name="">
                                    </div>

                                </div>


                            </div>
                        </div>

                        <div class="col-md-2 col-xs-12 pull-right">
                            <div class="form-group">
                                <label>Sample </label>
                                <img src="{{asset('app-assets/images/business/package_one_demo.png')}}" width="100%">
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="package_comparison_two">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

                    <div class="row">
                        <div class="col-md-9 col-xs-12">

                            <div class="row package_two_wrap">
                                <input type="hidden" class="com_pc2_position">


                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="display-block">Title <span class="text-danger">*</span>

                                            <a href="javascript:;" class="add_package_two pull-right">
                                                <i class="la la-plus-square"></i>
                                            </a>
                                        </label>
                                        <input type="text" class="form-control com_pk2_title" name="">
                                    </div>
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control com_pk2_name" name="">
                                    </div>
                                    <div class="form-group">
                                        <label>Data Limit <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control com_pk2_data" name="">
                                    </div>

                                    <div class="form-group">
                                        <label>Package Days <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control com_pk2_days" name="">
                                    </div>
                                    <div class="form-group">
                                        <label>Package Price <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control com_pk2_price" name="">
                                    </div>
                                    <hr>
                                </div>


                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="display-block">Title <span class="text-danger">*</span>

                                            <a href="javascript:;" class="remove_package_two pull-right text-danger">
                                                <i class="la la-minus-square"></i>
                                            </a>
                                            <a href="javascript:;" class="add_package_two pull-right">
                                                <i class="la la-plus-square"></i>
                                            </a>

                                        </label>
                                        <input type="text" class="form-control com_pk2_title" name="">
                                    </div>
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control com_pk2_name" name="">
                                    </div>
                                    <div class="form-group">
                                        <label>Data Limit <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control com_pk2_data" name="">
                                    </div>

                                    <div class="form-group">
                                        <label>Package Days <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control com_pk2_days" name="">
                                    </div>
                                    <div class="form-group">
                                        <label>Package Price <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control com_pk2_price" name="">
                                    </div>
                                    <hr>
                                </div>




                            </div>


                        </div>


                        <div class="col-md-3 col-xs-12">
                            <div class="form-group">
                                <label>Sample </label>
                                <img src="{{asset('app-assets/images/business/package_two_demo.png')}}" width="100%">
                            </div>

                           

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="product_features">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

                    <div class="row">

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for=""> Features <span class="text-danger">*</span></label>
                                <textarea type="text" name="" class="form-control com_ft_text textarea_details"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Sample </label>
                                <img src="{{asset('app-assets/images/business/product_features_demo.png')}}" width="100%">
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="package_price_table">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

                    <div class="row">

                        <div class="col-md-8 col-xs-12">
                            <div class="form-group">
                                <label class="display-block">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control com_price_title" name="">
                            </div>
                            <div class="form-group">
                                <label class="display-block">Table Head <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Head One" class="form-control col-md-4 pull-left com_price_head" name="">
                                <input type="text" placeholder="Head Two" class="form-control col-md-4 pull-left com_price_head" name="">
                                <input type="text" placeholder="Head Three" class="form-control col-md-4 pull-left com_price_head" name="">
                                <br>
                                <br>
                                <hr>
                            </div>



                            <div class="form-group">
                                <label class="display-block">Table Data <span class="text-danger">*</span>
                                    <a href="javascript:;" class="add_price_table_clmn btn btn-sm btn-info">
                                        + Add Row
                                    </a>
                                </label>

                                <div class="price_table_data_wrap">

                                    <input type="hidden" class="com_prict_table_position">

                                    <div class="col-md-11 pull-left">
                                        <input type="text" placeholder="Column One" class="form-control col-md-4 pull-left com_price_column_one" name="">
                                        <input type="text" placeholder="Column Two" class="form-control col-md-4 pull-left com_price_column_two" name="">
                                        <input type="text" placeholder="Column Three" class="form-control col-md-4 pull-left com_price_column_three" name="">
                                    </div>
                                    <div class="col-md-1 pull-left">
                                    </div>

                                </div>



                            </div>



                        </div>

                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Sample </label>
                                <img src="{{asset('app-assets/images/business/price_table_demo.png')}}" width="100%">
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="video_component">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

                    <div class="row">

                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control com_vid_name" name="">
                            </div>

                            <div class="form-group">
                                <label for=""> Embed HTML <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control com_vid_embed" name=""></textarea>
                            </div>

                        </div>

                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control com_vid_title" name="">
                            </div>

                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea class="form-control com_vid_description" name=""></textarea>
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Sample </label>
                                <img src="{{asset('app-assets/images/business/video_tutorial_demo.png')}}" width="100%">
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="photo_component">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

                    <div class="row">

                        <div class="col-md-3 col-xs-12">
                            <div class="form-group">
                                <label for="Banner Photo">Photo One <span class="text-danger">*</span></label>
                                <input type="file" required class="dropify_package com_photo_one" name="" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                            </div>
                            <div class="form-group">
                                <label for="Banner Photo">Photo Three <span class="text-danger">*</span></label>
                                <input type="file" required class="dropify_package com_photo_three" name="" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                            </div>

                        </div>
                        <div class="col-md-3 col-xs-12">

                            <div class="form-group">
                                <label for="Banner Photo">Photo Two <span class="text-danger">*</span></label>
                                <input type="file" required class="dropify_package com_photo_two" name="" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                            </div>

                            <div class="form-group">
                                <label for="Banner Photo">Photo Four <span class="text-danger">*</span></label>
                                <input type="file" required class="dropify_package com_photo_four" name="" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                            </div>

                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label>Sample </label>
                                <img src="{{asset('app-assets/images/business/photo_com_demo.png')}}" width="100%">
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="display-hidden package_comparison_one_single">
        <div class="col-md-4 col-xs-12 pc1_new_package">

            <div class="form-group">
                <label class="display-block">Package Name <span class="text-danger">*</span> 

                    <a href="javascript:;" class="remove_package_one pull-right text-danger">
                        <i class="la la-minus-square"></i>
                    </a>
                    <a href="javascript:;" class="add_package_one pull-right">
                        <i class="la la-plus-square"></i>
                    </a>

                </label>
                <input type="text" class="form-control com_pc1_table_head" name="">
            </div>

            <div class="form-group">
                <label>Feature Text <span class="text-danger">*</span></label>
                <textarea type="text" name="" class="form-control com_pc1_feature_text textarea_details"></textarea>
            </div>
            <div class="form-group">
                <label>Price <span class="text-danger">*</span></label>
                <input type="text" class="form-control com_pc1_price" name="">
            </div>

        </div>
    </div>


    <div class="display-hidden package_comparison_two_single">

        <div class="col-md-6 col-xs-12 pk2_new_package">
            <div class="form-group">
                <label class="display-block">Title <span class="text-danger">*</span>

                    <a href="javascript:;" class="remove_package_two pull-right text-danger">
                        <i class="la la-minus-square"></i>
                    </a>
                    <a href="javascript:;" class="add_package_two pull-right">
                        <i class="la la-plus-square"></i>
                    </a>

                </label>
                <input type="text" class="form-control com_pk2_title" name="">
            </div>
            <div class="form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control com_pk2_name" name="">
            </div>
            <div class="form-group">
                <label>Data Limit <span class="text-danger">*</span></label>
                <input type="text" class="form-control com_pk2_data" name="">
            </div>

            <div class="form-group">
                <label>Package Days <span class="text-danger">*</span></label>
                <input type="text" class="form-control com_pk2_days" name="">
            </div>
            <div class="form-group">
                <label>Package Price <span class="text-danger">*</span></label>
                <input type="text" class="form-control com_pk2_price" name="">
            </div>
            <hr>
        </div>
    </div>


    <div class="display-hidden package_price_table_single">
        <div class="prict_table_new_columns">
            <div class="col-md-11 pull-left">
                <input type="text" placeholder="Column One" class="form-control col-md-4 pull-left com_price_column_one" name="">
                <input type="text" placeholder="Column Two" class="form-control col-md-4 pull-left com_price_column_two" name="">
                <input type="text" placeholder="Column Three" class="form-control col-md-4 pull-left com_price_column_three" name="">
            </div>
            <div class="col-md-1 pull-left prict_table_new_remove">
                <a href="javascript:;" class="remove_price_table_clmn pull-right text-danger">
                    <i class="la la-minus-square"></i>
                </a>
            </div>
        </div>


    </div>










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

            var textName = "com_pt_text[" + position + "]";
            $(html).find('.com_pt_text').attr('name', textName);
        }

        //package comrarison one position
        if (component == 'package_comparison_one') {
            var pc1Position = "com_pc1_position[" + position + "]";
            $(html).find('.com_pc1_position').attr('name', pc1Position).val(position);

            var pc1TableHead = "com_pc1_table_head[" + position + "][]";
            $(html).find('.com_pc1_table_head').attr('name', pc1TableHead);

            var pc1FeatureText = "com_pc1_feature_text[" + position + "][]";
            $(html).find('.com_pc1_feature_text').attr('name', pc1FeatureText);

            var pc1Price = "com_pc1_price[" + position + "][]";
            $(html).find('.com_pc1_price').attr('name', pc1Price);
        }

        //package comrarison two position
        if (component == 'package_comparison_two') {
            var pc2Position = "com_pc2_position[" + position + "]";
            $(html).find('.com_pc2_position').attr('name', pc2Position).val(position);

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

        }
        //component feature position
        if (component == 'product_features') {

            var ftText = "com_ft_text[" + position + "]";
            $(html).find('.com_ft_text').attr('name', ftText);

        }

        //package price table position
        if (component == 'package_price_table') {
            var ptPosition = "com_prict_table_position[" + position + "]";
            $(html).find('.com_prict_table_position').attr('name', ptPosition).val(position);

            var ptTitle = "com_price_title[" + position + "]";
            $(html).find('.com_price_title').attr('name', ptTitle);
            
            var ptHead = "com_price_head[" + position + "][]";
            $(html).find('.com_price_head').attr('name', ptHead);

            var ptPrice1 = "com_price_column_one[" + position + "][]";
            $(html).find('.com_price_column_one').attr('name', ptPrice1);

            var ptPrice2 = "com_price_column_two[" + position + "][]";
            $(html).find('.com_price_column_two').attr('name', ptPrice2);

            var ptPrice3 = "com_price_column_three[" + position + "][]";
            $(html).find('.com_price_column_three').attr('name', ptPrice3);

        }
        
        
        


        //video component position
        if (component == 'video_component') {
            var vidName = "com_vid_name[" + position + "]";
            $(html).find('.com_vid_name').attr('name', vidName);

            var vidEmbed = "com_vid_embed[" + position + "]";
            $(html).find('.com_vid_embed').attr('name', vidEmbed);
            
            var vidTitle = "com_vid_title[" + position + "]";
            $(html).find('.com_vid_title').attr('name', vidTitle);
            
            var vidDescription = "com_vid_description[" + position + "]";
            $(html).find('.com_vid_description').attr('name', vidDescription);
        }
        

        //photo component position
        if (component == 'photo_component') {
            var photoOne = "com_photo_one[" + position + "]";
            $(html).find('.com_photo_one').attr('name', photoOne);
            
            var photoTwo = "com_photo_two[" + position + "]";
            $(html).find('.com_photo_two').attr('name', photoTwo);
            
            var photoThree = "com_photo_three[" + position + "]";
            $(html).find('.com_photo_three').attr('name', photoThree);
            
            var photoFour = "com_photo_four[" + position + "]";
            $(html).find('.com_photo_four').attr('name', photoFour);

          
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

        var pc1TableHead = "com_pc1_table_head[" + position + "][]";
        $(html).find('.com_pc1_table_head').attr('name', pc1TableHead);

        var pc1FeatureText = "com_pc1_feature_text[" + position + "][]";
        $(html).find('.com_pc1_feature_text').attr('name', pc1FeatureText);

        var pc1Price = "com_pc1_price[" + position + "][]";
        $(html).find('.com_pc1_price').attr('name', pc1Price);

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




