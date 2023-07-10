@extends('layouts.admin')
@section('title_en', 'Press News Event Create')
@section('card_name', 'Press News Event Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('press-news-event') }}">Press News Event List</a></li>
    <li class="breadcrumb-item active"> Press News Event Create</li>
@endsection
@section('action')
    <a href="{{ url('press-news-event') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form id="product_form" role="form" action="{{ route('press-news-event.store') }}" method="POST" novalidate enctype="multipart/form-data">
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

                                <div class="form-group col-md-6 {{ $errors->has('type') ? ' error' : '' }}">
                                    <label for="type" class="required">Type</label>
                                    <select class="form-control" name="type" id="offer_type"
                                            required data-validation-required-message="Please select type">
                                        <option value="">---Select Type---</option>
                                        <option data-alias="press_release" value="press_release">Press Release</option>
                                        <option data-alias="news_events" value="news_events">News and Events</option>
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('type'))
                                        <div class="help-block">  {{ $errors->first('type') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('date') ? ' error' : '' }}">
                                    <label for="date" class="required">Date</label>
                                    <input type="text" id="date" name="date" class="form-control" placeholder="YYYY-MM-DD"
                                           value="{{ old("date") ? old("date") : '' }}"
                                           required data-validation-required-message="Enter date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('date'))
                                        <div class="help-block">  {{ $errors->first('date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('thumbnail_image') ? ' error' : '' }}">
                                    <label for="thumbnail_image" class="required">Thumbnail Image</label>
                                    <input type="file" name="thumbnail_image" class="form-control dropify" data-height="90" placeholder="DD-MM-YYYY"
                                           value="{{ old("thumbnail_image") ? old("thumbnail_image") : '' }}"
                                           required data-validation-required-message="Enter thumbnail_image">
                                    <div class="help-block"></div>
                                    @if ($errors->has('thumbnail_image'))
                                        <div class="help-block">  {{ $errors->first('thumbnail_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                    <label for="alt_text_en" class="">Alt Text EN</label>
                                    <input type="text" id="alt_text_en" name="alt_text_en" class="form-control" placeholder="Enter alt text en"
                                           value="{{ old("alt_text_en") ? old("alt_text_en") : '' }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label for="alt_text_bn" class="">Alt Text BN</label>
                                    <input type="text" id="alt_text_bn" name="alt_text_bn" class="form-control" placeholder="Enter alt text bn"
                                           value="{{ old("alt_text_bn") ? old("alt_text_bn") : '' }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('thumbnail_image_name_en') ? ' error' : '' }}">
                                    <label class="required">Thumbnail Image Name EN</label>
                                    <input type="text" name="thumbnail_image_name_en" class="form-control" placeholder="Enter thumbnail image name en"
                                           required value="{{ old("thumbnail_image_name_en") ? old("thumbnail_image_name_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('thumbnail_image_name_en'))
                                        <div class="help-block">  {{ $errors->first('thumbnail_image_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('thumbnail_image_name_en') ? ' error' : '' }}">
                                    <label class="required">Thumbnail Image Name BN</label>
                                    <input type="text" name="thumbnail_image_name_bn" required class="form-control" placeholder="Enter thumbnail image name bn"
                                           value="{{ old("thumbnail_image_name_bn") ? old("thumbnail_image_name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('thumbnail_image_name_bn'))
                                        <div class="help-block">  {{ $errors->first('thumbnail_image_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('short_details_en') ? ' error' : '' }}">
                                    <label for="short_details_en" class="required">Short Description En</label>
                                    <textarea type="text" name="short_details_en"  class="form-control" placeholder="Enter short description in English" required rows="3"
                                              data-validation-required-message="Enter short description in English">{{ old("short_details_en") ? old("short_details_en") : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_details_en'))
                                        <div class="help-block">  {{ $errors->first('short_details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('short_details_bn') ? ' error' : '' }}">
                                    <label for="short_details_bn" class="required">Short Description BN</label>
                                    <textarea type="text" name="short_details_bn"  class="form-control" placeholder="Enter short description in Bangla" required rows="3"
                                              data-validation-required-message="Enter short description in Bangla">{{ old("short_details_bn") ? old("short_details_bn") : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_details_bn'))
                                        <div class="help-block">  {{ $errors->first('short_details_bn') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6"></div>

{{--                                <slot id="press_release" data-offer-type="press_release" style="display: none">--}}
                                    <h5><strong>Pop Up Section</strong></h5>
                                    <div class="form-actions col-md-12 mt-0"></div>

                                    <div class="form-group col-md-6 {{ $errors->has('details_image') ? ' error' : '' }}">
                                        <label for="details_image" class="required">Pop Up Banner Image</label>
                                        <input type="file" name="details_image" class="form-control dropify" data-height="90" placeholder="DD-MM-YYYY"
                                               value="{{ old("details_image") ? old("details_image") : '' }}"
                                               required data-validation-required-message="Enter details_image">
                                        <div class="help-block"></div>
                                        @if ($errors->has('details_image'))
                                            <div class="help-block">  {{ $errors->first('details_image') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-3 {{ $errors->has('details_alt_text_en') ? ' error' : '' }}">
                                        <label for="details_alt_text_en" class="">Alt Text EN</label>
                                        <input type="text" id="details_alt_text_en" name="details_alt_text_en" class="form-control" placeholder="Enter alt text en"
                                               value="{{ old("details_alt_text_en") ? old("details_alt_text_en") : '' }}">
                                    </div>

                                    <div class="form-group col-md-3 {{ $errors->has('details_alt_text_bn') ? ' error' : '' }}">
                                        <label for="details_alt_text_bn" class="">Alt Tex BN</label>
                                        <input type="text" id="details_alt_text_bn" name="details_alt_text_bn" class="form-control" placeholder="Enter alt text bn"
                                               value="{{ old("details_alt_text_bn") ? old("details_alt_text_bn") : '' }}">
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('details_image_name_en') ? ' error' : '' }}">
                                        <label class="required">Banner Name EN</label>
                                        <input type="text" name="details_image_name_en" class="form-control" placeholder="Enter details image name en"
                                               required value="{{ old("details_image_name_en") ? old("details_image_name_en") : '' }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('details_image_name_en'))
                                            <div class="help-block">  {{ $errors->first('details_image_name_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('details_image_name_en') ? ' error' : '' }}">
                                        <label class="required">Banner Name BN</label>
                                        <input type="text" name="details_image_name_bn" required class="form-control" placeholder="Enter details image name bn"
                                               value="{{ old("details_image_name_bn") ? old("details_image_name_bn") : '' }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('details_image_name_bn'))
                                            <div class="help-block">  {{ $errors->first('details_image_name_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('long_details_bn') ? ' error' : '' }}">
                                        <label for="long_details_bn" class="required">Long Description En</label>
                                        <textarea type="text" name="long_details_en" class="form-control summernote_editor" placeholder="Enter long description in English" required
                                                  data-validation-required-message="Enter long description in English">{{ old("long_details_bn") ? old("long_details_bn") : '' }}</textarea>
                                        <div class="help-block"></div>
                                        @if ($errors->has('long_details_bn'))
                                            <div class="help-block">  {{ $errors->first('long_details_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('long_details_bn') ? ' error' : '' }}">
                                        <label for="long_details_bn" class="required">Long Description BN</label>
                                        <textarea type="text" name="long_details_bn"  class="form-control summernote_editor" placeholder="Enter long description in Bangla" required
                                                  data-validation-required-message="Enter long description in Bangla">{{ old("long_details_bn") ? old("long_details_bn") : '' }}</textarea>
                                        <div class="help-block"></div>
                                        @if ($errors->has('long_details_bn'))
                                            <div class="help-block">  {{ $errors->first('long_details_bn') }}</div>
                                        @endif
                                    </div>
{{--                                </slot>--}}

                                <div class="col-md-6">
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






