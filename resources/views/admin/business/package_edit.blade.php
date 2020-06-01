@extends('layouts.admin')
@section('title', 'Edit Business Packages')
@section('card_name', 'Edit Packages')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('business-package') }}"> Package List</a></li>
<li class="breadcrumb-item active"> Package Edit</li>
@endsection
@section('action')
<a href="{{ url('business-package') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
<section>

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">

                <form method="POST" action="{{ route('business.package.update')}}" class="form home_news_form" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-6 col-xs-12">

                            @csrf

                            <input type="hidden" value="{{$package->id}}" name="package_id">



                            <div class="form-group row">

                                <div class="col-md-6 col-xs-12">
                                    <label>Package Name (EN)<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="name_en" value="{{ $package->name }}" placeholder="Package Name English">
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Package Name (BN)<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="name_bn" value="{{ $package->name_bn }}" placeholder="Package Name Bangla">
                                </div>


                            </div>


                            <div class="form-group">

                                <label for="Details">Package Details (EN)</label>
                                <textarea type="text" name="package_details_en" class="form-control package_details">{!! $package->main_details !!}</textarea>

                                <hr>

                                <label for="Details">Package Details (BN)</label>
                                <textarea type="text" name="package_details_bn" class="form-control package_details">{!! $package->main_details_bn !!}</textarea>

                            </div>

                            <div class="form-group">

                                <label>URL Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="url_slug" value="{{ $package->url_slug }}">
                                <small class="text-info">
                                    <strong>i.e:</strong> roaming-rates (no spaces)<br>
                                </small>

                                <hr>

                                <label>Page Header (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header">{!! $package->page_header !!}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>


                            </div>


                            <div class="form-group ">
                                <h4 for="Details">Select Features</h4>
                                <hr>
                                <div class="row">

                                    @foreach($features as $feature)
                                    <div class="col-md-6">
                                        <label>
                                            @php
                                            $checked = "";
                                            if(in_array($feature->id, $asgnFeatures)){
                                            $checked = "checked";
                                            }
                                            @endphp
                                            <input type="checkbox" {{$checked}} name="feature[{{$feature->id}}]" class="custom-input">
                                            @if($feature->icon_url != "")
                                            <img src="{{ config('filesystems.file_base_url') . $feature->icon_url }}" alt="Feature Icon" width="30px" />
                                            @endif
                                            {{$feature->title}}
                                        </label>

                                    </div>
                                    @endforeach
                                </div>
                            </div>



                        </div>
                        <div class="col-md-6 col-xs-12">
                            
                             <div class="form-group row">

                                <div class="col-md-6 col-xs-12">
                                    <label for="Banner Photo">Card Photo (Web)<span class="text-danger">*</span></label>
                                    <input type="file" class="dropify_package" name="card_banner_web" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                    
                                    <input type="hidden" name="old_card_banner_web" value="{{$package->card_banner_web}}">
                                    
                                     <p class="text-center">
                                        @if($package->banner_photo != "")
                                        <img src="{{ config('filesystems.file_base_url') . $package->card_banner_web }}" alt="Banner Photo" width="100%" />
                                        @endif
                                    </p>
                                    
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label for="Banner Photo">Card Photo (Mobile) <span class="text-danger">*</span></label>
                                    <input type="file" class="dropify_package" name="card_banner_mobile" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                    
                                    <input type="hidden" name="old_card_banner_mobile" value="{{$package->card_banner_mobile}}">
                                    
                                     <p class="text-center">
                                        @if($package->banner_photo != "")
                                        <img src="{{ config('filesystems.file_base_url') . $package->card_banner_mobile }}" alt="Banner Photo" width="100%" />
                                        @endif
                                    </p>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Card Photo Alt Text</label>
                                    <input type="text" class="form-control" value="{{$package->card_banner_alt_text}}"  name="card_banner_alt_text" placeholder="Alt Text">
                                </div>

                            </div>

                            <div class="form-group row">


                                <div class="col-md-6 col-xs-12">

                                    <label for="Banner Photo">Banner Photo <span class="text-danger">*</span></label>

                                    <input type="hidden" name="old_banner" value="{{$package->banner_photo}}">
                                    
                                    <input type="file" class="dropify_package" name="banner_photo" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                    <p class="text-center">
                                        @if($package->banner_photo != "")
                                        <img src="{{ config('filesystems.file_base_url') . $package->banner_photo }}" alt="Banner Photo" width="100%" />
                                        @endif
                                    </p>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label for="Banner Photo">Banner Photo (Mobile) <span class="text-danger">*</span></label>
                                    
                                    <input type="hidden" name="old_banner_mob" value="{{$package->banner_image_mobile}}">
                                    
                                    <input type="file" class="dropify_package" name="banner_mobile" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                    
                                    <p class="text-center">
                                        @if($package->banner_image_mobile != "")
                                        <img src="{{ config('filesystems.file_base_url') . $package->banner_image_mobile }}" alt="Banner Photo" width="100%" />
                                        @endif
                                    </p>
                                    
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Banner Photo Name<span class="text-danger">*</span></label>
                                    <input type="hidden" name="old_banner_name" value="{{$package->banner_name}}">
                                    
                                    <input type="text" class="form-control banner_name" required name="banner_name" value="{{ $package->banner_name }}" placeholder="Photo Name">

                                    <small class="text-info">
                                        <strong>i.e:</strong> package-banner (no spaces)<br>
                                    </small>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Alt Text</label>
                                    <input type="text" class="form-control" value="{{$package->alt_text}}" name="alt_text" placeholder="Alt Text">
                                </div>

                            </div>


                            <div class="form-group row">

                                <div class="col-md-6 col-xs-12">
                                    <label for="Short Details">Short Details (EN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="short_details_en" required class="form-control">{{$package->short_details}}</textarea>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label for="Short Details">Short Details (BN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="short_details_bn" required class="form-control">{{$package->short_details_bn}}</textarea>
                                </div>


                            </div>


                            <div class="form-group">

                                <label for="Offer Details">Offer Details (EN)</label>
                                <textarea type="text" name="offer_details_en" class="form-control package_details">{!! $package->offer_details !!}</textarea>

                                <hr>

                                <label for="Offer Details">Offer Details (BN)</label>
                                <textarea type="text" name="offer_details_bn" class="form-control package_details">{!! $package->offer_details_bn !!}</textarea>

                            </div>
                            
                            <div class="form-group">

                                <label>Schema Markup</label>
                                <textarea class="form-control schema_markup" rows="7" name="schema_markup">{!! $package->schema_markup !!}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>



                            </div>

                        </div>

                        <div class="col-md-12 col-xs-12">

                            <div class="form-group ">
                                <h4>Select Related Package (You may also like)</h4>
                                <hr>
                                <div class="row">



                                    @foreach($packages as $pac)

                                    @php
                                    $checked = "";
                                    if(in_array($pac->id, $relatedProducts)){
                                    $checked = "checked";
                                    }
                                    @endphp


                                    <div class="col-md-3 col-xs-12">
                                        <label class="text-bold-600 cursor-pointer">
                                            <input type="checkbox" {{$checked}} name="realated[{{$pac->id}}]">
                                            {{$pac->name}}
                                        </label>

                                    </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="form-group text-right">
                                <button class="btn btn-sm btn-info news_submit" type="submit">Save Package</button>
                            </div>

                        </div>

                    </div>
                </form>



            </div>
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
    $('.dropify_package').dropify({
        messages: {
            'default': 'Browse for update photo',
            'replace': 'Click to replace',
            'remove': 'Remove',
            'error': 'Choose correct file format'
        }
    });


    //text editor for package details
    $("textarea.package_details").summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            // ['table', ['table']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview']]
        ],
        height: 200
    });

});


</script>
@endpush




