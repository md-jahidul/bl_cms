@extends('layouts.admin')
@section('title', 'Roaming Info & Tips Create')
@section('card_name', 'Info & Tips Create')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('roaming-info-tips') }}"> Info & Tips</a></li>
<li class="breadcrumb-item active"> Create</li>
@endsection
@section('content')
<section>



    <form method="POST" action="{{ url('roaming/save-info-tips') }}" class="form" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="info_id">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="row">

                        <div class="col-md-12 col-xs-12">

                            <div class="form-group row">
                                <div class="col-md-3 col-xs-12">
                                  <label> Name (EN) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="name_en" placeholder="Name EN">
                                </div>

                                <div class="col-md-3 col-xs-12">
                                    <label>Name (BN) <span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control" required name="name_bn" placeholder="Name BN">
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <label> Card Text (EN) <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control" required name="card_text_en"></textarea>
                                    <small class="text-info">
                                        <strong>Note:</strong> It'll show in card list (in accordion list)
                                    </small>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <label>Card Text (BN) <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control" required name="card_text_bn"></textarea>
                                    <small class="text-info">
                                        <strong>Note:</strong> It'll show in card list (in accordion list)
                                    </small>
                                </div>

                            </div>
                            <div class="form-group row">

                                <div class="col-md-3 col-xs-12">
                                    <label> Short Text (EN)</label>
                                    <textarea rows="4" class="form-control" name="short_text_en"></textarea>
                                    <small class="text-info">
                                        <strong>Note:</strong> It'll show in details page after name
                                    </small>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <label>Short Text (BN)</label>
                                    <textarea rows="4" class="form-control" name="short_text_bn"></textarea>
                                    <small class="text-info">
                                        <strong>Note:</strong> It'll show in details page after name
                                    </small>
                                </div>

                                <div class="col-md-3 col-xs-12">
                                    <label>Banner (Web)</label>
                                    <input type="file" class="dropify" name="banner_web" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <label>Banner (Mobile)</label>
                                    <input type="file" class="dropify" name="banner_mobile" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                </div>

                            </div>

                            <div class="form-group row">



                                <div class="col-md-4 col-xs-12">
                                    <label>Page Header (HTML)</label>
                                    <textarea class="form-control html_header" rows="7" name="html_header"></textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <label>Page Header Bangla (HTML)</label>
                                    <textarea class="form-control html_header" rows="7" name="page_header_bn"></textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <label>Schema Markup</label>
                                    <textarea class="form-control schema_markup" rows="7" name="schema_markup"></textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> JSON-LD (Recommended by Google)
                                    </small>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Banner Photo Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control banner_name" required name="banner_name" placeholder="Photo Name">
                                    <small class="text-info">
                                        <strong>i.e:</strong> about-roaming-banner (no spaces)<br>
                                        <strong>Note: </strong> Don't need MIME type like jpg,png
                                    </small>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label> Alt Text</label>
                                    <input type="text" class="form-control"  name="alt_text" placeholder="Alt Text">
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label> URL EN<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control slug-convert" required name="url_slug" placeholder="URL">
                                    <small class="text-info">
                                        <strong>i.e:</strong> Buy-tickets-on-discount (no spaces and slash)<br>
                                    </small>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label> URL BN<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control slug-convert" required name="url_slug_bn" placeholder="URL">
                                    <small class="text-info">
                                        <strong>i.e:</strong> বাংলালিংক-প্রিপেইড-রোমিং (no spaces and slash)<br>
                                    </small>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label class="mr-1">
                                        <input type="radio" checked name="status" value="1" class="status_active"> Active
                                    </label>
                                    <label><input type="radio" name="status" value="0" class="status_inactive"> Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-sm btn-info pull-right">Save</button>
    </form>





</section>

@stop

@push('style')
<link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
<link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">

@endpush
@push('page-js')
<script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>

<script>
$(function () {


    $(".text_editor").summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
// ['table', ['table']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['fullscreen', 'codeview']]
        ],
        height: 170
    });

//show dropify for  photo
    $('.dropify').dropify({
        messages: {
            'default': 'Browse for photo',
            'replace': 'Click to replace',
            'remove': 'Remove',
            'error': 'Choose correct file format'
        }
    });



});


</script>
@endpush




