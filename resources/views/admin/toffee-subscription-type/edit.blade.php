@extends('layouts.admin')
@section('title', 'Edit Toffee Subscription Type')
@section('card_name', 'Edit Toffee Subscription Type')

@section('action')
    <a href="{{route('toffee-subscription-types.index')}}" class="btn btn-info btn-glow px-2">
        Back
    </a>
@endsection
@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form novalidate class="form row"
                              action="{{ route("toffee-subscription-types.update",$toffeeSubscriptionType->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')

                            <div class="form-group col-md-6">
                                <label for="subscription_type">Subscription Type: <small
                                        class="text-danger">*</small> </label>
                                <input
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-required-message="Title is required"
                                    data-validation-regex-message="Title must start with alphabets"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('subscription_type')?old('subscription_type'):$toffeeSubscriptionType->subscription_type}}" required id="subscription_type"
                                    type="text"
                                    class="form-control @error('subscription_type') is-invalid @enderror"
                                    placeholder="Title" name="subscription_type">
                                <small
                                    class="text-danger"> @error('subscription_type') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                                @if ($errors->has('subscription_type'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('subscription_type') }} </small>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="content_ids" class="">Content Ids</label>
                                <input class="form-control"
                                    name="content_ids"
                                    value="{{old('content_ids') ? old('content_ids') : $toffeeSubscriptionType->content_ids}}"
                                    id="content_ids"
                                    placeholder="Enter Content Ids with comma-separated value"
                                    required>
                                @if($errors->has('content_ids'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('content_ids') }}</small>
                                    </p>
                                @endif
                                <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Enter Content Ids with comma-separated value</span>
                                <div class="help-block"></div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Active Status:</label>
                                    <select value="{{$toffeeSubscriptionType->status}}"
                                            class="form-control" id="status"
                                            name="status">
                                        <option value="1"
                                                @if($toffeeSubscriptionType->status == "1") selected @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if($toffeeSubscriptionType->status == "0") selected @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button style="float: right" type="submit" id="submitForm"
                                        class="btn btn-success round px-2">
                                    <i class="la la-check-square-o"></i> Submit
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!$toffeeSubscriptionType)
        <h1>
            No Subscription Type Available
        </h1>
    @else

    @endif
@endsection




@push('style')

@endpush

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script>

        $(function () {

        });

    </script>
@endpush
