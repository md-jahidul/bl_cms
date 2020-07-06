@extends('layouts.admin')
@section('title', 'Edit Business Internet Packages')
@section('card_name', 'Edit Internet Packages')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('business-internet') }}"> Internet Package</a></li>
<li class="breadcrumb-item active"> Edit</li>
@endsection
@section('action')
<a href="{{ url('business-internet') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
<section>
    <form method="POST" action="{{ url('business-internet-update')}}" class="form home_news_form" enctype="multipart/form-data">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">

                    <div class="row">
                        @csrf

                        <div class="col-md-4 col-xs-12">

                            <input type="hidden" value="{{$internet->id}}" name="internet_id">

                            <div class="form-group">
                                <label>Type<span class="text-danger">*</span></label>
                                <div class="form-check">

                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="type" value="Prepaid" @if($internet->type == 'Prepaid')  checked @endif>
                                               Prepaid
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="type" value="Postpaid" @if($internet->type == 'Postpaid')  checked @endif>
                                               Postpaid
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" class="form-control" value="{{$internet->product_code}}" name="product_code" placeholder="Product Code">

                            </div>

                            <div class="form-group">
                                <label>Code EV</label>
                                <input type="text" class="form-control" value="{{$internet->product_code_ev}}"  name="product_code_ev" placeholder="Product Code EV">
                            </div>

                            <div class="form-group">
                                <label>Code With Renew</label>
                                <input type="text" class="form-control" value="{{$internet->product_code_with_renew}}"  name="product_code_with_renew" placeholder="Product Code With Renew">
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" value="{{$internet->product_name}}" name="product_name" placeholder="Product Name">
                            </div>

                            <div class="form-group">
                                <label>Commercial Name (EN)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$internet->product_commercial_name_en}}" required name="product_commercial_name_en" placeholder="Product Commercial Name (EN)">
                            </div>

                            <div class="form-group">
                                <label>Commercial Name (BN)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$internet->product_commercial_name_bn}}" required name="product_commercial_name_bn" placeholder="Commercial Name (BN)">
                            </div>

                            <div class="form-group">
                                <label>Short Description<span class="text-danger">*</span></label>
                                <textarea class="form-control" required name="product_short_description">{{$internet->product_short_description}}</textarea>
                            </div>






                        </div>

                        <div class="col-md-4 col-xs-12">



                            <div class="form-group">
                                <label>Activation USSD Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$internet->activation_ussd_code}}" required name="activation_ussd_code" placeholder="Activation USSD Code">
                            </div>

                            <div class="form-group">
                                <label>Balance Check USSD Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$internet->balance_check_ussd_code}}" required name="balance_check_ussd_code" placeholder="Balance Check USSD Code">
                            </div>

                            <div class="form-group">
                                <label>Data Volume<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$internet->data_volume}}" required name="data_volume" placeholder="Data Volume">
                            </div>

                            <div class="form-group">
                                <label>Volume Data Unit<span class="text-danger">*</span></label>
                                <div class="form-check">

                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="volume_data_unit" value="GB" @if($internet->volume_data_unit == 'GB')  checked @endif>
                                               GB
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="volume_data_unit" value="MB" @if($internet->volume_data_unit == 'MB')  checked @endif>
                                               MB
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Validity<span class="text-danger">*</span></label>
                                <input type="text" class="form-control validity" value="{{$internet->validity}}" required name="validity" placeholder="Validity">
                            </div>

                            <div class="form-group">
                                <label>Validity Unit<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$internet->validity_unit}}" required name="validity_unit" placeholder="Validity Unit">
                            </div>

                            <div class="form-group">
                                <label>Offer Type</label>
                                <input type="text" class="form-control" value="{{$internet->offer_type}}" name="offer_type" value="internet" placeholder="Offer Type">
                            </div>




                        </div>


                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label>MRP<span class="text-danger">*</span></label>
                                <input type="text" class="form-control mrp" value="{{$internet->mrp}}" required name="mrp" placeholder="MRP">
                            </div>

                            <div class="form-group">
                                <label>Price<span class="text-danger">*</span></label>
                                <input type="text" class="form-control price" value="{{$internet->price}}" required name="price" placeholder="Price">
                            </div>

                            <div class="form-group">
                                <label>Tax</label>
                                <input type="text" class="form-control tax"  value="{{$internet->Tax}}" name="Tax" placeholder="Tax">
                            </div>

                            <div class="form-group">
                                <label>Rate Cutter Offer Rate</label>
                                <input type="text" class="form-control" value="{{$internet->rate_cutter_offer_rate}}" name="rate_cutter_offer_rate" placeholder="Rate Cutter Offer Rate">
                            </div>

                            <div class="form-group">
                                <label>Rate Cutter Offer Unit</label>
                                <input type="text" class="form-control" value="{{$internet->rate_cutter_offer_unit}}" name="rate_cutter_offer_unit" placeholder="Rate Cutter Offer Unit">
                            </div>

                            <div class="form-group">
                                <label>Short Text</label>
                                <input type="text" class="form-control" value="{{$internet->short_text}}" name="short_text" placeholder="Short Text">
                            </div>
                            <div class="form-group">
                                <label>Tag</label>
                                <select class="form-control" name="tag">
                                    <option value="">Select Tag</option>
                                    @foreach($tags as $t)
                                    <option @if($internet->tag_id == $t->id) selected @endif value="{{$t->id}}">{{$t->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label><input type="checkbox" @if($internet->is_amar_offer == 1) checked @endif value="1" name="is_amar_offer"> Is Amar Offer?</label>

                            </div>
                        </div>



                    </div>




                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">

                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">

                                <label for="Details">Package Details (EN)</label>
                                <textarea type="text" name="package_details_en" class="form-control summernote_editor">{{$internet->package_details_en}}</textarea>


                            </div>


                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">

                                <label for="Details">Package Details (BN)</label>
                                <textarea type="text" name="package_details_bn" class="form-control summernote_editor">{{$internet->package_details_bn}}</textarea>

                            </div>

                        </div>

                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label for="role_id">Related Product</label>
                                <div class="role-select">
                                    <select class="select2 form-control" multiple="multiple" name="related_product_id[]">
                                        @foreach($otherPorducts as $product)

                                        <?php
                                        $selected = "";
                                        $relatedProducts = explode(',', $internet->related_product);
                                        if (in_array($product->id, $relatedProducts)) {
                                            $selected = "selected";
                                        }
                                        ?>

                                        <option value="{{ $product->id }}" {{$selected}}>{{$product->product_name . ' (' . $product->product_code}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4 col-xs-12">

                           <div class="form-group text-center">
                                <label>Banner Photo (Web)</label>
                                <input type="file" class="dropify" name="banner_photo" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                <input type="hidden" name="old_banner" value="{{$internet->banner_photo}}">

                                @if($internet->banner_photo != "")
                                <img src="{{ config('filesystems.file_base_url') . $internet->banner_photo }}" alt="Banner Photo" width="100%" />
                                @endif
                            </div>

                        </div>

                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label>Banner Photo (Mobile)</label>
                                <input type="file" class="dropify" name="banner_mobile" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                <input type="hidden" name="old_banner_mob" value="{{$internet->banner_image_mobile}}">

                                @if($internet->banner_image_mobile != "")
                                <img src="{{ config('filesystems.file_base_url') . $internet->banner_image_mobile }}" alt="Banner Photo" width="100%" />
                                @endif
                            </div>

                        </div>

                        <div class="col-md-4 col-xs-12">

                           <div class="form-group">
                                <label>Alt Text</label>
                                <input type="text" class="form-control" value="{{$internet->alt_text}}" name="alt_text" placeholder="Banner Alt Text">
                            </div>

                        </div>
                        <div class="col-md-4 col-xs-12">

                            <label>Banner Photo Name<span class="text-danger">*</span></label>
                            <input type="hidden" name="old_banner_name" value="{{$internet->banner_name}}">

                            <input type="text" class="form-control banner_name" value="{{$internet->banner_name}}" required name="banner_name" placeholder="Photo Name">

                            <small class="text-info">
                                <strong>i.e:</strong> package-banner (no spaces)<br>
                            </small>

                        </div>


                         <div class="col-md-4 col-xs-12">

                            <div class="form-group">

                                <label>URL Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="url_slug" value="{{$internet->url_slug}}" placeholder="URL">
                                <small class="text-info">
                                    <strong>i.e:</strong> 5gb-hot-offer (no spaces)<br>
                                </small>

                            </div>

                        </div>

                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">

                                <label>Page Header (HTML) GGGG</label>
                                <textarea class="form-control" rows="7" name="page_header">{{$internet->page_header}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>

                            </div>

                        </div>

                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">

                                <label>Schema Markup</label>
                                <textarea class="form-control schema_markup" rows="7" name="schema_markup">{{$internet->schema_markup}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>

                            </div>

                        </div>

                        <div class="col-md-12 col-xs-12">


                            <div class="form-group text-right">
                                <button class="btn btn-info news_submit" type="submit">Update Package</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>


    </form>

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

    //show dropify for package photo
    $('.dropify').dropify({
        messages: {
            'default': 'Browse for banner photo',
            'replace': 'Click to replace',
            'remove': 'Remove',
            'error': 'Choose correct file format'
        }
    });


    //text editor for package details
    // $("textarea.package_details").summernote({
    //     toolbar: [
    //         ['style', ['bold', 'italic', 'underline', 'clear']],
    //         ['font', ['strikethrough', 'superscript', 'subscript']],
    //         ['fontsize', ['fontsize']],
    //         ['color', ['color']],
    //         // ['table', ['table']],
    //         ['para', ['ul', 'ol', 'paragraph']],
    //         ['view', ['codeview']]
    //     ],
    //     height: 200
    // });

    $(".mrp, .tax, .price, .validity").on("keypress keyup blur", function (event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

});


</script>
@endpush




