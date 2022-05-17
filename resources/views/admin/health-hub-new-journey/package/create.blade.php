@extends('layouts.admin')
@section('title', 'Create Health Hub Package')
@section('card_name', 'Create Health Hub Package')
@section('breadcrumb')
    <li class="breadcrumb-item active">Create Health Hub Package</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('health-hub-feature-package.store') }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="title" class="required">Title English</label>
                                        <input class="form-control"
                                               name="title_en"
                                               id="title_en"
                                               placeholder="Enter English Title"
                                               required>
                                        @if($errors->has('title_en'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title_en') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title" class="required">Title Bangla</label>
                                        <input class="form-control"
                                               name="title_bn"
                                               id="title_bn"
                                               placeholder="Enter Bangla Title"
                                               required>
                                        @if($errors->has('title_bn'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title_bn') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="callback_url" class="required">Callback Url</label>
                                        <input class="form-control"
                                               name="callback_url"
                                               id="callback_url"
                                               placeholder="Enter Callback Url"
                                               required>
                                        @if($errors->has('sub_title_bn'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('sub_title_bn') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="redirect_url" class="required">Redirect Url</label>
                                        <input class="form-control"
                                               name="redirect_url"
                                               id="redirect_url"
                                               placeholder="Enter Redirect Url"
                                               required>
                                        @if($errors->has('redirect_url'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('redirect_url') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="health_hub_partner_id" class="required">Partner</label>
                                        <select id="health_hub_partner_id" name="health_hub_partner_id" required
                                                class="browser-default custom-select product-list">
                                            <option value="">Select Partner</option>
                                            @foreach ($partners as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('health_hub_partner_id'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('health_hub_partner_id') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="health_hub_plan_id" class="required">Plan</label>
                                        <select id="health_hub_plan_id" name="health_hub_plan_id" required
                                                class="browser-default custom-select product-list">
                                            <option value="">Select Plan</option>
                                            @foreach ($plans as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->title_en }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('health_hub_plan_id'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('health_hub_plan_id') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                <div class="col-md-6" id="content_div">
                                    <div class="form-group">
                                        <label class="required">Service Logo</label>
                                        <input type="file"
                                               name="logo"
                                                data-max-file-size="2M"
                                                data-allowed-file-extensions="jpeg png jpg"
                                                required
                                               class="dropify"/>
                                    </div>
                                    @if($errors->has('content_div'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('content_div') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eventInput3">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" >Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="details_en" >Package Details (EN):</label>
                                    <textarea
                                    required
                                    data-validation-required-message="Description (EN) is required"
                                    class="form-control @error('details_en') is-invalid @enderror" placeholder="Enter body description....." id="details_en" name="details_en" rows="10">@if(old('body')){{old('body')}}@endif</textarea>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('details_en') {{ $message }} @enderror </small>
                                </div>
                                <div class="col-md-6">
                                    <label for="details_bn" >Package Details (BN):</label>
                                    <textarea
                                    required
                                    data-validation-required-message="Description (BN) is required"
                                    class="form-control @error('details_bn') is-invalid @enderror" placeholder="Enter body description....." id="details_bn" name="details_bn" rows="10">@if(old('body')){{old('body')}}@endif</textarea>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('details_bn') {{ $message }} @enderror </small>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="ft-save"></i> Save
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/weekday-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('app-assets/js/recurring-schedule/recurring.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    {{--    <script src="{{ asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>--}}
    {{--    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
    <script>

        $(function () {

            function initiateDropify(selector) {
                $(selector).dropify({
                    messages: {
                        'default': 'Browse for an Image to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct Image file'
                    }
                });
            }

            function initiateSummernote(selector) {
                $(selector).summernote({
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['table', ['table']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['fullscreen']]
                    ],
                    height: 300
                });
            }

            function initiateImage() {
                let html = `<div class="form-group">
                                 <label class="required">Image</label>
                                 <input type="file"
                                               required
                                               name="content_data"
                                               data-max-file-size="2M"
                                               data-allowed-formats="portrait square"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               class="dropify"/>
                              </div>`;
                $("#content_div").html(html);
                initiateDropify('.dropify');
            }

            function initiatePurchaseImage() {
                let html = `<div class="form-group">
                                 <label class="required">Image</label>
                                 <input type="file"
                                               required
                                               name="content_data"
                                               data-allowed-formats="portrait square landscape"
                                               data-max-file-size="2M"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               class="dropify"/>
                              </div>`;
                $("#content_div").html(html);
                initiateDropify('.dropify');
            }

            function initiateTextEditor() {
                let html = `<div class="form-group">
                                    <label for="html_content" class="required">Content</label>
                                    <textarea id="html_content" name="content_data" required></textarea>
                             </div>`;
                $("#content_div").html(html);

                initiateSummernote('#html_content');
            }

            initiateDropify('.dropify');

            product_html = ` <div class="form-group other-info-div">
                                        <label>Select a product</label>
                                        <select class="product-list form-control"  name="product_code" required></select>
                                        <div class="help-block"></div>
                                    </div>`;

        })
    </script>
@endpush







