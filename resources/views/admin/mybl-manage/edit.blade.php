@extends('layouts.admin')
@section('title', 'Explore Item Create')
@section('card_name', 'Explore Item Create')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('manage-category.index') }}">Category List</a></li>
    <li class="breadcrumb-item active">
        <a href="{{ route("mybl-manage-items.index", $manageCategory->id) }}">{{ $manageCategory->title_en }}</a>
    </li>

    <li class="breadcrumb-item active">Create</li>
@endsection
@section('action')
    <a href="{{ route("mybl-manage-items.index", $manageCategory->id) }}"
       class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('mybl-manage-items.update', [$manageCategory->id, $item->id]) }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="mt-0">
                                    <h4>Item Create For {{ ucfirst($manageCategory->type) }} Category</h4>
                                </div><hr>
                                <div class="offset-2">
                                    <div class="col-md-10 row">
                                        <div class="form-group col-md-12 {{ $errors->has('type') ? ' error' : '' }}">
                                            <label for="title" class="required">Choose User Type</label><hr class="mt-0">
                                            <div class="row skin skin-square">
                                                <div class="col-md-4 col-sm-12">
                                                    <input type="radio" name="type" value="all" id="all"
                                                        {{ $item->type == "all" ? 'checked' : '' }}>
                                                    <label for="all">All</label>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <input type="radio" name="type" value="prepaid" id="prepaid"
                                                        {{ $item->type == "prepaid" ? 'checked' : '' }}>
                                                    <label for="prepaid">Prepaid</label>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <input type="radio" name="type" value="postpaid" id="postpaid"
                                                    {{ $item->type == "postpaid" ? 'checked' : '' }}>
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
                                                   value="{{ $item->title_en }}" required
                                                   data-validation-required-message="Enter menu english label">
                                            <div class="help-block"></div>
                                            @if ($errors->has('title_en'))
                                                <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                            <label for="title" class="required">CTA Name BN</label>
                                            <input type="text" name="title_bn"  class="form-control" placeholder="Enter label in Bangla"
                                                   value="{{ $item->title_bn }}"
                                                   required data-validation-required-message="Enter label in Bangla">
                                            <div class="help-block"></div>
                                            @if ($errors->has('title_bn'))
                                                <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                            @endif
                                        </div>

                                        @if($manageCategory->type == "slider")
                                            <div class="form-group col-md-6 mb-2" id="slider_type">
                                                <label for="redirect_url" class="required">Slider Type</label>
                                                <input type="text" name="slider_type"  class="form-control"
                                                       placeholder="Enter label in Bangla"
                                                       value="{{ $item->other_info['slider_type'] }}" readonly>
                                                <div class="help-block"></div>
                                            </div>
                                        @endif

                                        @php
                                           $videoType = isset($item->other_info['slider_type']) && $item->other_info['slider_type'] == 'video' ? true : false;
                                        @endphp

                                        @if($videoType)
                                            <div id="video" class="form-group col-md-6 {{ $item->other_info['slider_type'] == 'video' ? 'show' : 'hidden' }}">
                                                <label for="title">Video Link</label>
                                                <input type="text" name="other_info[content]"  class="form-control"
                                                       placeholder="Enter video link" value="{{ $item->other_info['content'] }}">
                                                <div class="help-block"></div>
                                            </div>
                                        @endif

                                        <!--Image Filed-->
                                        <div id="image" class="form-group col-md-12 {{ $errors->has('icon') ? ' error' : '' }} {{ $videoType ? 'hidden' : 'show' }}">
                                            <label for="alt_text">{{ $manageCategory->type == "slider" ? 'Image' : 'Icon' }}</label>
                                            <div class="custom-file">
                                                <input type="file" name="image_url" class="custom-file-input dropify" data-height="80"
                                                       data-default-file="{{ asset($item->image_url) }}">
                                            </div>
                                            {{-- <span class="text-primary">Please given file type (.png, .jpg)</span>--}}
                                            <div class="help-block"></div>
                                            @if ($errors->has('icon'))
                                                <div class="help-block">  {{ $errors->first('icon') }}</div>
                                            @endif
                                        </div>

                                        @if($manageCategory->type != "game")
                                            <div class="form-group col-md-12 {{ $videoType ? 'hidden' : 'show' }}" id="cta_action">
                                                <label for="redirect_url">CTA Action</label>
                                                <select id="navigate_action" name="component_identifier"
                                                        class="browser-default custom-select">
                                                    <option value="">Select Action</option>
                                                    @foreach ($actionList as $key => $value)
                                                        <option value="{{ $key }}" {{ $item->component_identifier == $key ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div id="append_div" class="col-md-12 {{ $videoType ? 'hidden' : 'show' }}">
                                                @if($info = $item->other_info)
                                                    <div class="form-group other-info-div">
                                                        @if($item->component_identifier == "DIAL")
                                                            <label> Dial Number</label>
                                                            <input type="text" name="other_info[content]" class="form-control" required
                                                                   value="@if($info) {{$info['content']}} @endif">
                                                        @endif
                                                        @if($item->component_identifier == "URL")
                                                            <label>Redirect URL</label>
                                                            <input type="text" name="other_info[content]" class="form-control" required
                                                                   value="@if($info) {{$info['content']}} @endif">
                                                        @endif
                                                        @if($item->component_identifier == "PURCHASE")
                                                            <label>Linked Product</label>
                                                            <select name="other_info[content]" class="form-control select2" required>
                                                                <option value="">Select a Product</option>
                                                                @foreach ($products as $value)
                                                                    <option value="{{ $value['id'] }}" {{ ( $value['id']  == $info['content']) ? 'selected' : '' }}>
                                                                        {{ $value['text'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                        <div class="help-block"></div>
                                                    </div>
                                                @endif
                                                {{--                                                    @endif--}}
                                            </div>
                                        @endif

                                        @if($manageCategory->type == "service")
                                            <div class="form-group col-md-12 mb-2">
                                                <label for="redirect_url">Deeplink Action</label>
                                                <select id="deeplink_action" name="deep_link_slug"
                                                        class="browser-default custom-select">
                                                    <option value="">Select Action</option>
                                                    @foreach ($deeplinkActions as $key => $value)
                                                        <option value="{{ $key }}" {{ $item->deep_link_slug == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block"></div>
                                            </div>

                                            <div class="col-md-6 skin skin-square">
                                                <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                                    <input type="checkbox" name="show_for_guest" value="1" id="show_for_guest"
                                                    {{ $item->show_for_guest == 1 ? 'checked' : '' }}>
                                                    <label for="show_for_guest">Show For Guest</label>
                                                </div>
                                            </div>
                                        @endif


                                        @if($manageCategory->type == "game")
                                            <input type="hidden" name="component_identifier" value="game">
                                            <div class="form-group col-md-12">
                                                <label for="title" class="required">Redirection Link</label>
                                                <input type="text" name="other_info[content]"  class="form-control" placeholder="Enter label in Bangla"
                                                       value="{{ $item->other_info['content'] }}">
                                                <div class="help-block"></div>
                                            </div>
                                        @endif
                                        <div class="form-group col-md-6 {{ $errors->has('deeplink') ? ' error' : '' }}">
                                            <label for="deeplink" >Deeplink</label>
                                            <input type="text" name="deeplink"  class="form-control" placeholder="Enter Deeplink"
                                                   value="{{ $item->deeplink ??  '' }}"
                                            >
                                            <div class="help-block"></div>
                                            @if ($errors->has('deeplink'))
                                                <div class="help-block">  {{ $errors->first('deeplink') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="required mr-1">Status:</label>
                                                <input type="radio" name="status" value="1"
                                                       id="active" {{ $item->status == 1 ? 'checked' : '' }}>
                                                <label for="active" class="mr-1">Active</label>

                                                <input type="radio" name="status" value="0" id="inactive"
                                                    {{ $item->status == 0 ? 'checked' : '' }}>
                                                <label for="inactive">Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="la la-check-square-o"></i> SAVE</button>
                                </div>
                                <input type="hidden" name="manage_categories_id" value="{{ $manageCategory->id }}">
                                <input type="hidden" name="category_type" value="{{ $manageCategory->type }}">
                            </div>
                            @csrf
                            @method('PUT')
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

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Excel File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
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







