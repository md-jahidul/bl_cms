@extends('layouts.admin')
@section('title', 'Create Feed Category')
@section('card_name',"Feed Category" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Create Feed Category</li>
@endsection
@section('action')
    <a href="{{route('feeds.categories.index')}}" class="btn btn-primary btn-glow px-2">
        Back To Category list
    </a>
@endsection

@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-header">
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements"></div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">

                    <div class="card-body">
                        <form novalidate class="form row" action="{{route('feeds.categories.store')}}" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="parent">Parent</label>
                                        <select id="parent" name="parent_id"
                                                class="browser-default custom-select">
                                            <option value="">--None--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title" class="required">Name:</label>
                                        <input                                            value="@if(old('name')) {{old('name')}} @endif" required id="title"
                                            type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Name" name="name">
                                        <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="order">Order: </label>
                                        <input required min="1"
                                            value="@if(old('order')) {{old('order')}} @else{{1}}@endif" id="order"
                                            type="number" class="form-control @error('order') is-invalid @enderror"
                                            placeholder="Order" name="order">
                                        <small class="text-danger"> @error('order') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="col-6">
                                        <div style="margin-top: 25px" class="form-group {{ $errors->has('status') ? ' error' : '' }}">

                                            <input type="radio" name="status" value="1" id="input-radio-15"
                                                   checked>
                                            <label for="input-radio-15" class="mr-3">Active</label>
                                            <input type="radio" name="status" value="0" id="input-radio-16">
                                            <label for="input-radio-16" class="mr-3">Inactive</label>

                                            @if ($errors->has('status'))
                                                <div class="help-block">  {{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button style="float: right" type="submit" id="submitForm"
                                                class="btn btn-success round px-2">
                                            <i class="la la-check-square-o"></i> Submit
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
@endsection

@push('style')

@endpush
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
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
                                        <input type="text" name="other_attributes" class="form-control" value="${content}" placeholder="Enter Valid Number" required>
                                        <div class="help-block"></div>
                                    </div>`;

            url_html = ` <div class="form-group other-info-div">
                                        <label>Redirect External URL</label>
                                        <input type="text" name="other_attributes" class="form-control" value="${content}" placeholder="Enter Valid URL" required>
                                        <div class="help-block"></div>
                                    </div>`;
            product_html = ` <div class="form-group other-info-div">
                                        <label>Select a product</label>
                                        <select class="product-list form-control"  name="other_attributes" required></select>
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
                        ajax: {
                            url: "{{ route('myblslider.active-products') }}",
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


        })
    </script>

@endpush
