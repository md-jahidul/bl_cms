@extends('layouts.admin')
@section('title', 'Device Tag Edit')
@section('card_name', 'Device Tag Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('bl-4g-device-tag') }}">Device Tag List</a></li>
    <li class="breadcrumb-item active"> Device Tag Edit</li>
@endsection
@section('action')
    <a href="{{ url('bl-4g-device-tag') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("bl-4g-eligibility-msg.update", $msg->id) }}" method="POST" novalidate>
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('message_en') ? ' error' : '' }}">
                                    <label for="message_en">Message (English)</label>
                                    <textarea type="text" name="other_attributes[message_en]" rows="5" id=""
                                            class="form-control" placeholder="Enter message">{{ (!empty($other_attributes['message_en'])) ? $other_attributes['message_en'] : old("other_attributes.message_en") ?? '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('message_en'))
                                    <div class="help-block">  {{ $errors->first('message_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('message_bn') ? ' error' : '' }}">
                                    <label for="message_bn">Message (Bangla)</label>
                                    <textarea type="text" name="other_attributes[message_bn]" rows="5" id=""
                                            class="form-control" placeholder="Enter message (bangla)">{{ (!empty($other_attributes['message_bn'])) ? $other_attributes['message_bn'] : old("other_attributes.message_bn") ?? '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('message_bn'))
                                    <div class="help-block">  {{ $errors->first('message_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('button_en') ? ' error' : '' }}">
                                    <label for="button_en" class="required">Button (English)</label>
                                    <input type="text" name="other_attributes[button_en]"  class="form-control" placeholder="Enter button name in english"
                                           value="{{ (!empty($other_attributes['button_en'])) ? $other_attributes['button_en'] : old("other_attributes.button_en") ?? '' }}" required data-validation-required-message="Enter duration name in english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('button_en'))
                                        <div class="help-block">  {{ $errors->first('button_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('button_bn') ? ' error' : '' }}">
                                    <label for="button_bn" class="required">Button (Bangla)</label>
                                    <input type="text" name="other_attributes[button_bn]"  class="form-control" placeholder="Enter duration name in bangla"
                                           value="{{ (!empty($other_attributes['button_en'])) ? $other_attributes['button_en'] : old("other_attributes.button_en") ?? '' }}" required data-validation-required-message="Enter duration name in bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('button_bn'))
                                        <div class="help-block">  {{ $errors->first('button_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('redirect_url') ? ' error' : '' }}">
                                    <label for="button_en" class="required">Redirect URL (English)</label>
                                    <input type="text" name="other_attributes[redirect_url]"  class="form-control" placeholder="Enter duration name in english"
                                           value="{{ (!empty($other_attributes['redirect_url'])) ? $other_attributes['redirect_url'] : old("other_attributes.redirect_url") ?? '' }}" required data-validation-required-message="Enter duration name in english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('redirect_url'))
                                        <div class="help-block">  {{ $errors->first('redirect_url') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('redirect_url_bn') ? ' error' : '' }}">
                                    <label for="redirect_url_bn" class="required">Redirect URL (Bangla)</label>
                                    <input type="text" name="other_attributes[redirect_url_bn]"  class="form-control" placeholder="Enter duration name in bangla"
                                           value="{{ (!empty($other_attributes['redirect_url_bn'])) ? $other_attributes['redirect_url_bn'] : old("other_attributes.redirect_url_bn") ?? '' }}" required data-validation-required-message="Enter duration name in bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('redirect_url_bn'))
                                        <div class="help-block">  {{ $errors->first('redirect_url_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> UPDATE
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
@endpush
@push('page-js')

@endpush














