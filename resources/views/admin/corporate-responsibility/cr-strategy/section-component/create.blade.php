@extends('layouts.admin')
@section('title_en', 'CR Strategy Component Create')
@section('card_name', 'CR Strategy Component Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('cr-strategy-component.index', $sectionId) }}">Component List</a></li>
    <li class="breadcrumb-item active"> Component Create</li>
@endsection
@section('action')
    <a href="{{ route('cr-strategy-component.index', $sectionId) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form id="product_form" role="form" action="{{ route('cr-strategy-component.store', $sectionId) }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title English</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter title in English"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title Bangla</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title in Bangla"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter title in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('details_en') ? ' error' : '' }}">
                                    <label for="details_en">Short Description En</label>
                                    <textarea type="text" name="details_en"  class="form-control summernote_editor"
                                              placeholder="Enter short description in English" rows="3"
                                              >{{ old("details_en") ? old("details_en") : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_en'))
                                        <div class="help-block">  {{ $errors->first('details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
                                    <label for="details_bn">Short Description BN</label>
                                    <textarea type="text" name="details_bn"  class="form-control summernote_editor" placeholder="Enter short description in Bangla"
                                              rows="3">{{ old("image_base_url") ? old("image_base_url") : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_bn'))
                                        <div class="help-block">  {{ $errors->first('details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 {{ $errors->has('image_base_url') ? ' error' : '' }}">
                                    <label for="thumbnail_image">Thumbnail Image</label>
                                    <input type="file" name="image_base_url" class="form-control dropify" data-height="90" placeholder="DD-MM-YYYY"
                                           value="{{ old("image_base_url") ? old("image_base_url") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_base_url'))
                                        <div class="help-block">  {{ $errors->first('image_base_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                    <label for="alt_text_en" class="required1">Alt text English</label>
                                    <input type="text" name="other_attributes[alt_text_en]" class="form-control section_alt_text"
                                           value="{{ old("alt_text_en") ? old("alt_text_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_en'))
                                        <div class="help-block">  {{ $errors->first('alt_text_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label for="alt_text_bn" class="required1">Alt text Bangla</label>
                                    <input type="text" name="other_attributes[alt_text_bn]" class="form-control section_alt_text"
                                           value="{{ old("alt_text_bn") ? old("alt_text_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_bn'))
                                        <div class="help-block">  {{ $errors->first('alt_text_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('image_name_en') ? ' error' : '' }}">
                                    <label for="image_name_en" class="required">Image Name En</label>
                                    <input type="text" name="image_name_en" class="form-control section_alt_text slug-convert" required
                                           value="{{ old("image_name_en") ? old("image_name_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_en'))
                                        <div class="help-block">  {{ $errors->first('image_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                                    <label for="image_name_bn" class="required">Image Name Bn</label>
                                    <input type="text" name="image_name_bn" class="form-control section_alt_text slug-convert" required
                                           value="{{ old("image_name_bn") ? old("image_name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_bn'))
                                        <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
                                    @endif
                                </div>

                                @include('admin.seo-fields.seo-fields')

                                <div class="col-md-6 mt-1">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="save" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
{{--    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            var date = new Date();
            date.setDate(date.getDate());
            $('#date').datetimepicker({
                format : 'YYYY-MM-DD',
                showClose: true,
            });
        });
    </script>
@endpush






