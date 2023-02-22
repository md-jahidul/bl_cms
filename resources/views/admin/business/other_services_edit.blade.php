@extends('layouts.admin')
@section('title', 'Edit Business Enterprise Service')
@section('card_name', 'Enterprise Solution')
@section('breadcrumb')
    @php
        $url = str_replace(url('/'), '', url()->previous());
        $previousUrl = substr($url, 1);
    @endphp

<li class="breadcrumb-item active"> <a href="{{ url($previousUrl) }}">
        {{ $previousUrl != "business-other-services" ? 'Slider List' : 'Service List' }}</a></li>
<li class="breadcrumb-item active"> Edit</li>
@endsection
@section('action')
<a href="{{ url('business-other-services') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
<section>

    <form method="POST" action="{{ route('business.other.update')}}" class="form home_news_form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4><strong>Common Data</strong></h4>
                    <hr>

                    <div class="row">

                        <div class="col-md-4 col-xs-12">

                            <input type="hidden" name="service_id" value="{{$service->id}}">


                            @if($type == '')
                            <div class="form-group">
                                <label> Select Category <span class="text-danger">*</span></label>
                                <select class="form-control" required="required" name="type">
                                    <option value="">Select Category</option>
                                    <option @if($service->type == 'business-solution') selected @endif value="business-solution">Business Solution</option>
                                    <option @if($service->type == 'iot') selected @endif value="iot">IOT</option>
                                    <option @if($service->type == 'others') selected @endif value="others">Others</option>
                                </select>
                            </div>
                            @else
                             <input type="hidden" name="type" value="{{$serviceId}}">
                            @endif

                            <div class="form-group">
                                <label for="Short Details">List Page Short Details (EN)</label>
                                <textarea type="text" name="home_short_details_en" class="form-control">{{$service->home_short_details_en}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="Banner Photo">Product Photo (Web) <span class="text-danger">*</span></label>
                                <input type="file" class="dropify_package" name="banner_photo" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                <input type="hidden" name="old_banner" value="{{$service->banner_photo}}">

                                <p class="text-center">
                                    @if($service->banner_photo != "")
                                    <img src="{{ config('filesystems.file_base_url') . $service->banner_photo }}" alt="Product Photo" width="100%">
                                    @endif
                                </p>


                            </div>





                        </div>

                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label for="Package Name"> Name (EN)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$service->name}}"  required name="name_en" placeholder="Package Name English">

                            </div>

                            <div class="form-group">
                                <label for="Short Details">List Page Short Details (BN)</label>
                                <textarea type="text" name="home_short_details_bn" class="form-control">{{$service->home_short_details_bn}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Product  Photo (Mobile)</label>
                                <input type="file" class="dropify_package" name="banner_mobile" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                <input type="hidden" name="old_banner_mob" value="{{$service->banner_image_mobile}}">

                                @if($service->banner_image_mobile != "")
                                <img src="{{ config('filesystems.file_base_url') . $service->banner_image_mobile }}" width="100%">
                                @endif

                            </div>


                        </div>

                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label for="Package Name"> Name (BN)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$service->name_bn}}"  required name="name_bn" placeholder="Package Name Bangla">
                            </div>

                            <div class="form-group">
                                <label for="Banner Photo">Icon <span class="text-danger">*</span></label>
                                <input type="file" class="dropify_package" name="icon" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                <input type="hidden" name="old_icon" value="{{$service->icon}}">

                                <p class="text-center">
                                    @if($service->icon != "")
                                    <img src="{{ config('filesystems.file_base_url') . $service->icon }}" height="40px" />
                                    @endif
                                </p>
                            </div>

                            <div class="form-group">


                                <label>Banner Photo Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$service->banner_name}}" required name="banner_name" placeholder="Photo Name">

                                <input type="hidden" value="{{$service->banner_name}}" name="old_banner_name">

                                <small class="text-info">
                                    <strong>i.e:</strong> package-banner (no spaces)<br>
                                </small>

                                <br>

                                <label>Alt Text</label>
                                <input type="text" class="form-control" value="{{$service->alt_text}}" name="alt_text" placeholder="Alt Text">

                            </div>


                        </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">

                        <h4><strong>Details Data</strong></h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 col-xs-12">

                                <div class="form-group">
                                    <label for="banner_title_en">Banner Title (EN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="banner_title_en" required class="form-control">{{$service->banner_title_en}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="banner_title_bn">Banner Title (BN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="banner_title_bn" class="form-control ">{{$service->banner_title_bn}}</textarea>

                                </div>

                            </div>
                            <div class="col-md-4 col-xs-12">

                                <div class="form-group">
                                    <label for="banner_subtitle_en">Banner Subtitle (EN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="banner_subtitle_en" required class="form-control">{{$service->banner_subtitle_en}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="banner_subtitle_bn">Banner Subtitle (BN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="banner_subtitle_bn" required class="form-control">{{$service->banner_subtitle_bn}}</textarea>
                                </div>

                            </div>


                            <div class="col-md-4 col-xs-12">

                                <div class="form-group">
                                    <label for="banner_title_en">Banner Title (EN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="banner_title_en" required class="form-control">{{$service->banner_title_en}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="banner_title_bn">Banner Title (BN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="banner_title_bn" class="form-control ">{{$service->banner_title_bn}}</textarea>

                                </div>

                            </div>
                            <div class="col-md-4 col-xs-12">

                                <div class="form-group">
                                    <label for="banner_subtitle_en">Banner Subtitle (EN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="banner_subtitle_en" required class="form-control">{{$service->banner_subtitle_en}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="banner_subtitle_bn">Banner Subtitle (BN)<span class="text-danger">*</span></label>
                                    <textarea type="text" name="banner_subtitle_bn" required class="form-control">{{$service->banner_subtitle_bn}}</textarea>
                                </div>

                            </div>


                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label for="Short Details">Short Details (EN)<span class="text-danger">*</span></label>
                                <textarea type="text" name="short_details_en" required class="form-control">{{$service->short_details}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Show in top, after product name
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="Details">Offer Details (EN)</label>
                                <textarea type="text" name="offer_details_en" class="form-control summernote_editor">{{$service->offer_details_en}}</textarea>

                            </div>

                        </div>

                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label for="Short Details">Short Details (BN)<span class="text-danger">*</span></label>
                                <textarea type="text" name="short_details_bn" required class="form-control">{{$service->short_details_bn}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Show in top, after product name
                                </small>
                            </div>

                            <div class="form-group">

                                <label for="Details">Offer Details (BN)</label>
                                <textarea type="text" name="offer_details_bn" class="form-control summernote_editor">{{$service->offer_details_bn}}</textarea>

                            </div>








                        </div>

                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label for="Banner Photo">Details Banner (Web)</label>
                                <input type="file" class="dropify_package" name="details_banner_web" data-height="60"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                <input type="hidden" name="old_details_banner_web" value="{{$service->details_banner_web}}">

                                @if($service->details_banner_web != "")
                                <img src="{{ config('filesystems.file_base_url') . $service->details_banner_web }}" width="100%">
                                @endif

                            </div>

                            <div class="form-group">
                                <label for="Banner Photo">Details Banner (Mobile)</label>
                                <input type="file" class="dropify_package" name="details_banner_mob" data-height="60"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                <input type="hidden" name="old_details_banner_mob" value="{{$service->details_banner_mobile}}">

                                @if($service->details_banner_mobile != "")
                                <img src="{{ config('filesystems.file_base_url') . $service->details_banner_mobile }}" width="100%">
                                @endif

                            </div>

                            <div class="form-group">

                                <label>Banner Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control banner_name" required name="details_banner_name" value="{{$service->details_banner_name}}" placeholder="Banner Name">
                                <input type="hidden" name="old_details_banner_name" value="{{$service->details_banner_name}}">

                                <small class="text-info">
                                    <strong>i.e:</strong> mobile-reporting-service (no spaces)<br>
                                </small>

                                <br>

                                <label>Banner Alt Text</label>
                                <input type="text" class="form-control"  name="banner_alt_text" value="{{$service->details_alt_text}}" placeholder="Alt Text">

                            </div>



                        </div>


                    </div>


                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4><strong>SEO and Others Data</strong></h4>
                    <hr>

                    <div class="row">



                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <div class="mb-1">
                                    <label>URL Slug EN <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control slug-convert" required name="url_slug" placeholder="URL EN"
                                           value="{{ $service->url_slug }}">
                                    <small class="text-info">
                                        <strong>i.e:</strong> 5gb-hot-offer (no spaces and slash)<br>
                                    </small>
                                    @if ($errors->has('url_slug'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('url_slug') }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <label>URL Slug BN <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control slug-convert" required name="url_slug_bn" placeholder="URL BN"
                                           value="{{ $service->url_slug_bn }}">
                                    <small class="text-info">
                                        <strong>i.e:</strong> ৫জিবি-অফার (no spaces and slash)<br>
                                    </small>
                                    @if ($errors->has('url_slug_bn'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('url_slug_bn') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Page Header (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header">{{$service->page_header}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group">
                                <label>Page Header Bangla (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header_bn">{{$service->page_header_bn}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group">

                                <label>Schema Markup</label>
                                <textarea class="form-control schema_markup" rows="7" name="schema_markup">{{$service->schema_markup}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>

                            </div>
                        </div>


                        <div class="col-md-8 col-xs-12">

                            <div class="form-group ">
                                <label>Features</label>
                                <div class="row">

                                    @foreach($features as $feature)
                                    <div class="col-md-12">
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

                            <div class="form-group ">
                                <h4>Select Related Solution (You may also like)</h4>
                                <hr>
                                <div class="row">

                                    @foreach($services as $s)

                                    @php
                                    $checked = "";
                                    if(in_array($s->id, $relatedProducts)){
                                    $checked = "checked";
                                    }
                                    @endphp


                                    <div class="col-md-4 col-xs-12">
                                        <label class="text-bold-600 cursor-pointer">
                                            <input type="checkbox" {{$checked}} name="realated[{{$s->id}}]">
                                            {{$s->name}}
                                        </label>

                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-info pull-right">Save</button>
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
            'default': 'Browse for photo',
            'replace': 'Click to replace',
            'remove': 'Remove',
            'error': 'Choose correct file format'
        }
    });


    //text editor for package details
    // $("textarea.textarea_details").summernote({
    //     toolbar: [
    //         ['style', ['bold', 'italic', 'underline', 'clear']],
    //         ['font', ['strikethrough', 'superscript', 'subscript']],
    //         ['fontsize', ['fontsize']],
    //         ['color', ['color']],
    //         // ['table', ['table']],
    //         ['para', ['ul', 'ol', 'paragraph']],
    //         ['view', ['codeview']]
    //     ],
    //     height: 170
    // });

});


</script>
@endpush




