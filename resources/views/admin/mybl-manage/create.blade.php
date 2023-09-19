@extends('layouts.admin')
@section('title', 'Explore Item Create')
@section('card_name', 'Explore Item Create')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('manage-category.index') }}">Category List</a></li>
    <li class="breadcrumb-item active">
        <a href="{{ route("mybl-manage-items.index", $parent_id) }}">{{ $parentMenu->title_en }}</a>
    </li>

    <li class="breadcrumb-item active">Create</li>
@endsection
@section('action')
    <a href="{{ route("mybl-manage-items.index", $parent_id) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('mybl-manage-items.store', $parent_id) }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="mt-0">
                                    <h4>Item Create For {{ ucfirst($parentMenu->type) }} Category</h4>
                                </div><hr>
                                <div class="offset-2">
                                    <div class="col-md-10 row">
                                        <div class="form-group col-md-12 {{ $errors->has('type') ? ' error' : '' }}">
                                            <label for="title" class="required">Choose User Type</label><hr class="mt-0">
                                            <div class="row skin skin-square">
                                                <div class="col-md-4 col-sm-12">
                                                    <input type="radio" name="type" value="all" id="all" checked>
                                                    <label for="all">All</label>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <input type="radio" name="type" value="prepaid" id="prepaid" >
                                                    <label for="prepaid">Prepaid</label>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <input type="radio" name="type" value="postpaid" id="postpaid">
                                                    <label for="postpaid">Postpaid</label>
                                                </div>
                                            </div>
                                            <div class="help-block"></div>
                                            @if ($errors->has('type'))
                                                <div class="help-block">  {{ $errors->first('type') }}</div>
                                            @endif
                                        </div>


                                        <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                            <label for="title" class="required">CTA Name EN</label>
                                            <input type="text" name="title_en"  class="form-control" placeholder="Enter english label"
                                                   value="{{ old("title_en") ? old("title_en") : '' }}" required
                                                   data-validation-required-message="Enter menu english label">
                                            <div class="help-block"></div>
                                            @if ($errors->has('title_en'))
                                                <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                            <label for="title" class="required">CTA Name BN</label>
                                            <input type="text" name="title_bn"  class="form-control" placeholder="Enter label in Bangla"
                                                   value="{{ old("title_bn") ? old("title_bn") : '' }}"
                                                   required data-validation-required-message="Enter label in Bangla">
                                            <div class="help-block"></div>
                                            @if ($errors->has('title_bn'))
                                                <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                            @endif
                                        </div>

                                        @if($parentMenu->type == "slider")
                                            <div class="form-group col-md-6 mb-2" id="slider_type">
                                                <label for="redirect_url" class="required">Slider Type</label>
                                                <select id="slider_type" name="slider_type"
                                                        class="browser-default custom-select" required>
                                                    <option value="">Select Type</option>
                                                        <option value="image">Image</option>
                                                        <option value="video">Video</option>
                                                </select>
                                                <div class="help-block"></div>
                                            </div>

                                            <div id="video" class="form-group col-md-6 hidden">
                                                <label for="title">Video Link</label>
                                                <input type="text" name="other_info[content]"  class="form-control"
                                                       placeholder="Enter video link">
                                                <div class="help-block"></div>
                                            </div>
                                        @endif

                                        <div id="image" class="form-group col-md-12 {{ $errors->has('icon') ? ' error' : '' }} {{ $parentMenu->type == "slider" ? 'hidden' : '' }}">
                                            <label for="alt_text">{{ $parentMenu->type == "slider" ? 'Image' : 'Icon' }}</label>
                                            <div class="custom-file">
                                                <input type="file" name="image_url" class="custom-file-input dropify" data-height="80">
                                            </div>
                                            {{-- <span class="text-primary">Please given file type (.png, .jpg)</span>--}}
                                            <div class="help-block"></div>
                                            @if ($errors->has('icon'))
                                                <div class="help-block">  {{ $errors->first('icon') }}</div>
                                            @endif
                                        </div>

                                        @if($parentMenu->type != "game")
                                            <div class="form-group col-md-12 mb-2" id="cta_action">
                                                <label for="redirect_url">CTA Action</label>
                                                <select id="navigate_action" name="component_identifier"
                                                        class="browser-default custom-select">
                                                    <option value="">Select Action</option>
                                                    @foreach ($actionList as $key => $value)
                                                        <option value="{{ $key }}">
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                            <!--Element Append -->
                                            <div id="append_div" class="col-md-12"></div>
                                        @endif

                                        @if($parentMenu->type == "service")
                                            @php
                                                $deeplinkActions = Helper::deepLinkList();
                                            @endphp

                                            <div class="form-group col-md-12 mb-2">
                                                <label for="redirect_url">Deeplink Action</label>
                                                <select id="deeplink_action" name="deep_link_slug"
                                                        class="browser-default custom-select">
                                                    <option value="">Select Action</option>
                                                    @foreach ($deeplinkActions as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block"></div>
                                            </div>

                                            <div class="col-md-6 skin skin-square">
                                                <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                                    <input type="checkbox" name="show_for_guest" value="1" id="show_for_guest">
                                                    <label for="show_for_guest">Show For Guest</label>
                                                </div>
                                            </div>
                                        @endif

                                        @if($parentMenu->type == "game")
                                            <input type="hidden" name="component_identifier" value="game">
                                            <div class="form-group col-md-12">
                                                <label for="title" class="required">Redirection Link</label>
                                                <input type="text" name="other_info[content]"  class="form-control" placeholder="Enter label in Bangla"
                                                       value="{{ old("title_bn") ? old("title_bn") : '' }}">
                                                <div class="help-block"></div>
                                            </div>
                                        @endif
                                        <div class="form-group col-md-6 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                            <label for="title" class="">Android Version Code</label>
                                            <input type="text" name="android_version_code"  class="form-control" placeholder="Enter Version Code">
                                            <div class="help-block"></div>
                                            <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                            <div class="help-block"></div>
                                            @if ($errors->has('android_version_code'))
                                                <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                                            <label for="title" class="">iOS Version Code</label>
                                            <input type="text" name="ios_version_code"  class="form-control" placeholder="Enter Version Code">
                                            <div class="help-block"></div>
                                            <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                            <div class="help-block"></div>
                                            @if ($errors->has('ios_version_code'))
                                                <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 {{ $errors->has('deeplink') ? ' error' : '' }}">
                                            <label for="deeplink" >Deeplink</label>
                                            <input type="text" name="deeplink"  class="form-control" placeholder="Enter Deeplink"
                                                   value="{{ old("deeplink") ? old("deeplink") : '' }}"
                                                   >
                                            <div class="help-block"></div>
                                            @if ($errors->has('deeplink'))
                                                <div class="help-block">  {{ $errors->first('deeplink') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                                <label for="title" class="required mr-1">Status:</label>

                                                <input type="radio" name="status" value="1" id="input-radio-15" checked>
                                                <label for="input-radio-15" class="mr-1">Active</label>

                                                <input type="radio" name="status" value="0" id="input-radio-16">
                                                <label for="input-radio-16">Inactive</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="la la-check-square-o"></i> SAVE</button>
                                </div>
                                <input type="hidden" name="manage_categories_id" value="{{ $parent_id }}">
                                <input type="hidden" name="category_type" value="{{ $parentMenu->type }}">
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
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script>

        $(function () {
            $("select[name=slider_type]").change(function () {
                if ($(this).val() === "image") {
                    $("#image").addClass('show').removeClass('hidden');
                    $("#cta_action").addClass('show').removeClass('hidden');
                    $("#video").addClass('hidden').removeClass('show');
                } else {
                    $("#cta_action").addClass('hidden').removeClass('show');
                    $("#image").addClass('hidden').removeClass('show');
                    $("#video").addClass('show').removeClass('hidden');
                }
            });

            $(function () {
                var content = "";
                var url_html;
                var product_html;
                var parse_data;
                let dial_html, other_attributes = '';
                var js_data = '<?php echo isset($imageInfo) ? json_encode($imageInfo) : null; ?>';

                if (js_data) {
                    parse_data = JSON.parse(js_data);
                    other_attributes = parse_data.other_attributes;
                    if (other_attributes) {
                        content = other_attributes.content;
                    }
                }
                // add dial number
                dial_html = ` <div class="form-group other-info-div">
                                            <label>Dial Number</label>
                                            <input type="text" name="other_info[content]" class="form-control" value="${content}" placeholder="Enter Valid Number" required>
                                            <div class="help-block"></div>
                                        </div>`;
                url_html = ` <div class="form-group other-info-div">
                                            <label>Redirect External URL</label>
                                            <input type="text" name="other_info[content]" class="form-control" value="${content}" placeholder="Enter Valid URL" required>
                                            <div class="help-block"></div>
                                        </div>`;
                product_html = ` <div class="form-group other-info-div">
                                            <label>Select a product</label>
                                            <select class="product-list form-control"  name="other_info[content]" required></select>
                                            <div class="help-block"></div>
                                        </div>`;
                $('#navigate_action').on('change', function () {
                    let action = $(this).val();
                    console.log(action);
                    if (action == 'DIAL') {
                        $("#append_div").html(dial_html);
                    } else if (action == 'URL') {
                        $("#append_div").html(url_html);
                    } else if (action == 'PURCHASE') {
                        $("#append_div").html(product_html);
                        $(".product-list").select2({
                            placeholder: "Select a product",
                            // minimumInputLength: 3,
                            allowClear: true,
                            selectOnClose: true,
                            ajax: {
                                url: "{{ route('myblslider.active-products') }}",
                                dataType: 'json',
                                data: function (params) {
                                    var query = {
                                        productCode: params.term
                                    }
                                    // Query parameters will be ?search=[term]&type=public
                                    return query;
                                },
                                processResults: function (data) {
                                    // Transforms the top-level key of the response object from 'items' to 'results'
                                    return {
                                        results: data
                                    };
                                }
                            }
                        });
                    } else {
                        $(".other-info-div").remove();
                    }
                })
            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
            $("#navigate_action").select2();
            $("#deeplink_action").select2();
        })
    </script>
@endpush







