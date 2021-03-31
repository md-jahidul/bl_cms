@php
    function match($slug, $multiItems){
        foreach ($multiItems as $item){
           if($item->offer_section_slug == $slug){
              return true;
           }
         }
        return false;
     }
@endphp

@extends('layouts.admin')
@section('title', 'Mybl Products')

@section('card_name', "Product Details")

@section('action')
    <a href="{{ route('mybl.product.index') }}" class="btn btn-info btn-sm btn-glow px-2">
        Back To Product List
    </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form"
                          action="{{ route('mybl.product.update',  $details->details->product_code )}}"
                          enctype="multipart/form-data"
                          method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sim_type">Connection Type</label>
                                        <input class="form-control"
                                               value="@if($details->details->sim_type == 1) PREPAID @else POSTPAID @endif"
                                               disabled
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_code">Product Code</label>
                                        <input class="form-control" value="{{ $details->details->product_code }}"
                                               disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Title</label>
                                        <input class="form-control" value="{{ $details->details->name }}" name="name"
                                               id="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="content_type">Content Type</label>
                                        <input class="form-control"
                                               value="{{ ucfirst($details->details->content_type) }}"
                                               name="content_type">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <input class="form-control" value="{{ $details->details->short_description }}"
                                               name="short_description">
                                    </div>
                                </div>
                                @if( $details->details->activation_ussd)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Activation USSD </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->activation_ussd }}"
                                                   name="activation_ussd">
                                        </div>
                                    </div>
                                @endif
                                @if( $details->details->balance_check_ussd)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Balance USSD</label>
                                            <input class="form-control"
                                                   value="{{ $details->details->balance_check_ussd }}"
                                                   name="balance_check_ussd">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>MRP Price</label>
                                        <input class="form-control" value="{{ $details->details->mrp_price }}"
                                               name="mrp_price">
                                    </div>
                                </div>
                                @if($details->details->data_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Data Volume </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->data_volume }} {{ $details->details->data_volume_unit }}"
                                                   name="data_volume">
                                        </div>
                                    </div>
                                @endif
                                @if($details->details->minute_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Minute Volume </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->minute_volume }} Minutes"
                                                   name="minute_volume">
                                        </div>
                                    </div>
                                @endif

                                @if($details->details->sms_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>SMS Volume </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->sms_volume }} SMS" name="sms_volume">
                                        </div>
                                    </div>
                                @endif
                                @if($details->details->sms_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>SMS Volume </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->sms_volume }} SMS">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Validity </label>
                                        <input class="form-control"
                                               value="{{ $details->details->validity }} {{ ucfirst($details->details->validity_unit) }}"
                                               name="validity">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Has Auto Renew Code? </label>
                                        <input class="form-control"
                                               value="{{ ($details->details->renew_product_code)? "YES" : "NO" }}"
                                               disabled>
                                    </div>
                                </div>
                                @if($details->details->renew_product_code)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Auto Renewable Code</label>
                                            <input class="form-control"
                                                   value="{{ $details->details->renew_product_code }}"
                                                   disabled>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                @if(strtolower($details->details->content_type) == 'data')
                                    @php
                                        $tabs = $details->detailTabs->pluck('id')->toArray() ?? [];
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Data Section </label>
                                            <select multiple
                                                    class="form-control data-section"
                                                    name="offer_section_slug[]" required>
                                                <option value="">Please Select Data Section</option>

                                                @foreach ($internet_categories as $key => $category)
                                                    <option
                                                        {{ in_array($key, $tabs, false) ? 'selected' : '' }}
                                                        value="{{ $key }}">  {{$category}}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tags </label>
                                        @php
                                            $thisProductTags = $details->tags->pluck('id')->toArray() ?? [];
                                        @endphp
                                        <select multiple
                                                class="form-control tags"
                                                name="tags[]">
                                            <option value=""></option>

                                            @foreach ($tags as $key => $tag)
                                                <option
                                                    {{ in_array($key, $thisProductTags, false) ? 'selected' : '' }}
                                                    value="{{ $key }}">  {{$tag}}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                {{--                                <div class="col-md-4">--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <label>Tag </label>--}}
                                {{--                                        <input class="form-control" name="tag" value="{{ $details->tag }}"--}}
                                {{--                                               placeholder="e.g. Hot, New etc">--}}
                                {{--                                        @if($errors->has('tag'))--}}
                                {{--                                            <p class="text-left">--}}
                                {{--                                                <small class="danger text-muted">{{ $errors->first('tag') }}</small>--}}
                                {{--                                            </p>--}}
                                {{--                                        @endif--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Schedule Availability </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label small">Show From</label>
                                                <input class="form-control" id="show_from" name="show_from"
                                                       placeholder="Show From Time" autocomplete="off">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small">Hide From</label>
                                                <input class="form-control" id="hide_from" name="hide_from"
                                                       placeholder="Hide From Time" autocomplete="off">
                                            </div>
                                        </div>
                                        @if($errors->has('tag'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('tag') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Visibility (show/hide in app)</label>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <input type="radio" name="is_visible"
                                                   value="1" {{$details->is_visible ? 'checked' : ''}}>
                                            <label class="small">Show</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="radio" name="is_visible"
                                                   value="0" {{$details->is_visible ? '' : 'checked'}}>
                                            <label class="small">Hide</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="show_in_home" value="1" name="show_in_app"
                                               @if($details->show_in_home) checked @endif>
                                        <label for="show_in_home">Show in Home</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="pin_to_top" value="1" name="pin_to_top"
                                               @if($details->pin_to_top) checked @endif
                                            {{$disablePinToTop ? 'disabled' : ''}}>
                                        <label for="pin_to_top">Pin to Top</label>
                                        @if($disablePinToTop)
                                            <label for="pin_to_top" class="small red">
                                                Maximum range for pin to top has been exceeded.
                                                To pin this product to top , please unpin any other product and retry.
                                            </label>
                                        @endif
                                    </fieldset>
                                </div>
                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_rate_cutter_offer" value="1"
                                               name="is_rate_cutter_offer"
                                               @if($details->is_rate_cutter_offer) checked @endif>
                                        <label for="show_in_home">Is Rate Cutter offer</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        @if($errors->has('media'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('media') }}</small>
                                            </p>
                                        @endif
                                        @if ($details->media)
                                            <input type="file"
                                                   id="input-file-now-custom-1"
                                                   class="dropify"
                                                   name="media"
                                                   data-default-file="{{ url('storage/' .$details->media) }}"
                                            />
                                        @else
                                            <input type="file" id="input-file-now" name="media" class="dropify"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block">
                                            <i class="ft-save"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </section>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">

    <link rel="stylesheet" href="{{asset('app-assets')}}/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" href="{{asset('app-assets')}}/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>

    <script src="{{asset('app-assets')}}/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>


        $(function () {

            $('.data-section').select2({
                placeholder: 'Please Select Data Section',
                maximumSelectionLength: 5,
                allowClear: true
            });

            $('.tags').select2({
                placeholder: 'Please Select Tags',
                maximumSelectionLength: 3
            });

        });


        // Translated
        var date;
        // Date & Time
        date = new Date();
        date.setDate(date.getDate());
        $('#show_from').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePickerIncrement: 5,
            startDate: '{{date('Y-m-d H:i:s')}}',
            minDate: date,
            locale: {
                format: 'YYYY/MM/DD h:mm A'
            }
        });

        $('#hide_from').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePickerIncrement: 5,
            endDate: '{{date('Y-m-d H:i:s', strtotime('+ 6 hours'))}}',
            minDate: date,
            locale: {
                format: 'YYYY/MM/DD h:mm A'
            }
        });
        $('#show_from').val("{{$details->show_from ? \Carbon\Carbon::parse($details->show_from)->format('Y/m/d h:i A') : ''}}");
        $('#hide_from').val("{{$details->hide_from ? \Carbon\Carbon::parse($details->hide_from)->format('Y/m/d h:i A') : ''}}");
        //$('#hide_from').val('');

        $('#show_from,#hide_from').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });

        $('.dropify').dropify({
            messages: {
                'default': 'Browse for an Image to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct Image file'
            }
        });
    </script>
@endpush
