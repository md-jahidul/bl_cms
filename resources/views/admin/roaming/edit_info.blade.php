@extends('layouts.admin')
@section('title', 'Roaming Other Offer Create')
@section('card_name', 'Offer Create')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('roaming-info-tips') }}"> Info & Tips</a></li>
<li class="breadcrumb-item active"> Edit</li>
@endsection
@section('content')
<section>



    <form method="POST" action="{{ url('roaming/save-info-tips') }}" class="form" enctype="multipart/form-data">
        @csrf

               <input type="hidden" name="info_id" value="{{$info->id}}">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="row">

                        <div class="col-md-12 col-xs-12">

                            <div class="form-group row">
                                <div class="col-md-3 col-xs-12">
                                   <label> Name (EN) <span class="text-danger">*</span></label>
                                    <input type="text" value="{{$info->name_en}}" class="form-control" required name="name_en" placeholder="Name EN">
                                </div>

                                <div class="col-md-3 col-xs-12">
                                    <label>Name (BN) <span class="text-danger">*</span></label>
                                    <input type="text" value="{{$info->name_bn}}" class="form-control" required name="name_bn" placeholder="Name BN">
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <label> Card Text (EN) <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control" required name="card_text_en">{{$info->card_text_en}}</textarea>
                                    <small class="text-info">
                                        <strong>Note:</strong> It'll show in card list (in accordion list)
                                    </small>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <label>Card Text (BN) <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control" required name="card_text_bn">{{$info->card_text_bn}}</textarea>
                                    <small class="text-info">
                                        <strong>Note:</strong> It'll show in card list (in accordion list)
                                    </small>
                                </div>

                            </div>
                            <div class="form-group row">

                                <div class="col-md-3 col-xs-12">
                                    <label> Short Text (EN)</label>
                                    <textarea rows="4" class="form-control" name="short_text_en">{{$info->short_text_en}}</textarea>
                                    <small class="text-info">
                                        <strong>Note:</strong> It'll show in details page after name
                                    </small>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <label>Short Text (BN)</label>
                                    <textarea rows="4" class="form-control" name="short_text_bn">{{$info->short_text_bn}}</textarea>
                                    <small class="text-info">
                                        <strong>Note:</strong> It'll show in details page after name
                                    </small>
                                </div>

                                <div class="col-md-3 col-xs-12">
                                    <label>Banner (Web)</label>
                                    <input type="file" class="dropify" name="banner_web" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                    @if($info->banner_web != "")
                                    <img src="{{ config('filesystems.file_base_url') . $info->banner_web }}" width="100%">
                                    @endif

                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <label>Banner (Mobile)</label>
                                    <input type="file" class="dropify" name="banner_mobile" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                    @if($info->banner_mobile != "")
                                    <img src="{{ config('filesystems.file_base_url') . $info->banner_mobile }}" width="100%">
                                    @endif

                                </div>

                            </div>

                            <div class="form-group row">

                              <div class="col-md-4 col-xs-12">
                                    <label>Page Header (HTML)</label>
                                    <textarea class="form-control html_header" rows="7" name="html_header">{{$info->page_header}}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                              </div>

                              <div class="col-md-4 col-xs-12">
                                <label>Page Header Bangla (HTML)</label>
                                <textarea class="form-control html_header" rows="7" name="page_header_bn">{{$info->page_header_bn}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                              </div>


                                <div class="col-md-4 col-xs-12">
                                    <label>Schema Markup</label>
                                    <textarea class="form-control schema_markup" rows="7" name="schema_markup">{{$info->schema_markup}}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> JSON-LD (Recommended by Google)
                                    </small>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <label>Banner Photo Name<span class="text-danger">*</span></label>
                                    <input type="hidden" name="banner_name_old" value="{{$info->banner_name}}">
                                    <input type="text" value="{{$info->banner_name}}" class="form-control" required name="banner_name" placeholder="Photo Name">
                                    <small class="text-info">
                                        <strong>i.e:</strong> about-roaming-banner (no spaces)<br>
                                        <strong>Note: </strong> Don't need MIME type like jpg,png
                                    </small>

                                    <br>
                                    <br>
                                    <label> Alt Text</label>
                                    <input type="text" value="{{$info->alt_text}}" class="form-control"  name="alt_text" placeholder="Alt Text">

                                    <br>
                                    <label> URL <span class="text-danger">*</span></label>
                                    <input type="text" value="{{$info->url_slug}}" class="form-control" required name="url_slug" placeholder="URL">
                                    <small class="text-info">
                                        <strong>i.e:</strong> Buy-tickets-on-discount (no spaces)<br>
                                    </small>

                                    <br>
                                    <label class="mr-1">
                                        <input type="radio" @if($info->status == 1) checked @endif name="status" value="1" class="status_active"> Active
                                    </label>


                                    <label><input type="radio" @if($info->status == 0) checked @endif name="status" value="0" class="status_inactive"> Inactive</label>
                                </div>




                            </div>



                        </div>



                    </div>

                </div>
            </div>
        </div>

        <input type="hidden" name="old_web" value="{{$info->banner_web}}">
        <input type="hidden" name="old_mobile" value="{{$info->banner_mobile}}">

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




