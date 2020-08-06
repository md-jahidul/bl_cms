@extends('layouts.admin')
@section('title', 'Quick Launch Create')
{{--@section('card_name', "Quick Launch Create")--}}
{{--@section('breadcrumb')--}}
{{--    <li class="breadcrumb-item active"> <a href="{{ url("quick-launch/$type") }}"> Quick Launch {{ $type }} List</a></li>--}}
{{--    <li class="breadcrumb-item active"> Quick Launch {{ ucfirst($type) }}</li>--}}
{{--@endsection--}}
{{--@section('action')--}}
{{--    <a href="{{ url("quick-launch/$type") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>--}}
{{--@endsection--}}
@section('content')
    <section>
        <div class="card">
            <div class="card-header"><h3><strong> Send Mail</strong></h3></div>
{{--            <div class="card-content">--}}
                <div class="card-body">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('lead.send_mail') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('email') ? ' error' : '' }}">
                                    <label for="title_en">To</label>
                                    <input type="text" name="email"  class="form-control" placeholder="Enter valid email address"
                                           value="{{ old("email") ? old("email") : '' }}" required
                                           data-validation-required-message="Enter valid email address">
                                    <div class="help-block"></div>
                                    @if ($errors->has('email'))
                                        <div class="help-block">  {{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 {{ $errors->has('subject') ? ' error' : '' }}">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject"  class="form-control" placeholder="Enter subject"
                                           value="{{ old("subject") ? old("subject") : '' }}" required
                                           data-validation-required-message="Enter valid email address">
                                    <div class="help-block"></div>
                                    @if ($errors->has('subject'))
                                        <div class="help-block">  {{ $errors->first('subject') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 {{ $errors->has('message') ? ' error' : '' }}">
                                    <label for="message" class="required">Message</label>
                                    <textarea name="message" rows="5" class="form-control" placeholder="Enter title in Bangla"></textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('message'))
                                        <div class="help-block">  {{ $errors->first('message') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i class="la la-send"></i> Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
{{--            </div>--}}
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')

@endpush







