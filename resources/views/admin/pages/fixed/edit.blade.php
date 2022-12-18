@extends('layouts.admin')
@section('title', 'Components List')
@section('card_name', 'Components List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('fixed-pages') }}"> Fixed Pages Edit </a></li>
    <li class="breadcrumb-item active"><strong>Components Edit</strong></li>
@endsection
@section('action')
{{--    <a href="{{ url("shortCodes/$shortCodesId/$type/image/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add shortCodes Image--}}
{{--    </a>--}}
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">


                <div class="card-body card-dashboard">
                    <form role="form" action="{{ route('fixed-page-components-update',[$pageId,$shortCodes->id]) }}" method="POST" novalidate>
                        @csrf
                        {{method_field('PATCH')}}
                        <div class="row">
                            <input type="hidden" name="shortCodes_type" value="{{ $shortCodes->shortCodes_type }}">
                            <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                <label for="title_en" class="required">Title (English)</label>
                                <input type="text" name="title_en"  class="form-control" placeholder="Enter title (english)"
                                       value="{{ $shortCodes->title_en }}" required data-validation-required-message="Enter shortCodes title (english)">
                                <div class="help-block"></div>
                                @if ($errors->has('title_en'))
                                    <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                <label for="title_bn" class="required">Title (Bangla)</label>
                                <input type="text" name="title_bn"  class="form-control" placeholder="Enter title (english)"
                                       value="{{ $shortCodes->title_bn }}" required data-validation-required-message="Enter shortCodes title (english)">
                                <div class="help-block"></div>
                                @if ($errors->has('title_bn'))
                                    <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                @endif
                            </div>



                            @include('layouts.partials.slider_types.text_area')

                            <div class="form-group col-md-6 {{ $errors->has('label_en') ? ' error' : '' }}">
                                <label for="label_en">Label (English)</label>
                                <input type="text" name="other_attributes[label_en]" rows="5" id="details"
                                          class="form-control" placeholder="Enter description" value="{{ (!empty($other_attributes['label_en'])) ? $other_attributes['label_en'] : old("other_attributes.label_en") ?? '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('label_en'))
                                <div class="help-block">  {{ $errors->first('label_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('label_bn') ? ' error' : '' }}">
                                <label for="label_bn">Label (bangla)</label>
                                <input type="text" name="other_attributes[label_bn]" rows="5" id="details"
                                          class="form-control" placeholder="Enter label (bangla)" value="{{ (!empty($other_attributes['label_bn'])) ? $other_attributes['label_bn'] : old("other_attributes.label_bn") ?? '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('label_bn'))
                                <div class="help-block">  {{ $errors->first('label_bn') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('label_url') ? ' error' : '' }}">
                                <label for="label_url">Label url(English)</label>
                                <input type="text" name="other_attributes[label_url]" rows="5" id="details"
                                          class="form-control" placeholder="Enter label url" value="{{ (!empty($other_attributes['label_url'])) ? $other_attributes['label_url'] : old("other_attributes.label_url") ?? '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('label_url'))
                                <div class="help-block">  {{ $errors->first('label_url') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('label_url_bn') ? ' error' : '' }}">
                                <label for="label_url_bn">Label url (bangla)</label>
                                <input type="text" name="other_attributes[label_url_bn]" rows="5" id="details"
                                          class="form-control" placeholder="Enter label url (bangla)" value="{{ (!empty($other_attributes['label_url_bn'])) ? $other_attributes['label_url_bn'] : old("other_attributes.label_url_bn") ?? '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('label_url_bn'))
                                <div class="help-block">  {{ $errors->first('label_url_bn') }}</div>
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
                        <input type="hidden" name="id" value="{{ $shortCodes->id }}"/>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>

    </script>
@endpush





