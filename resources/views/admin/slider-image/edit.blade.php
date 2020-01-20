@extends('layouts.admin')
@section('title', 'Slider Image Edit')
@section('card_name', 'Slider Image Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('single-sliders') }}"> Slider List</a></li>
    <li class="breadcrumb-item active"> <a href="{{ route('slider_images', [$sliderImage->slider_id, $type]) }}"> Slider Image List</a></li>
    <li class="breadcrumb-item active"> Slider Image Edit</li>
@endsection
@section('action')
    <a href="{{ route('slider_images', [$sliderImage->slider_id, $type]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        @endforeach
    @endif
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title">{{ ucwords($type) }} sliders image edit</h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("slider_image_update", [ $sliderImage->slider_id, $type, $sliderImage->id ]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}

                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter english title"
                                           value="{{ $sliderImage->title_en }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">{{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter english title"
                                           value="{{ $sliderImage->title_bn }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                    <label for="start_date" class="required">Start Date</label>
                                    <div class='input-group'>
                                        <input type='text' class="form-control" name="start_date" id="start_date"
                                               value="{{ $sliderImage->start_date }}"
                                               required data-validation-required-message="Please select start date"
                                               placeholder="Please select start date" />
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('start_date'))
                                        <div class="help-block">{{ $errors->first('start_date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                    <label for="end_date">End Date</label>
                                    <input type="text" name="end_date" id="end_date" class="form-control"
                                           value="{{ $sliderImage->end_date }}"
                                           placeholder="Please select end date"
                                           value="{{ old("end_date") ? old("end_date") : '' }}" autocomplete="off">
                                    <div class="help-block"></div>
                                    @if ($errors->has('end_date'))
                                        <div class="help-block">{{ $errors->first('end_date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Alt Text</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter bangla title"
                                           value="{{ $sliderImage->alt_text }}" required data-validation-required-message="Enter bangla title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-5 mt-1 {{ $errors->has('image_url') ? ' error' : '' }}">
                                    <div class="custom-file">
                                        <input type="file" name="image_url" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                </div>

                                <div class="form-group col-md-1">
                                    <img src="{{ config('filesystems.file_base_url') .$sliderImage->image_url }}" style="height:70px;width:70px;" id="imgDisplay">
                                </div>

                                 @include('layouts.partials.slider_types.' . $type )


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_active" value="1" id="input-radio-15" @if($sliderImage->is_active == 1) {{ 'checked' }} @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_active" value="0" id="input-radio-16" @if($sliderImage->is_active == 0) {{ 'checked' }} @endif>
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>
                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
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
@endpush

@push('page-js')
    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            var date = new Date();
            date.setDate(date.getDate());
            $('#start_date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                showClose: true,
            });
            $('#end_date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                useCurrent: false, //Important! See issue #1075
                showClose: true,

            });

            $('.duration_categories').change(function () {
                let durationOntion = $(this).find('option:selected').attr('data-alias')
                let durationDays = $(this).find('option:selected').attr('data-days')
                let validityField = $('.validity_days');

                if (durationOntion) {
                    validityField.val(durationDays).prop('readonly', true);
                }
            })
        });
    </script>
@endpush






