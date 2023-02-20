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
                            action="{{route('health-hub-feature-package.update',$package->id)}}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="title" class="required">Title English</label>
                                        <input class="form-control"
                                               name="title_en"
                                               id="title_en"
                                               value="{{ $package->title_en }}"
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
                                               value="{{ $package->title_bn }}"
                                               required>
                                        @if($errors->has('title_bn'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title_bn') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="subscription_url" class="required">Subscription Url</label>
                                        <input class="form-control"
                                               name="subscription_url"
                                               id="subscription_url"
                                               value="{{ $package->subscription_url }}"
                                               required>
                                        @if($errors->has('subscription_url'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('subscription_url') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="callback_url" class="required">Callback Url</label>
                                        <input class="form-control"
                                               name="callback_url"
                                               id="callback_url"
                                               value="{{ $package->callback_url }}"
                                               required>
                                        @if($errors->has('sub_title_bn'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('sub_title_bn') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="health_hub_partner_id" class="required">Partner</label>
                                        <select id="health_hub_partner_id" name="health_hub_partner_id" required
                                                class="browser-default custom-select product-list">
                                            <option value="">Select Partner</option>
                                            @foreach ($partners as $key => $value)
                                                <option value="{{ $value->id }}" {{ $package->partner->id == $value->id ? 'selected': "" }}>{{ $value->name_en }}</option>
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
                                                <option value="{{ $value->id }}" {{ $package->plan->id == $value->id ? "selected" : ""}}>{{ $value->title_en }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('health_hub_plan_id'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('health_hub_plan_id') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="package_id" class="required">Package ID</label>
                                        <input class="form-control"
                                               name="package_id"
                                               id="package_id"
                                               value="{{ $package->package_id }}"
                                               placeholder="Enter Package ID"
                                               required>
                                        @if($errors->has('package_id'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('package_id') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="eventInput3">Select Customer</label>
                                            <select name="allowed_customer" class="form-control" required>
                                                <option value="" >Select Customer Type</option>
                                                <option value="all" {{$package->allowed_customer=='all' ? 'selected':''}}>All Customer</option>
                                                <option value="loyalty_customer" {{$package->allowed_customer=='loyalty_customer' ? 'selected':''}}>Only For Loyalty Customer</option>
                                                <option value="non_loyalty_customer" {{$package->allowed_customer=='non_loyalty_customer' ? 'selected':''}}>Non Loyalty Customer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" class="required">
                                            <label for="eventInput3">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1" {{$package->status=='1' ? 'selected':''}}>Active</option>
                                                <option value="0" {{$package->status=='0' ? 'selected':''}}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="content_div">
                                        <div class="form-group">
                                            <label class="required">Service Logo</label>
                                            <input type="file"
                                                name="logo"
                                                    data-max-file-size="2M"
                                                    data-default-file="{{ url('storage/' .$package->logo) }}"
                                                    data-allowed-file-extensions="jpeg png jpg"
                                                class="dropify"/>
                                        </div>
                                        @if($errors->has('content_div'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('content_div') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="details_en" class="required">
                                            Description  EN
                                        </label>
                                        <textarea id="terms-conditions" name="details_en" required>
                                        @if(isset($package->details_en))
                                                {{ $package->details_en }}
                                            @endif
                                            </textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="details_bn" class="required">Description  BN</label>
                                        <textarea id="terms-conditions" name="details_bn" required>
                                        @if(isset($package->details_bn))
                                                {{ $package->details_bn }}
                                            @endif
                                            </textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success mt-2">
                                        <i class="ft-save"></i> Update
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
        $(function () {
            console.log("test");
            $("textarea#terms-conditions").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']]
                ],
                height:300
            })
        });

    </script>
@endpush







