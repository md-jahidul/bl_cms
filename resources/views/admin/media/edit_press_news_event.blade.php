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
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('press-news-event.update', $pressNewsEvent->id) }}" method="POST" novalidate enctype="multipart/form-data">
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title English</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter title in English"
                                           value="{{ $pressNewsEvent->title_en }}" required data-validation-required-message="Enter title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title Bangla</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title in Bangla"
                                           value="{{ $pressNewsEvent->title_bn }}" required data-validation-required-message="Enter title in Bangla">
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
                                        <option data-alias="press_release" value="press_release" {{ $pressNewsEvent->type == "press_release" ? 'selected' : '' }}>Press Release</option>
                                        <option data-alias="news_events" value="news_events" {{ $pressNewsEvent->type == "news_events" ? 'selected' : '' }}>News and Events</option>
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('type'))
                                        <div class="help-block">  {{ $errors->first('type') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('date') ? ' error' : '' }}">
                                    <label for="date" class="required">Date</label>
                                    <input type="text" id="date" name="date" class="form-control" placeholder="YYYY-MM-DD"
                                           value="{{ $pressNewsEvent->date }}"
                                           required data-validation-required-message="Enter date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('date'))
                                        <div class="help-block">  {{ $errors->first('date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('thumbnail_image') ? ' error' : '' }}">
                                    <label for="thumbnail_image">Thumbnail Image</label>
                                    <input type="file" name="thumbnail_image" class="form-control dropify" data-height="90" placeholder="DD-MM-YYYY"
                                           data-default-file="{{ config('filesystems.file_base_url') . $pressNewsEvent->thumbnail_image }}"
                                           value="{{ old("thumbnail_image") ? old("thumbnail_image") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('thumbnail_image'))
                                        <div class="help-block">  {{ $errors->first('thumbnail_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                    <label for="alt_text_en" class="">Alt Text</label>
                                    <input type="text" id="alt_text_en" name="alt_text_en" class="form-control" placeholder="Enter alt text"
                                           value="{{ $pressNewsEvent->alt_text_en }}"
                                           required data-validation-required-message="Enter alt text">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_en'))
                                        <div class="help-block">  {{ $errors->first('alt_text_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('short_details_en') ? ' error' : '' }}">
                                    <label for="short_details_en" class="required">Short Description En</label>
                                    <textarea type="text" name="short_details_en"  class="form-control" placeholder="Enter short description in English" required rows="3"
                                              data-validation-required-message="Enter short description in English">{{ $pressNewsEvent->short_details_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_details_en'))
                                        <div class="help-block">  {{ $errors->first('short_details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('short_details_bn') ? ' error' : '' }}">
                                    <label for="short_details_bn" class="required">Short Description BN</label>
                                    <textarea type="text" name="short_details_bn"  class="form-control" placeholder="Enter short description in Bangla" required rows="3"
                                              data-validation-required-message="Enter short description in Bangla">{{ $pressNewsEvent->short_details_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_details_bn'))
                                        <div class="help-block">  {{ $errors->first('short_details_bn') }}</div>
                                    @endif
                                </div>

{{--                                <slot id="press_release" data-offer-type="press_release" class="{{ $pressNewsEvent->type == "press_release" ? '' : 'd-none' }}">--}}
                                    <h5><strong>Pop Up Section</strong></h5>
                                    <div class="form-actions col-md-12 mt-0"></div>

                                    <div class="form-group col-md-6 {{ $errors->has('details_image') ? ' error' : '' }}">
                                        <label for="details_image" class="required">Pop Up Banner Image</label>
                                        <input type="file" name="details_image" class="form-control dropify" data-height="90"
                                               data-default-file="{{ config('filesystems.file_base_url') . $pressNewsEvent->details_image }}"
                                               value="{{ old("details_image") ? old("details_image") : '' }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('details_image'))
                                            <div class="help-block">  {{ $errors->first('details_image') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('details_alt_text_en') ? ' error' : '' }}">
                                        <label for="details_alt_text_en" class="">Alt Text</label>
                                        <input type="text" id="details_alt_text_en" name="details_alt_text_en" class="form-control" placeholder="Enter alt text"
                                               value="{{ $pressNewsEvent->details_alt_text_en }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('details_alt_text_en'))
                                            <div class="help-block">  {{ $errors->first('details_alt_text_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('long_details_bn') ? ' error' : '' }}">
                                        <label for="long_details_bn" class="required">Long Description En</label>
                                        <textarea type="text" name="long_details_en" class="form-control summernote_editor" placeholder="Enter long description in English" required
                                                  data-validation-required-message="Enter long description in English">{{ $pressNewsEvent->long_details_en }}</textarea>
                                        <div class="help-block"></div>
                                        @if ($errors->has('long_details_bn'))
                                            <div class="help-block">  {{ $errors->first('long_details_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('long_details_bn') ? ' error' : '' }}">
                                        <label for="long_details_bn" class="required">Long Description BN</label>
                                        <textarea type="text" name="long_details_bn"  class="form-control summernote_editor" placeholder="Enter long description in Bangla" required
                                                  data-validation-required-message="Enter long description in Bangla">{{ $pressNewsEvent->long_details_bn }}</textarea>
                                        <div class="help-block"></div>
                                        @if ($errors->has('long_details_bn'))
                                            <div class="help-block">  {{ $errors->first('long_details_bn') }}</div>
                                        @endif
                                    </div>
{{--                                </slot>--}}

                                <div class="col-md-6 mt-1">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" {{ $pressNewsEvent->status == 1 ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>
                                        <input type="radio" name="status" value="0" id="inactive" {{ $pressNewsEvent->status == 0 ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
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
