@extends('layouts.admin')
@section('title', 'Customer Information')
@section('card_name', 'Customer Information')
@section('breadcrumb')
<li class="breadcrumb-item ">
    <a href="{{ route('contact-us-info.list') }}">Contact List</a>
</li>
@endsection
@section('action')
@endsection
@section('content')

<!-- Square Callout start -->
<section id="square-callout">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><strong>Feedback Answer List</strong></h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @if(isset($details->contact_field))
                            @foreach($details->contact_field as $data)
                                @if(isset($data['field_name']) && isset($data['field_name']))
                                    <div class="bs-callout-primary callout-border-left callout-square p-1">
                                        <strong>{{ $data['field_name'] }}</strong>
                                        <p class="pt-1">{{ $data['field_value'] }}</p>
                                    </div> <br>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Square Callout end -->


@stop

@push('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-callout.css') }}">
@endpush

@push('page-js')
@endpush





