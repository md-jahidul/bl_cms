@extends('layouts.admin')
@section('title_en', 'Faq Create')
@section('card_name', 'Faq Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('faq') }}">Faq Categories List</a></li>
    <li class="breadcrumb-item active"> Faq Create</li>
@endsection
@section('action')
    <a href="{{ url('faq') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url('faq') }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title English</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter faq name"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter faq title_en">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title Bangla</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter faq name"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter faq title_bn">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('type') ? ' error' : '' }}">
                                    <label for="type" class="required">Type</label>
                                    <select class="form-control" name="offer_category_id" id="offer_type"
                                            required data-validation-required-message="Please select offer">
                                        <option value="">---Select Type---</option>
                                        <option value="press_release">Press Release</option>
                                        <option value="news_events">News and Events</option>
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('type'))
                                        <div class="help-block">  {{ $errors->first('type') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('date') ? ' error' : '' }}">
                                    <label for="date" class="required">Date</label>
                                    <input type="text" id="date" name="date" class="form-control" placeholder="DD-MM-YYYY"
                                           value="{{ old("date") ? old("date") : '' }}"
                                           required data-validation-required-message="Enter faq name in bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('date'))
                                        <div class="help-block">  {{ $errors->first('date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('short_details_en') ? ' error' : '' }}">
                                    <label for="short_details_en" class="required">Short Description En</label>
                                    <input type="text" name="short_details_en"  class="form-control" placeholder="Enter faq name"
                                           value="{{ old("short_details_en") ? old("short_details_en") : '' }}" required data-validation-required-message="Enter faq short_details_en">
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_details_en'))
                                        <div class="help-block">  {{ $errors->first('short_details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('short_details_bn') ? ' error' : '' }}">
                                    <label for="short_details_bn" class="required">Short Description BN</label>
                                    <input type="text" name="short_details_bn"  class="form-control" placeholder="Enter faq name"
                                           value="{{ old("short_details_bn") ? old("short_details_bn") : '' }}" required data-validation-required-message="Enter faq short_details_bn">
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_details_bn'))
                                        <div class="help-block">  {{ $errors->first('short_details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('long_details_bn') ? ' error' : '' }}">
                                    <label for="long_details_bn" class="required">Long Description En</label>
                                    <input type="text" name="long_details_bn"  class="form-control" placeholder="Enter faq name"
                                           value="{{ old("long_details_bn") ? old("long_details_bn") : '' }}" required data-validation-required-message="Enter faq long_details_bn">
                                    <div class="help-block"></div>
                                    @if ($errors->has('long_details_bn'))
                                        <div class="help-block">  {{ $errors->first('long_details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('long_details_bn') ? ' error' : '' }}">
                                    <label for="long_details_bn" class="required">Long Description BN</label>
                                    <input type="text" name="long_details_bn"  class="form-control" placeholder="Enter faq name"
                                           value="{{ old("long_details_bn") ? old("long_details_bn") : '' }}" required data-validation-required-message="Enter faq long_details_bn">
                                    <div class="help-block"></div>
                                    @if ($errors->has('long_details_bn'))
                                        <div class="help-block">  {{ $errors->first('long_details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
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
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            var date = new Date();
            date.setDate(date.getDate());
            $('#date').datetimepicker({
                format : 'DD-MM-YYYY',
                showClose: true,

            });
        });
    </script>
@endpush






