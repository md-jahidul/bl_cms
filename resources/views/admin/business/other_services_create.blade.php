@extends('layouts.admin')
@section('title', 'Create Business Enterprise Service')
@section('card_name', 'Enterprise Solution')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('business-other-services') }}"> Service List</a></li>
    <li class="breadcrumb-item active"> Create</li>
@endsection
@section('action')
    <a href="{{ url('business-other-services') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
    <section>
        <form method="POST" action="{{ route('business.other.save')}}" class="form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-content collapse show">

                    <div class="card-body card-dashboard">
                        <h4><strong>Common Data</strong></h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label> Select Category <span class="text-danger">*</span></label>
                                <select class="form-control" required="required" name="type">
                                    <option value="">Select Category</option>
                                    <option value="business-solution">Business Solution</option>
                                    <option value="iot">IOT</option>
                                    <option value="others">Others</option>
                                </select>
                                  @if ($errors->has('type'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('type') }}
                                    </div>
                                 @endif
                            </div>
                            <div class="form-group">
                                <label for="Short Details">List Page Short Details (EN)</label>
                                <textarea type="text" name="home_short_details_en" class="form-control">{{ old('home_short_details_en') }}</textarea>
                                @if ($errors->has('home_short_details_en'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('home_short_details_en') }}
                                    </div>
                                @endif
                            </div>
                                <div class="form-group">
                                    <label for="Banner Photo">Product Photo (Web) <span class="text-danger">*</span></label>
                                    <input type="file" required class="dropify_package" name="banner_photo" data-height="60"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>@if ($errors->has('banner_photo'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('banner_photo') }}
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="Package Name"> Name (EN)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="name_en" value="{{ old('name_en') }}" placeholder="Package Name English">
                                @if ($errors->has('name_en'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('name_en') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="Short Details">List Page Short Details (BN)</label>
                                <textarea type="text" name="home_short_details_bn" class="form-control">{{ old('home_short_details_bn') }}</textarea>
                                @if ($errors->has('home_short_details_bn'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('home_short_details_bn') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Product Photo (Mobile)</label>
                                <input type="file" class="dropify_package" name="banner_mobile" data-height="60"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                @if ($errors->has('banner_mobile'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('banner_mobile') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="Package Name"> Name (BN)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="name_bn" value="{{ old('name_bn') }}" placeholder="Package Name Bangla">
                                @if ($errors->has('name_bn'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('name_bn') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="Icon">Icon <span class="text-danger">*</span></label>
                                <input type="file" class="dropify_package" required name="icon" data-height="60"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                @if ($errors->has('icon'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('icon') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Product Photo Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control banner_name" required name="banner_name" value="{{ old('banner_name') }}" placeholder="Photo Name">
                                <small class="text-info">
                                    <strong>i.e:</strong> mobile-reporting-service (no spaces)<br>
                                </small>
                                @if ($errors->has('banner_name'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('banner_name') }}
                                    </div>
                                @endif
                                <br>
                                <label>Alt Text</label>
                                <input type="text" class="form-control"  name="alt_text" value="{{ old('alt_text') }}" placeholder="Alt Text">
                                @if ($errors->has('alt_text'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('alt_text') }}
                                    </div>
                                @endif
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
                                <textarea type="text" name="banner_title_en" required class="form-control">{{ old('banner_title_en') }}</textarea>
                                @if ($errors->has('banner_title_en'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('banner_title_en') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="banner_title_bn">Banner Title (BN)<span class="text-danger">*</span></label>
                                <textarea type="text" name="banner_title_bn" class="form-control ">{{ old('banner_title_bn') }}</textarea>
                                @if ($errors->has('banner_title_bn'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('banner_title_bn') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="banner_subtitle_en">Banner Subtitle (EN)<span class="text-danger">*</span></label>
                                <textarea type="text" name="banner_subtitle_en" required class="form-control">{{ old('banner_subtitle_en') }}</textarea>
                                @if ($errors->has('banner_subtitle_en'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('banner_subtitle_en') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="banner_subtitle_bn">Banner Subtitle (BN)<span class="text-danger">*</span></label>
                                <textarea type="text" name="banner_subtitle_bn" required class="form-control">{{ old('banner_subtitle_bn') }}</textarea>
                                @if ($errors->has('banner_subtitle_bn'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('banner_subtitle_bn') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="Short Details">Short Details (EN)<span class="text-danger">*</span></label>
                                <textarea type="text" name="short_details_en" required class="form-control">{{ old('short_details_en') }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Show in top, after product name
                                </small>
                                @if ($errors->has('short_details_en'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('short_details_en') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="Short Details">Short Details (BN)<span class="text-danger">*</span></label>
                                <textarea type="text" name="short_details_bn" required class="form-control">{{ old('short_details_bn') }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Show in top, after product name
                                </small>
                                @if ($errors->has('short_details_bn'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('short_details_bn') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="Details">Offer Details (EN)</label>
                                <textarea type="text" name="offer_details_en" class="form-control summernote_editor">{{ old('offer_details_en') }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Show in bottom accordion
                                </small>
                                @if ($errors->has('offer_details_en'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('offer_details_en') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="Details">Offer Details (BN)</label>
                                <textarea type="text" name="offer_details_bn" class="form-control summernote_editor">{{ old('offer_details_bn') }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Show in bottom accordion
                                </small>
                                @if ($errors->has('offer_details_bn'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('offer_details_bn') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="Banner Photo">Details Banner (Web) <span class="text-danger">*</span></label>
                                <input type="file" required class="dropify_package" name="details_banner_web" data-height="60"
                                    data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                @if ($errors->has('details_banner_web'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('details_banner_web') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="Banner Photo">Details Banner (Mobile)</label>
                                <input type="file" class="dropify_package" name="details_banner_mob" data-height="60"
                                    data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                @if ($errors->has('details_banner_mob'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('details_banner_mob') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label>Banner Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control banner_name" required name="details_banner_name" value="{{ old('details_banner_name') }}" placeholder="Banner Name">
                                <small class="text-info">
                                    <strong>i.e:</strong> mobile-reporting-service (no spaces)<br>
                                </small>
                                @if ($errors->has('details_banner_name'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('details_banner_name') }}
                                    </div>
                                @endif
                                <br>
                                <label>Banner Alt Text</label>
                                <input type="text" class="form-control"  name="banner_alt_text" value="{{ old('banner_alt_text') }}" placeholder="Alt Text">
                                @if ($errors->has('banner_alt_text'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('banner_alt_text') }}
                                    </div>
                                @endif
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
                                        value="{{ old('url_slug') }}">
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
                                        value="{{ old('url_slug_bn') }}">
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
                                <textarea class="form-control" rows="7" name="page_header">{{ old('page_header') }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                                @if ($errors->has('page_header'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('page_header') }}
                                    </div>
                                @endif

                            </div>

                            <div class="form-group">
                                <label>Page Header Bangla (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header_bn">{{ old('page_header_bn') }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                                @if ($errors->has('page_header_bn'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('page_header_bn') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">

                                <label>Schema Markup</label>
                                <textarea class="form-control schema_markup" rows="7" name="schema_markup">{{ old('schema_markup') }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                                @if ($errors->has('schema_markup'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('schema_markup') }}
                                    </div>
                                @endif

                            </div>

                        </div>

                        <div class="col-md-8 col-xs-12">

                            <div class="form-group ">
                                <label>Features</label>
                                <div class="row">

                                    @foreach($features as $feature)
                                    <div class="col-md-12">
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

                            <div class="form-group ">
                                <h4>Select Related Solution (You may also like)</h4>
                                <hr>
                                <div class="row">
                                    @foreach($services as $s)
                                    <div class="col-md-4 col-xs-12">
                                        <label class="text-bold-600 cursor-pointer">
                                            <input type="checkbox" name="realated[{{$s->id}}]">
                                            {{$s->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group text-right">
                                <button class="btn btn-info" type="submit">Save</button>
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


    // text editor for package details
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
