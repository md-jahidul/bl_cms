@extends('layouts.admin')
@section('title', 'Health Hub Edit')
@section('card_name', 'Health Hub Edit')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('health-hub.index') }}">Health Hub Item List</a></li>
    <li class="breadcrumb-item active">Item Edit</li>
@endsection
@section('action')
    <a href="{{ route("health-hub.index", $healthHub->id) }}"
       class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('health-hub.update', $healthHub->id) }}"
                              method="POST" id="editForm" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="offset-2">
                                    <div class="col-md-10 row">
                                        <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                            <label for="title" class="required">CTA Name EN</label>
                                            <input type="text" name="title_en"  class="form-control" placeholder="Enter english label"
                                                   value="{{ $healthHub->title_en }}" required
                                                   data-validation-required-message="Enter menu english label">
                                            <div class="help-block"></div>
                                            @if ($errors->has('title_en'))
                                                <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                            <label for="title" class="required">CTA Name BN</label>
                                            <input type="text" name="title_bn"  class="form-control" placeholder="Enter label in Bangla"
                                                   value="{{ $healthHub->title_bn }}"
                                                   required data-validation-required-message="Enter label in Bangla">
                                            <div class="help-block"></div>
                                            @if ($errors->has('title_bn'))
                                                <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                            @endif
                                        </div>

                                        <!--Image Filed-->
                                        <div id="image" class="form-group col-md-12 {{ $errors->has('icon') ? ' error' : '' }}">
                                            <label for="alt_text">Icon</label>
                                            <div class="custom-file">
                                                <input type="file" name="icon" class="custom-file-input dropify" data-height="80"
                                                       data-default-file="{{ asset($healthHub->icon) }}"
                                                       data-max-file-size="50K"
                                                       data-allowed-file-extensions='["png", "jpg", "jpeg", "gif"]'>
                                            </div>
                                            <span class="text-primary">Please given file type (.png, .jpg, .jpeg, GIF) </span>|
                                            <span class="text-danger"> Icon upload maximum 50KB</span>
                                            <div class="help-block"></div>
                                            @if ($errors->has('icon'))
                                                <div class="help-block">  {{ $errors->first('icon') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-12" id="cta_action">
                                            <label for="redirect_url" class="required">CTA Action</label>
                                            <select id="navigate_action" name="component_identifier"
                                                    class="browser-default custom-select">
                                                <option value="">Select Action</option>
                                                @foreach ($actionList as $key => $value)
                                                    <option value="{{ $key }}" {{ $healthHub->component_identifier == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="append_div" class="col-md-12">
                                            @if($info = $healthHub->other_info)
                                                <div class="form-group other-info-div">
                                                    @if($healthHub->component_identifier == "DIAL")
                                                        <label> Dial Number</label>
                                                        <input type="text" name="other_info[content]" class="form-control" required
                                                               value="@if($info) {{$info['content']}} @endif">
                                                    @endif
                                                    @if($healthHub->component_identifier == "URL")
                                                        <label>Redirect URL</label>
                                                        <input type="text" name="other_info[content]" class="form-control" required
                                                               value="@if($info){{$info['content']}}@endif">
                                                        <span class="text-warning">Please given URL with https://</span>
                                                    @endif
                                                    @if($healthHub->component_identifier == "PURCHASE")
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
                                                    @if($healthHub->component_identifier == "FEED_CATEGORY")
                                                        <div class="form-group other-info-div">
                                                            <label>Select a Feed Category</label>
                                                            <select class="feed-cat-list form-control" name="other_info[feed_cat_slug]" required>
                                                                @foreach($feedCategories as $feedCategory)
                                                                    <option value="{{ $feedCategory->slug }}" data-id="{{ $feedCategory->id }}"
                                                                        {{ isset($healthHub->other_info['feed_cat_slug']) && $feedCategory->slug == $healthHub->other_info['feed_cat_slug'] ? 'selected' : '' }}>{{ $feedCategory->title }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    @endif
                                                    @if($healthHub->component_identifier == "FEED_CATEGORY_POST")
                                                        <div class="form-group other-info-div">
                                                            <label class="required">Feed Category</label>
                                                            <select class="feed-cat-list form-control" name="other_info[feed_cat_slug]" required>
                                                                @foreach($feedCategories as $feedCategory)
                                                                    <option value="{{ $feedCategory->slug }}" data-id="{{ $feedCategory->id }}"
                                                                        {{ isset($healthHub->other_info['feed_cat_slug']) && $feedCategory->slug == $healthHub->other_info['feed_cat_slug'] ? 'selected' : '' }}>{{ $feedCategory->title }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block"></div>
                                                        </div>

                                                        <div class="form-group other-info-div">
                                                            <label class="required">Feed Post</label>
                                                            <select class="feed-cat-post form-control" name="other_info[feed_post_id]" required>
                                                                @foreach($feedPosts as $feedPost)
                                                                    <option value="{{ $feedPost->id }}"
                                                                        {{ isset($healthHub->other_info['feed_post_id']) && $feedPost->id == $healthHub->other_info['feed_post_id'] ? 'selected' : '' }}>{{ $feedPost->title }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    @endif
                                                    <div class="help-block"></div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="required mr-1">Status:</label>
                                                <input type="radio" name="status" value="1"
                                                       id="active" {{ $healthHub->status == 1 ? 'checked' : '' }}>
                                                <label for="active" class="mr-1">Active</label>

                                                <input type="radio" name="status" value="0" id="inactive"
                                                    {{ $healthHub->status == 0 ? 'checked' : '' }}>
                                                <label for="inactive">Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="la la-check-square-o"></i> Update</button>
                                </div>
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
    <style>
        .error{
            color: red;
        }
    </style>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $("#editForm").validate();
            var content = "";
            var url_html;
            var product_html;
            var feed_category;
            var feed_category_post;
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
                                        <span class="text-warning">Please given URL with https://</span>
                                        <div class="help-block"></div>
                                    </div>`;
            product_html = ` <div class="form-group other-info-div">
                                        <label>Select a product</label>
                                        <select class="product-list form-control" name="other_info[content]" required></select>
                                        <div class="help-block"></div>
                                    </div>`;

            feed_category = ` <div class="form-group other-info-div">
                                    <label>Select a Feed Category</label>
                                    <select class="feed-cat-list form-control" name="other_info[feed_cat_slug]" required>
                                        <option value="">---Select Feed Category---</option>
                                    </select>
                                    <div class="help-block"></div>
                                </div>`;

            feed_category_post = ` <div class="form-group other-info-div">
                                        <label>Feed Category Post</label>
                                        <select class="feed-cat-post form-control" name="other_info[feed_post_id]" required>
                                        </select>
                                        <div class="help-block"></div>
                                    </div>`;

            $('#navigate_action').on('change', function () {
                let action = $(this).val();
                console.log(action);
                if (action === 'DIAL') {
                    $("#append_div").html(dial_html);
                } else if (action === 'URL') {
                    $("#append_div").html(url_html);
                } else if (action === 'FEED_CATEGORY') {
                    $("#append_div").html(feed_category);
                    $.ajax({
                        url: "{{ route('feed.data') }}",
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            res.map(function (data) {
                                $(".feed-cat-list").append("<option value="+data.id+' data-id='+data.data_id+'>'+data.text+"</option>")
                            })
                        }
                    });

                } else if (action === 'FEED_CATEGORY_POST') {
                    $(".other-info-div").remove();
                    $("#append_div").append(feed_category);
                    $("#append_div").append(feed_category_post);

                    $.ajax({
                        url: "{{ route('feed.data') }}",
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            res.map(function (data) {
                                $(".feed-cat-list").append("<option value="+data.id+' data-id='+data.data_id+'>'+data.text+"</option>")
                            })
                        }
                    });

                    // Initiate Event Feed Category
                    feedCatEvent()
                } else if (action === 'PURCHASE') {
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

            function feedCatEvent() {
                $('.feed-cat-list').change(function () {
                    $(".feed-cat-post").empty();
                    let catId = $('.feed-cat-list :selected').attr('data-id');

                    $(".feed-cat-post").select2({
                        placeholder: "Select a product",
                        // minimumInputLength: 3,
                        allowClear: true,
                        selectOnClose: true,
                        ajax: {
                            url: "{{ url('get-feed-data') }}" + "/" + catId,
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
                })
            }
            feedCatEvent()

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







