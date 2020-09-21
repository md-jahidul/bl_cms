@extends('layouts.admin')
@section('title', 'Customer Feedback Questions')
@section('card_name', 'Customer Feedback Questions')
@section('breadcrumb')
<li class="breadcrumb-item ">
    <a href="{{ url('customer-feedback/list') }}">Feedback List</a>
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
                        @foreach($feedbackDetails as $data)
                            <div class="bs-callout-primary callout-border-left callout-square p-1">
                                <strong>{{ $data['question'] }}</strong>
                                <p class="pt-1">{{ $data['answer'] }}</p>
                            </div> <br>
                        @endforeach
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





