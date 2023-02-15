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
                    <form role="form" action="{{ route('fixed-page-components-update',[$pageId,$shortCodes->id]) }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        {{method_field('PATCH')}}
                        <div class="row">
                            <input type="hidden" name="shortCodes_type" value="{{ $shortCodes->shortCodes_type }}">
                            <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                <label for="title_en" class="">Title (English)</label>
                                <input type="text" name="title_en"  class="form-control" placeholder="Enter title (english)"
                                       value="{{ $shortCodes->title_en }}"  >
                                <div class="help-block"></div>
                                @if ($errors->has('title_en'))
                                    <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                <label for="title_bn" class="">Title (Bangla)</label>
                                <input type="text" name="title_bn"  class="form-control" placeholder="Enter title (english)"
                                       value="{{ $shortCodes->title_bn }}">
                                <div class="help-block"></div>
                                @if ($errors->has('title_bn'))
                                    <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                @endif
                            </div>

                            @include('layouts.partials.slider_types.text_area')

                            @include('layouts.partials.common_types.label_with_url')

                            @include('layouts.partials.common_types.label_with_url',['count'=> 1])

                            @include('layouts.partials.slider_types.app_links')

                            @include('layouts.partials.common_types.label_with_url',['count'=> 'more','type'=>'view more'])

                            @include('layouts.partials.common_types.image_other_component',['component'=> $shortCodes])

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')

    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>


    <script>
        $(function () {

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        })
    </script>
@endpush





