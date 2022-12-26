@extends('layouts.admin')
@section('title', 'Explore C Create')
@section('card_name', 'Explore C Tabs')
@section('breadcrumb')
<li class="breadcrumb-item active"><a href="{{ route('explore-c.index') }}">Explore C List</a></li>
<li class="breadcrumb-item active"> Explore C Create</li>
@endsection
@section('action')
<a href="{{ route('explore-c.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h5 class="menu-title"><strong>Create</strong></h5><hr>
                <div class="card-body card-dashboard">
                    <form id="product_form" role="form" action="{{ route('explore-c.store') }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                <label for="title_en" class="required">Title (English)</label>
                                <input type="text" name="title_en" id="title_en" class="form-control" placeholder="Enter explore name in English"
                                       value="{{ old("title_en") ? old("title_en") : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('title_en'))
                                <div class="help-block">{{ $errors->first('title_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                <label for="title_bn" class="required">Title (Bangla)</label>
                                <input type="text" name="title_bn" id="title_bn" class="form-control" placeholder="Enter explore name in Bangla"
                                       value="{{ old("title_bn") ? old("title_bn") : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('title_bn'))
                                <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="short_desc_en">Description (English)</label>
                                <textarea type="text" name="short_desc_en" id="vat" class="form-control summernote_editor" placeholder="Enter description in English"
                                          >{{ old("short_desc_en") ? old("short_desc_en") : '' }}</textarea>
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="short_desc_bn">Description (Bangla)</label>
                                <textarea type="text" name="short_desc_bn" id="vat" class="form-control summernote_editor" placeholder="Enter description in Bangla"
                                          >{{ old("short_desc_bn") ? old("short_desc_bn") : '' }}</textarea>
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                <label for="start_date">Start Date</label>
                                <div class='input-group'>
                                    <input type='text' class="form-control" name="start_date" id="start_date"
                                           value="{{ old("start_date") ? old("start_date") : '' }}"
                                           placeholder="Please select start date" autocomplete="off"/>
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
                                       value="{{ old("end_date") ? old("end_date") : '' }}" autocomplete="off">
                                <div class="help-block"></div>
                                @if ($errors->has('end_date'))
                                <div class="help-block">{{ $errors->first('end_date') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-6 {{ $errors->has('slug_en') ? ' error' : '' }}">
                                <label class="required"> Button URL EN</label>
                                <input type="text" class="form-control slug-convert required" name="slug_en" placeholder="URL EN" id="slug_en">
                                @if ($errors->has('slug_en'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('slug_en') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('slug_bn') ? ' error' : '' }}">
                                <label class="required"> Button URL BN </label>
                                <input type="text" class="form-control slug-convert" name="slug_bn" placeholder="URL BN">
                                @if ($errors->has('slug_bn'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('slug_bn') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('img_name_en') ? ' error' : '' }}">
                                <label for="img_name_en">Image Name En</label>
                                <input type="text" name="img_name_en" id="img_name_en" class="form-control" placeholder="Enter explore name in English"
                                       value="{{ old("img_name_en") ? old("img_name_en") : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('img_name_en'))
                                <div class="help-block">{{ $errors->first('img_name_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('img_name_bn') ? ' error' : '' }}">
                                <label for="img_name_bn">Image Name Bn</label>
                                <input type="text" name="img_name_bn" id="img_name_bn" class="form-control" placeholder="Enter explore name in Bangla"
                                       value="{{ old("img_name_bn") ? old("img_name_bn") : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('img_name_bn'))
                                <div class="help-block">{{ $errors->first('img_name_bn') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('img_alt_en') ? ' error' : '' }}">
                                <label for="img_alt_en">Image Alt En</label>
                                <input type="text" name="img_alt_en" id="img_alt_en" class="form-control" placeholder="Enter explore name in English"
                                       value="{{ old("img_alt_en") ? old("img_alt_en") : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('img_alt_en'))
                                <div class="help-block">{{ $errors->first('img_alt_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('img_alt_bn') ? ' error' : '' }}">
                                <label for="img_alt_bn">Image Alt Bn</label>
                                <input type="text" name="img_alt_bn" id="img_alt_bn" class="form-control" placeholder="Enter explore c's name in Bangla"
                                       value="{{ old("img_alt_bn") ? old("img_alt_bn") : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('img_alt_bn'))
                                <div class="help-block">{{ $errors->first('img_alt_bn') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Image</label>
                                <input type="file" id="input-file-now" name="image" class="dropify"/>
                                @if($errors->has('image'))
                                    <div class="help-block">  {{ $errors->first('image') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Image (Mobile)</label>
                                <input type="file" id="input-file-now" name="image_mobile" class="dropify"/>
                                @if($errors->has('image_mobile'))
                                    <div class="help-block">  {{ $errors->first('image_mobile') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('color') ? ' error' : '' }}">
                                <label for="color">Color</label>
                                <input type="color" name="color"  class="form-control" value="{{ old("color") ? old("color") : '' }}">
                            </div>

                            {{-- <div class="form-group col-md-6 {{ $errors->has('display_order') ? ' error' : '' }}">
                                <label for="display_order">Display Order</label>
                                <input type="number" min="0" name="display_order" id="display_order" class="form-control" placeholder="Enter explore c's order"
                                       value="{{ old("display_order") ? old("display_order") : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('display_order'))
                                <div class="help-block">{{ $errors->first('display_order') }}</div>
                                @endif
                            </div> --}}

                            <div class="col-md-6">
                                <label></label>
                                <div class="form-group">
                                    <label for="title" class="mr-1">Status:</label>
                                    <input type="radio" name="status" value="1" id="active" checked>
                                    <label for="active" class="mr-1">Active</label>

                                    <input type="radio" name="status" value="0" id="inactive">
                                    <label for="inactive">Inactive</label>
                                </div>
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

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/selectize/selectize.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

@endpush
@push('page-js')
<script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
{{-- <script src="{{ asset('app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script> --}}
<script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/product.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('js/custom-js/start-end.js')}}"></script>
<script src="{{ asset('js/custom-js/image-show.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>


<script>
    $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        
</script>
@endpush


