@extends('layouts.admin')
@section('title', 'Create Business Packages')
@section('card_name', 'Create Packages')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('business-package') }}"> Package List</a></li>
<li class="breadcrumb-item active"> Package Create</li>
@endsection
@section('action')
<a href="{{ url('business-package') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
<section>

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">

                <form method="POST" action="{{ route('business.package.save')}}" class="form home_news_form" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-6 col-xs-12">

                            @csrf

                            <div class="form-group row">

                                <div class="col-md-6 col-xs-12">
                                    <label>Package Name (EN)<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="name_en" placeholder="Package Name English" value={{old("name_en") ? old("name_en") : ''}}>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('name_en') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Package Name (BN)<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="name_bn" placeholder="Package Name Bangla" value={{old("name_bn") ? old("name_bn") : ''}}>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('name_bn') }}
                                        </div>
                                    @endif
                                </div>


                            </div>



                            <div class="form-group">

                                <label for="Details">Package Details (EN)</label>
                                <textarea type="text" name="package_details_en" class="form-control summernote_editor">{{old("package_details_en") ? old("package_details_en") : ''}}</textarea>

                                <hr>

                                <label for="Details">Package Details (BN)</label>
                                <textarea type="text" name="package_details_bn" class="form-control summernote_editor">{{old("package_details_bn") ? old("package_details_bn") : ''}}</textarea>

                            </div>

                            <div class="form-group">

                               <div class="mb-1">
                                   <label>URL Slug EN<span class="text-danger">*</span></label>
                                   <input type="text" class="form-control slug-convert" required name="url_slug" placeholder="URL EN" value={{old("url_slug") ? old("url_slug") : ''}}>
                                   <small class="text-info">
                                       <strong>i.e:</strong> banglalink-corporate-postpaid (no spaces and slash)<br>
                                   </small>
                                   @if ($errors->has('url_slug'))
                                       <div class="help-block text-danger">
                                           {{ $errors->first('url_slug') }}
                                       </div>
                                   @endif
                               </div>

                                <div>
                                    <label>URL Slug BN<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control slug-convert" required name="url_slug_bn" placeholder="URL BN" value={{old("url_slug_bn") ? old("url_slug_bn") : ''}}>
                                    <small class="text-info">
                                        <strong>i.e:</strong> বাংলালিংক-কর্পোরেট-পোস্টপেইড (no spaces and slash)<br>
                                    </small>
                                    @if ($errors->has('url_slug_bn'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('url_slug_bn') }}
                                        </div>
                                    @endif
                                </div>
                                <hr>
                                <label>Page Header (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header">{{old("page_header") ? old("page_header") : ''}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                                <br>
                                <br>
                                <label>Page Header Bangla (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header_bn">{{old("page_header_bn") ? old("page_header_bn") : ''}}</textarea>
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
                                            <input type="checkbox" name="feature[{{$feature->id}}]" class="custom-input">
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
                                    @if ($errors->has('card_banner_web'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('card_banner_web') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label for="Banner Photo">Card Photo (Mobile) <span class="text-danger">*</span></label>
                                    <input type="file" class="dropify_package" name="card_banner_mobile" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                    @if ($errors->has('card_banner_mobile'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('card_banner_mobile') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Card Photo Alt Text</label>
                                    <input type="text" class="form-control"  name="card_banner_alt_text" placeholder="Alt Text" value={{old("card_banner_alt_text") ? old("card_banner_alt_text") : ''}}>
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-md-6 col-xs-12">
                                    <label for="Banner Photo">Banner Photo (Web)<span class="text-danger">*</span></label>
                                    <input type="file" class="dropify_package" name="banner_photo" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                    @if ($errors->has('banner_photo'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('banner_photo') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label for="Banner Photo">Banner Photo (Mobile) <span class="text-danger">*</span></label>
                                    <input type="file" class="dropify_package" name="banner_mobile" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                    
                                    @if ($errors->has('banner_mobile'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('banner_mobile') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Banner Photo Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control banner_name" required name="banner_name" placeholder="Photo Name" value={{old("banner_name") ? old("banner_name") : ''}}>

                                    <small class="text-info">
                                        <strong>i.e:</strong> package-banner (no spaces)<br>
                                    </small>
                                    @if ($errors->has('banner_name'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('banner_name') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Alt Text</label>
                                    <input type="text" class="form-control"  name="alt_text" placeholder="Alt Text" value={{old("alt_text") ? old("alt_text") : ''}}>
                                </div>



                            </div>

                            <div class="form-group row">

                                <div class="col-md-6 col-xs-12">
                                    <label for="Short Details">Short Details (EN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="short_details_en" required class="form-control">{{old("short_details_en") ? old("short_details_en") : ''}}</textarea>
                                    @if ($errors->has('short_details_en'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('short_details_en') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label for="Short Details">Short Details (BN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="short_details_bn" required class="form-control">{{old("short_details_bn") ? old("short_details_bn") : ''}}</textarea>
                                    @if ($errors->has('short_details_bn'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('short_details_bn') }}
                                        </div>
                                    @endif
                                </div>


                            </div>

                            <div class="form-group">

                                <label for="Offer Details">Offer Details (EN)</label>
                                <textarea type="text" name="offer_details_en" class="form-control summernote_editor">{{old("offer_details_en") ? old("offer_details_en") : ''}}</textarea>
                                @if ($errors->has('offer_details_en'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('offer_details_en') }}
                                    </div>
                                @endif

                                <hr>

                                <label for="Offer Details">Offer Details (BN)</label>
                                <textarea type="text" name="offer_details_bn" class="form-control summernote_editor">{{old("offer_details_bn") ? old("offer_details_bn") : ''}}</textarea>
                                @if ($errors->has('offer_details_bn'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('offer_details_bn') }}
                                    </div>
                                @endif

                            </div>
                            <div class="form-group">

                                <label>Schema Markup</label>
                                <textarea class="form-control schema_markup" rows="7" name="schema_markup">{{old("schema_markup") ? old("schema_markup") : ''}}</textarea>
                                @if ($errors->has('schema_markup'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('schema_markup') }}
                                    </div>
                                @endif
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
                                    <div class="col-md-3 col-xs-12">
                                        <label class="text-bold-600 cursor-pointer">
                                            <input type="checkbox" name="realated[{{$pac->id}}]">
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
<script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
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

});


</script>
@endpush




