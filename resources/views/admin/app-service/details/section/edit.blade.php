@extends('layouts.admin')
@section('title', 'App & Service Product Edit')
@section('card_name', 'App & Service Product Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('app-service-product.index') }}">App & Service Product List</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('app_service.details.list', [$tab_type, $product_id]) }}">Section List</a></li>
    <li class="breadcrumb-item active"> Section Edit</li>
@endsection
@section('action')
    <a href="{{ route('app-service-product.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>Product Edit</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form id="product_form" role="form" action="{{ route('app_service.details.update', [$tab_type, $product_id, $section->id]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('section_name') ? ' error' : '' }}">
                                    <label for="section_name" class="required">Section Name</label>
                                    <input type="text" name="section_name" id="section_name" class="form-control section_name" placeholder="Give section a name"
                                           value="{{ $section->section_name }}" required data-validation-required-message="This field can not be empty">
                                    <div class="help-block"></div>
                                    @if ($errors->has('section_name'))
                                        <div class="help-block">{{ $errors->first('section_name') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6 {{ $errors->has('slug') ? ' error' : '' }}">--}}
{{--                                    <label for="slug" class="required">Section Slug</label>--}}
{{--                                    <input type="text" name="slug" id="slug" class="form-control auto_slug"--}}
{{--                                           value="{{ $section->slug }}" required data-validation-required-message="This field can not be empty" readonly>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('slug'))--}}
{{--                                        <div class="help-block">{{ $errors->first('slug') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en">Title (English)</label>
                                    <input type="text" name="title_en" id="title_en" class="form-control" placeholder="Enter offer name in English"
                                           value="{{ $section->title_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">{{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn">Title (Bangla)</label>
                                    <input type="text" name="title_bn" id="title_bn" class="form-control" placeholder="Enter offer name in Bangla"
                                           value="{{ $section->title_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="category_type">Section has multiple component</label>
                                    <select class="form-control" name="multiple_component" id="multiple_component" aria-invalid="false">
                                        <option value="0" {{ $section->multiple_component == 0 ? 'selected' : "" }}>No</option>
                                        <option value="1" {{ $section->multiple_component == 1 ? 'selected' : "" }}>Yes</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" {{ $section->status == 1 ? 'checked' : "" }}>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive" {{ $section->status == 0 ? 'checked' : "" }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button id="save" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Update
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
@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/selectize/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.default.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script>
        $(function () {
            $('#offer_type').change(function () {
                var typeId = $(this).find('option:selected').val()
                var appServiceCat = $('#appServiceCat');
                $.ajax({
                    url: "{{ url('app-service/category-find') }}" + '/' + typeId,
                    success: function (data) {
                        appServiceCat.empty();
                        var option = '<option value="">---Select Category---</option>'
                        $.map(data, function (item) {
                            option += '<option data-alias="'+item.alias+'" value="'+item.id+'">'+item.title_en+'</option>'
                        })
                        appServiceCat.append(option)
                    },
                })
            })


            var fields = $("#form-fields").find("input, textarea");
            fields.val('')
        })
    </script>
@endpush


