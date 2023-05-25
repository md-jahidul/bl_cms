@extends('layouts.admin')
@section('title', 'Roaming Other Offer Create')
@section('card_name', 'Offer Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('roaming-offers') }}"> Offers</a></li>
    <li class="breadcrumb-item active"> Create Offer</li>
@endsection
@section('content')
    <section>
        <form method="POST" action="{{ url('roaming/save-other-offer') }}" class="form" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="offer_id">

            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="row">

                            <div class="col-md-12 col-xs-12">

                                <div class="form-group row">
                                    <div class="col-md-3 col-xs-12">
                                        <label> Category <span class="text-danger">*</span></label>
                                        <select name="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $c)
                                                <option value="{{ $c->id }}">{{ $c->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-xs-12">
                                        <div>
                                            <label> Name (EN) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" required name="name_en"
                                                   placeholder="Name EN">
                                        </div>

                                        <label>Name (BN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required name="name_bn"
                                               placeholder="Name BN">
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

                                    <div class="col-md-6 col-xs-12">
                                        <label> Short Text (EN)</label>
                                        <textarea rows="4" class="form-control" name="short_text_en"></textarea>
                                        <small class="text-info">
                                            <strong>Note:</strong> It'll show in details page after name
                                        </small>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label>Short Text (BN)</label>
                                        <textarea rows="4" class="form-control" name="short_text_bn"></textarea>
                                        <small class="text-info">
                                            <strong>Note:</strong> It'll show in details page after name
                                        </small>
                                    </div>

                                    <div class="col-md-4 col-xs-12">
                                        <label>Card Image</label>
                                        <input type="file" class="dropify" name="card_image" data-height="70"
                                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                    </div>

                                    <div class="col-md-4 col-xs-12">
                                        <label>Banner (Web)</label>
                                        <input type="file" class="dropify" name="banner_web" data-height="70"
                                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <label>Banner (Mobile)</label>
                                        <input type="file" class="dropify" name="banner_mobile" data-height="70"
                                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                    </div>

                                    <div class="col-md-6 col-xs-12 mt-2">
                                        <label>Banner Title (EN)</label>
                                        <input class="form-control" name="banner_title_en">
                                    </div>
                                    <div class="col-md-6 col-xs-12 mt-2">
                                        <label>Banner Title (BN)</label>
                                        <input class="form-control" name="banner_title_bn">
                                    </div>

                                    <div class="col-md-6 col-xs-12 mt-2">
                                        <label>Banner Short Text (EN)</label>
                                        <textarea rows="4" class="form-control" name="banner_desc_en"></textarea>
                                    </div>
                                    <div class="col-md-6 col-xs-12 mt-2">
                                        <label>Banner Short Text (BN)</label>
                                        <textarea rows="4" class="form-control" name="banner_desc_bn"></textarea>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="form-group col-md-6 {{ $errors->has('tag_en') ? ' error' : '' }}">
                                        <label for="alt_text">Search Special Keyword En</label>
                                        <textarea name="tag_en" id="tag_en" class="form-control" rows="4"
                                                  placeholder="Enter keywords en"
                                        >{{ isset($searchTag->tag_en) ? $searchTag->tag_en : '' }}</textarea>
                                        <small class="warning"><strong>Example: Internet Packs, Tier Based Tenure, Eligible Customers, Point Status</strong></small>
                                        <div class="help-block"></div>
                                        @if ($errors->has('tag_en'))
                                            <div class="help-block">{{ $errors->first('tag_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('tag_bn') ? ' error' : '' }}">
                                        <label for="alt_text">Search Special Keyword Bn</label>
                                        <textarea type="text" name="tag_bn" id="alt_text" class="form-control" rows="4"
                                                  placeholder="Enter keywords bn">{{ isset($searchTag->tag_bn) ? $searchTag->tag_bn : '' }}</textarea>
                                        <small class="warning"><strong>Example: পয়েন্ট স্ট্যাটাস, টিয়ার সিস্টেম, অরেঞ্জ ক্লাব এর সদস্য</strong></small>
                                        <div class="help-block"></div>
                                        @if ($errors->has('tag_bn'))
                                            <div class="help-block">{{ $errors->first('tag_bn') }}</div>
                                        @endif
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
                                        <textarea class="form-control page_header_bn" rows="7"
                                                  name="page_header_bn"></textarea>
                                        <small class="text-info">
                                            <strong>Note: </strong> Title, meta, canonical and other tags
                                        </small>
                                    </div>

                                    <div class="col-md-4 col-xs-12">
                                        <label>Schema Markup</label>
                                        <textarea class="form-control schema_markup" rows="7"
                                                  name="schema_markup"></textarea>
                                        <small class="text-info">
                                            <strong>Note: </strong> JSON-LD (Recommended by Google)
                                        </small>
                                    </div>

                                    <div class="col-md-6 col-xs-12 mb-1">
                                        <label>Banner Photo Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control banner_name" required name="banner_name"
                                               placeholder="Photo Name">
                                        <small class="text-info">
                                            <strong>i.e:</strong> about-roaming-banner (no spaces)<br>
                                            <strong>Note: </strong> Don't need MIME type like jpg,png
                                        </small>
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <label> Alt Text</label>
                                        <input type="text" class="form-control" name="alt_text" placeholder="Alt Text">
                                    </div>

                                    <div class="col-md-6 {{ $errors->has('url_slug') ? ' error' : '' }} col-xs-12  mb-1">
                                        <label> URL EN<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control slug-convert" name="url_slug" placeholder="URL">
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
                                    <div class="col-md-4 col-xs-12">
                                        <label class="mr-1">
                                            <input type="radio" checked name="status" value="1" class="status_active"> Active
                                        </label>

                                        <label><input type="radio" name="status" value="0" class="status_inactive">
                                            Inactive</label>
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
    <link rel="stylesheet" href="{{ asset('plugins') }}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">

@endpush
@push('page-js')
    <script src="{{ asset('plugins') }}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>


    <script>
        $(function() {


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
