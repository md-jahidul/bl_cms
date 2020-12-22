@extends('layouts.admin')
@section('title', 'App & Service Product Edit')
@section('card_name', 'App & Service Product Edit')
@section('breadcrumb')
<li class="breadcrumb-item active"><a href="{{ route('app-service-product.index') }}">App & Service Product List</a></li>
<li class="breadcrumb-item active"> App & Service Product Edit</li>
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
                    <form id="product_form" role="form" action="{{ route('app-service-product.update', $appServiceProduct->id) }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="form-group col-md-6 {{ $errors->has('app_service_tab_id') ? ' error' : '' }}">
                                <label for="app_service_tab_id" class="required">App & Service Type</label>
                                <select class="form-control required" id="offer_type"
                                        required data-validation-required-message="Please select type" readonly disabled>
                                    <option data-alias="" value="">---Select Type---</option>
                                    @foreach($appServiceTabs as $tab)
                                    <option data-alias="{{ $tab->alias }}" value="{{ $tab->id }}" {{ ($tab->id == $appServiceProduct->app_service_tab_id ) ? 'selected' : '' }}>{{ $tab->name_en }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block"></div>
                                @if ($errors->has('app_service_tab_id'))
                                <div class="help-block">{{ $errors->first('app_service_tab_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tag_category_id" class="required">Category</label>
                                <select class="form-control" name="app_service_cat_id" id="appServiceCat"
                                        required data-validation-required-message="Please select category">
                                    <option data-alias="" value="">---Select Category---</option>
                                    @foreach($appServiceCategory as $category)
                                    <option data-alias="{{ $category->alias }}" value="{{ $category->id }}" {{ ($category->id == $appServiceProduct->app_service_cat_id ) ? 'selected' : '' }}>{{ $category->title_en }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block"></div>
                                @if ($errors->has('app_service_cat_id'))
                                <div class="help-block">{{ $errors->first('app_service_cat_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                <label for="name_en">Offer Title (English)</label>
                                <input type="text" name="name_en" id="name_en" class="form-control" placeholder="Enter offer name in English"
                                       value="{{ $appServiceProduct->name_en }}">
                                <div class="help-block"></div>
                                @if ($errors->has('name_en'))
                                <div class="help-block">{{ $errors->first('name_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                <label for="name_bn">Offer Title (Bangla)</label>
                                <input type="text" name="name_bn" id="name_bn" class="form-control" placeholder="Enter offer name in Bangla"
                                       value="{{ $appServiceProduct->name_bn }}">
                                <div class="help-block"></div>
                                @if ($errors->has('name_bn'))
                                <div class="help-block">{{ $errors->first('name_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="description_en">Description (English)</label>
                                <textarea type="text" name="description_en" class="form-control text_editor" placeholder="Enter description in English"
                                          >{{ $appServiceProduct->description_en }}</textarea>
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="description_bn">Description (Bangla)</label>
                                <textarea type="text" name="description_bn" class="form-control text_editor" placeholder="Enter description in Bangla"
                                          >{{ $appServiceProduct->description_bn }}</textarea>
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                <label for="start_date">Start Date</label>
                                <div class='input-group'>
                                    <input type='text' class="form-control" name="start_date" id="start_date"
                                           value="{{ $appServiceProduct->start_date }}" placeholder="Please select start date" />
                                </div>
                                <div class="help-block"></div>
                                @if ($errors->has('start_date'))
                                <div class="help-block">{{ $errors->first('start_date') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                <label for="end_date">End Date</label>
                                <input type="text" name="end_date" id="end_date" class="form-control"
                                       placeholder="Please select end date"
                                       value="{{ $appServiceProduct->end_date }}" autocomplete="0">
                                <div class="help-block"></div>
                                @if ($errors->has('end_date'))
                                <div class="help-block">{{ $errors->first('end_date') }}</div>
                                @endif
                            </div>


                            <slot id="app" data-offer-type="app" class="{{ $appServiceProduct->appServiceTab->alias == 'app' ? '' : 'd-none' }}">
                                @include('layouts.partials.app-service.app')
                            </slot>

                            <slot id="vas" data-offer-type="vas" class="{{ $appServiceProduct->appServiceTab->alias == 'vas' ? '' : 'd-none' }}">
                                @include('layouts.partials.app-service.vas')
                            </slot>

                            <slot id="financial" data-offer-type="financial" class="{{ $appServiceProduct->appServiceTab->alias == 'financial' ? '' : 'd-none' }}">
                                @include('layouts.partials.app-service.financial')
                            </slot>

                              <div class="col-md-6">
                                <label></label>
                                <div class="form-group">
                                    <label for="title" class="mr-1">Status:</label>
                                    <input type="radio" name="status" value="1" id="active" {{ ($appServiceProduct->status == 1) ? 'checked' : '' }}>
                                    <label for="active" class="mr-1">Active</label>

                                    <input type="radio" name="status" value="0" id="inactive" {{ ($appServiceProduct->status == 0) ? 'checked' : '' }}>
                                    <label for="inactive">Inactive</label>
                                </div>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                <label> URL (url slug) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$appServiceProduct->url_slug}}" required name="url_slug" placeholder="URL">
                                <small class="text-info">
                                    <strong>i.e:</strong> najat-app (no spaces)<br>
                                </small>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Page Header (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header">{{$appServiceProduct->page_header}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('page_header_bn') ? ' error' : '' }}">
                                <label>Page Header (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header_bn">{{$appServiceProduct->page_header_bn}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Schema Markup</label>
                                <textarea class="form-control" rows="7" name="schema_markup">{{$appServiceProduct->schema_markup}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>



                            <div class="form-actions col-md-12">
                                <div class="pull-right">
                                    <button id="save" class="btn btn-primary"><i
                                            class="la la-check-square-o"></i> Save
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
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
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
<script src="{{ asset('js/custom-js/image-show.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
<script>
$(function () {
    var date = new Date();
    date.setDate(date.getDate());
    $('#start_date').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        showClose: true,
    });
    $('#end_date').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        useCurrent: false, //Important! See issue #1075
        showClose: true,

    });

    $('#offer_type').change(function () {
        var typeId = $(this).find('option:selected').val()
        var appServiceCat = $('#appServiceCat');
        $.ajax({
            url: "{{ url('app-service/category-find') }}" + '/' + typeId,
            success: function (data) {
                appServiceCat.empty();
                var option = '<option value="">---Select Category---</option>';
                $.map(data, function (item) {
                    option += '<option data-alias="' + item.alias + '" value="' + item.id + '">' + item.title_en + '</option>'
                })
                appServiceCat.append(option)
            },
        });
    });

    $(".app_review, .app_rating").on("keypress keyup blur", function (event) {
        var max_chars = 10;
        if($(this).val().length > max_chars){
           $(this).val($(this).val().substr(0, max_chars));
        }

        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    //text editor for package details
    $("textarea.text_editor").summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            // ['table', ['table']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview']]
        ],
        height: 200
    });


    var fields = $("#form-fields").find("input, textarea");
    fields.val('');
});
</script>
@endpush


