@extends('layouts.admin')
@section('title', 'Menu Edit')
@section('card_name', 'Menu Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('mybl-menu') }}">Menu</a></li>
    @if($menu->parent_id != 0)
        <li class="breadcrumb-item active">
            <a href="{{ ($menu->parent_id == 0) ? url('mybl-menu') : url("mybl-menu/$menu->parent_id/child-menu") }}">{{ $menu->title_en }}</a>
        </li>
    @endif
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('action')
    <a href="{{ $menu->parent_id == 0 ? url('mybl-menu') : url("mybl-menu/$menu->parent_id/child-menu") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('mybl-menu.update', $menu->id) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="offset-2">
                                    @if($menu->parent_id == 0)

                                        <div class="form-group col-md-10 {{ $errors->has('content_for') ? ' error' : '' }}">
                                            <label for="title" class="required">Content For</label><hr class="mt-0">
                                            <div class="row skin skin-square">
                                                <div class="col-md-4 col-sm-12">
                                                    <input type="radio" name="content_for" value="bl" @if($menu->content_for == 'bl') {{ 'checked' }} @endif>
                                                    <label for="content_for">Banglalink User</label>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <input type="radio" name="content_for" value="non-bl" @if($menu->content_for == 'non-bl') {{ 'checked' }} @endif>
                                                    <label for="content_for">Non Banglalink User</label>
                                                </div>
                                            </div>
                                            <div class="help-block"></div>
                                            @if ($errors->has('content_for'))
                                                <div class="help-block">  {{ $errors->first('content_for') }}</div>
                                            @endif
                                        </div>

                                    @endif

                                    <div class="form-group col-md-12 {{ $errors->has('type') ? ' error' : '' }}">
                                        <label for="title" class="required">Choose User Type</label><hr class="mt-0">
                                        <div class="row skin skin-square">
                                            <div class="col-md-4 col-sm-12">
                                                <input type="radio" name="type" value="all" id="all"
                                                    {{ $menu->type == "all" ? 'checked' : '' }}>
                                                <label for="all">All</label>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <input type="radio" name="type" value="prepaid" id="prepaid"
                                                    {{ $menu->type == "prepaid" ? 'checked' : '' }}>
                                                <label for="prepaid">Prepaid</label>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <input type="radio" name="type" value="postpaid" id="postpaid"
                                                {{ $menu->type == "postpaid" ? 'checked' : '' }}>
                                                <label for="postpaid">Postpaid</label>
                                            </div>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('type'))
                                            <div class="help-block">  {{ $errors->first('type') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-10 {{ $errors->has('title_en') ? ' error' : '' }}">
                                        <label for="title" class="required">English Label</label>
                                        <input type="text" name="title_en"  class="form-control" placeholder="Enter english label"
                                               value="{{ $menu->title_en }}" required data-validation-required-message="Enter menu english label">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_en'))
                                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-10 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                        <label for="title" class="required">Bangla Label</label>
                                        <input type="text" name="title_bn"  class="form-control" placeholder="Enter label in Bangla"
                                               value="{{ $menu->title_bn }}" required data-validation-required-message="Enter label in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_bn'))
                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>

                                    @if($menu->parent_id != 0)
                                        <div class="form-group col-md-10 {{ $errors->has('icon') ? ' error' : '' }}">
                                            <label for="alt_text">Icon</label>
                                            <div class="custom-file">
                                                <input type="file" name="icon" class="custom-file-input dropify" data-height="80"
                                                       data-default-file="{{ asset($menu->icon) }}">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-10" id="cta_action">
                                            <label for="redirect_url">CTA Action</label>
                                            <select id="navigate_action" name="component_identifier"
                                                    class="browser-default custom-select">
                                                <option value="">Select Action</option>
                                                @foreach ($ctaActions as $key => $value)
                                                    <option value="{{ $key }}" {{ $menu->component_identifier == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="append_div" class="col-md-10">
                                            @if($info = $menu->other_info)
                                                <div class="form-group other-info-div">
                                                    @if($menu->component_identifier == "DIAL")
                                                        <label> Dial Number</label>
                                                        <input type="text" name="other_info[content]" class="form-control" required
                                                               value="@if($info) {{$info['content']}} @endif">
                                                    @endif
                                                    @if($menu->component_identifier == "URL")
                                                        <label>Redirect URL</label>
                                                        <input type="text" name="other_info[content]" class="form-control" required
                                                               value="@if($info) {{$info['content']}} @endif">
                                                    @endif
                                                    @if($menu->component_identifier == "PURCHASE")
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
                                        </div>

                                        <div class="form-group col-md-10 mb-2">
                                            <label for="redirect_url">Deeplink Action</label>
                                            <select id="deeplink_action" name="deep_link_slug"
                                                    class="browser-default custom-select">
                                                <option value="">Select Action</option>
                                                @foreach ($deeplinkActions as $key => $value)
                                                    <option value="{{ $key }}" {{ $menu->deep_link_slug == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    @endif

                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="title" class="required mr-1">Status:</label>

                                            <input type="radio" name="status" value="1" id="input-radio-15" @if($menu->status == 1) {{ 'checked' }} @endif>
                                            <label for="input-radio-15" class="mr-1">Active</label>

                                            <input type="radio" name="status" value="0" id="input-radio-16" @if($menu->status == 0) {{ 'checked' }} @endif>
                                            <label for="input-radio-16">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-refresh"></i> Update</button>
                                </div>
                                <input type="hidden" name="parent_id" value="{{ $menu->parent_id }}">
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
@endpush
@push('page-js')
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
            $("#navigate_action").select2();
            $("#deeplink_action").select2();
        })

        $(function () {
            var content = "";
            var url_html;
            var product_html;
            var parse_data;
            let dial_html, other_attributes = '';
            var js_data = '<?php echo isset($imageInfo) ? json_encode($imageInfo) : null; ?>';
            if (js_data) {
                parse_data = JSON.parse(js_data);
                other_attributes = parse_data.other_info;
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
    </script>
@endpush






