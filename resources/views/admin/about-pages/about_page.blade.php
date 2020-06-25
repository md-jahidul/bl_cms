@extends('layouts.admin')

@section('title', "About Priyojon")
@section('card_name', "About Priyojon")
@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="--}}{{--{{ route('product.list', ) }}--}}{{--"> List</a></li>--}}
    {{--    <li class="breadcrumb-item active"> <a href="{{ route('partner-offer', [$parentId, $partnerName]) }}"> Partner Offer List</a></li>--}}
    <li class="breadcrumb-item active">About Priyojon Details</li>
@endsection
@section('action')
    {{--<a href="{{ url("offers/") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>About Priyojon Details</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('about-page.update') }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <input type="hidden" name="slug" value="{{ $slug }}">
                                <div class="form-group col-md-6 {{ $errors->has('details_en') ? ' error' : '' }}">
                                    <label for="details_en" class="required">Details (English)</label>
                                    <textarea type="text" name="details_en" class="form-control summernote_editor" placeholder="Enter offer details in english"
                                              required data-validation-required-message="Enter offer details in english">{{ $details->details_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_en'))
                                        <div class="help-block">{{ $errors->first('details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
                                    <label for="details_bn" class="required">Details (Bangla)</label>
                                    <textarea type="text" name="details_bn" class="form-control summernote_editor" placeholder="Enter offer details in english"
                                              required data-validation-required-message="Enter offer details in english">{{ $details->details_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_bn'))
                                        <div class="help-block">{{ $errors->first('details_bn') }}</div>
                                    @endif
                                </div>

                                @if($slug == 'reward_points')
                                    <div class="form-group col-md-6 {{ $errors->has('left_card_title_en') ? ' error' : '' }}">
                                        <label for="left_card_title_en" class="required">Card-1 Title (English)</label>
                                        <input type="text" name="other_attributes[left_card_title_en]"  class="form-control" placeholder="Enter title in English"
                                               value="{{ $details->other_attributes['left_card_title_en'] }}" required data-validation-required-message="Enter title in English">
                                        <div class="help-block"></div>
                                        @if ($errors->has('left_card_title_en'))
                                            <div class="help-block">  {{ $errors->first('left_card_title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('right_card_title_en') ? ' error' : '' }}">
                                        <label for="right_card_title_en" class="required">Card-2 Title (English)</label>
                                        <input type="text" name="other_attributes[right_card_title_en]"  class="form-control" placeholder="Enter title in Eangla"
                                               value="{{ $details->other_attributes['right_card_title_en'] }}" required data-validation-required-message="Enter title in English">
                                        <div class="help-block"></div>
                                        @if ($errors->has('right_card_title_en'))
                                            <div class="help-block">  {{ $errors->first('right_card_title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('left_card_title_bn') ? ' error' : '' }}">
                                        <label for="left_card_title_bn" class="required">Card-1 Title (Bangla)</label>
                                        <input type="text" name="other_attributes[left_card_title_bn]"  class="form-control" placeholder="Enter title in Bangla"
                                               value="{{ $details->other_attributes['left_card_title_bn'] }}" required data-validation-required-message="Enter title in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('left_card_title_bn'))
                                            <div class="help-block">  {{ $errors->first('left_card_title_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('right_card_title_bn') ? ' error' : '' }}">
                                        <label for="right_card_title_bn" class="required">Card-2 Title (Bangla)</label>
                                        <input type="text" name="other_attributes[right_card_title_bn]"  class="form-control" placeholder="Enter title in Bangla"
                                               value="{{ $details->other_attributes['right_card_title_bn'] }}" required data-validation-required-message="Enter title in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('right_card_title_bn'))
                                            <div class="help-block">  {{ $errors->first('right_card_title_bn') }}</div>
                                        @endif
                                    </div>
                                @endif

                                <div class="form-group col-md-6 {{ $errors->has('left_side_img') ? ' error' : '' }}">
                                    <label for="alt_text" class="">left Side Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="left_side_img" class="custom-file-input" id="imageLeft">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('left_side_img'))
                                        <div class="help-block">  {{ $errors->first('left_side_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('right_side_ing') ? ' error' : '' }}">
                                    <label for="alt_text" class="">Right Side Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="right_side_ing" class="custom-file-input" id="imageRight">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('right_side_ing'))
                                        <div class="help-block">  {{ $errors->first('right_side_ing') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6">
                                    @if($details->left_side_img)
                                        <img src="{{ ($details->left_side_img != '') ? config('filesystems.file_base_url') . $details->left_side_img : config('filesystems.file_base_url') . "assetlite/images/about-priyojon/about-placeholder.png" }}"
                                             id="leftImg" height="300" width="490">
                                        <input type="checkbox" name="remove_img_left" class="mt-2" value="1">
                                        <label>Remove Image</label>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('right_side_ing') ? ' error' : '' }}">
                                    @if($details->right_side_ing)
                                        <img src="{{ ($details->right_side_ing != '') ? config('filesystems.file_base_url') . $details->right_side_ing : config('filesystems.file_base_url') . "assetlite/images/about-priyojon/about-placeholder.png" }}"
                                             id="rightImg" height="300" width="490">
                                        <input type="checkbox" name="remove_img_right" class="mt-2" value="1">
                                        <label>Remove Image</label>
                                    @endif
                                </div>



                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="save" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> Update
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
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            function readURL(input, imgField) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(imgField).css('display', 'block');
                        $(imgField).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imageLeft").change(function() {
                var imgField = '#leftImg';
                readURL(this, imgField);
            });

            $("#imageRight").change(function() {
                var imgField = '#rightImg';
                readURL(this, imgField);
            });
        })
    </script>
@endpush






