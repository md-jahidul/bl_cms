@extends('layouts.admin')
@section('title', 'Toffee Premium Product')
@section('card_name',"Toffee Premium Product" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Toffee Premium Product</li>
@endsection
@section('action')
    <a href="{{route('toffee-premium-products.index')}}" class="btn btn-info btn-glow px-2">
        Premium Products List
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
                        <form novalidate class="form row" action="{{route('toffee-premium-products.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="toffee_subscription_type_id" class="required">Subscription Type:</label>
                                        <select name="toffee_subscription_type_id" class="form-control"
                                            required data-validation-required-message="Please select Subscription Type">
                                            <option value=""></option>
                                            @foreach ($toffeeSubscriptionTypes as $key => $subscriptionTypes)
                                                <option
                                                    value="{{ $key }}" {{ old("toffee_subscription_type_id") == $key ? 'selected' : '' }}>  {{$subscriptionTypes}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('toffee_subscription_type_id'))
                                            <div class="help-block">{{ $errors->first('toffee_subscription_type_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="prepaid_product_codes" class="">Prepaid Product Codes:</label>
                                        <select multiple name="prepaid_product_codes[]" class="form-control prepaid_product_codes">
                                            <option value=""></option>
                                            @foreach ($toffeePrepaidProductCodes as $key => $prepaidProductCode)
                                                <option
                                                    value="{{ $key }}" {{ old("prepaid_product_codes") == $key ? 'selected' : '' }}>  {{$prepaidProductCode}}
                                                </option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="postpaid_product_codes" class="">Postpaid Product Codes:</label>
                                        <select multiple name="postpaid_product_codes[]" class="form-control postpaid_product_codes">
                                            <option value=""></option>
                                            @foreach ($toffeePostpaidProductCodes as $key => $postpaidProductCode)
                                                <option
                                                    value="{{ $key }}" {{ old("postpaid_product_codes") == $key ? 'selected' : '' }}>  {{$postpaidProductCode}}
                                                </option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-2 icheck_minimal skin mt-2">
                                        <fieldset>
                                            <input type="checkbox" id="available_for_bl_users" value="1" name="available_for_bl_users">
                                            <label for="available_for_bl_users">Available for BL Users</label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <span class="text-warning"><strong><i class="la la-warning"></i></strong> You have to fill at least one field from <b>Prepaid Product Codes, Postpaid Product Codes and Available for BL Users</b></span>
                                        <div class="help-block"></div>
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
    {{--        <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>--}}
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
            $('select[name="toffee_subscription_type_id"]').select2({
                placeholder: 'Please Select Subscription Type',
                allowClear: true
            });

            $('.prepaid_product_codes').select2({
                placeholder: 'Please Select Prepaid Product codes',
                allowClear: true
            });

            $('.postpaid_product_codes').select2({
                placeholder: 'Please Select Postpaid Product Codes',
                allowClear: true
            });
        })
    </script>
@endpush
