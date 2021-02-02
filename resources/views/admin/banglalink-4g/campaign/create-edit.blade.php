@extends('layouts.admin')

@section('title', "Create/Edit Dynamic Page")
@section('card_name', "Banglalink 4G")
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('bl-4g-campaign') }}"> 4G Campaigns List</a></li>
    <li class="breadcrumb-item active">Create/Edit</li>
@endsection
@section('action')
    <a href="{{ url('bl-4g-campaign') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i> Back
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>Create/Edit Campaign</strong></h5>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form"
                              action="{{ !empty($campaign) ? route('bl-4g-campaign.update', $campaign->id) : route('bl-4g-campaign.store') }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @if(!empty($campaign))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <?php
                                $title = "";
                                $image = null;
                                $details_en = "";
                                $details_bn = "";
                                $alt_text_en = "";
                                $alt_text_bn = "";
                                $image_name_en = "";
                                $image_name_bn = "";
                                if (!empty($campaign)) {
                                    $title = $campaign->title;
                                    $image = $campaign->image_url;
                                    $details_en = $campaign->details_en;
                                    $details_bn = $campaign->details_bn;
                                    $alt_text_en = $campaign->alt_text_en;
                                    $alt_text_bn = $campaign->alt_text_bn;
                                    $image_name_en = $campaign->image_name_en;
                                    $image_name_bn = $campaign->image_name_bn;
                                }
                                ?>

                                <div class="form-group col-md-12">
                                    <label class="">Title</label>
                                    <input type="text" name="title" value="{{ $title }}"
                                           class="form-control">
                                    <div class="help-block"></div>
                                </div>
                                <input type="hidden" name="id" value="{{ isset($campaign->id) ? $campaign->id : null}}">
                                <div class="form-group col-md-6 {{ $errors->has('image_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Campaign Image</label>
                                    <div class="custom-file">
                                        {{--                                    <input type="hidden" name="old_web_img" value="{{ isset($desktopImg) ? $desktopImg : null }}">--}}
                                        <input type="file" name="image_url" class="dropify" data-height="80" id="image"
                                               data-default-file="{{ isset($image) ?  config('filesystems.file_base_url') . $image : null  }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_url'))
                                        <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('image_name_en') ? ' error' : '' }}">
                                    <label for="image_name_en">Image Name EN</label>
                                    <input type="text" name="image_name_en" id="image_name_en" class="form-control slug-convert"
                                           placeholder="Enter image name en"
                                           value="{{ $image_name_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_en'))
                                        <div class="help-block">{{ $errors->first('image_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                                    <label for="image_name_bn">Image Name BN</label>
                                    <input type="text" name="image_name_bn" id="image_name_bn" class="form-control slug-convert"
                                           placeholder="Enter image name bn"
                                           value="{{ $image_name_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_bn'))
                                        <div class="help-block">{{ $errors->first('image_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="alt_text_en">Alt Text EN</label>
                                    <input type="text" name="alt_text_en" id="alt_text_en" class="form-control"
                                           placeholder="Enter alt text en"
                                           value="{{ $alt_text_en }}">
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label for="alt_text_bn">Alt Text BN</label>
                                    <input type="text" name="alt_text_bn" id="alt_text_bn" class="form-control"
                                           placeholder="Enter alt text bn"
                                           value="{{ $alt_text_bn }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('details_en') ? ' error' : '' }}">
                                    <label for="details_en">Details English</label>
                                    <textarea type="text" name="details_en" id="details_en" rows="5"
                                              class="form-control summernote_editor"
                                              placeholder="Enter details in English">{{ $details_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_en'))
                                        <div class="help-block">{{ $errors->first('details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
                                    <label for="details_bn">Details Bangla</label>
                                    <textarea type="text" name="details_bn" id="details_bn" rows="5"
                                              class="form-control summernote_editor"
                                              placeholder="Enter details in English">{{ $details_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_bn'))
                                        <div class="help-block">{{ $errors->first('details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>
                                        @if(isset($campaign))
                                            <input type="radio" name="status" value="1"
                                                   id="active" {{ $campaign->status == 1 ? 'checked' : '' }}>
                                            <label for="active" class="mr-1">Active</label>
                                            <input type="radio" name="status" value="0"
                                                   id="inactive"{{ $campaign->status == 0 ? 'checked' : '' }}>
                                            <label for="inactive">Inactive</label>
                                        @else
                                            <input type="radio" name="status" value="1" id="active" checked>
                                            <label for="active" class="mr-1">Active</label>
                                            <input type="radio" name="status" value="0" id="inactive">
                                            <label for="inactive">Inactive</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="save" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            function readURL(input, imgField) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(imgField).css('display', 'block');
                        $(imgField).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imageLeft").change(function () {
                var imgField = '#leftImg';
                readURL(this, imgField);
            });

            $("#imageRight").change(function () {
                var imgField = '#rightImg';
                readURL(this, imgField);
            });
        })
    </script>
@endpush






