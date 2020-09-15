@extends('layouts.admin')
@section('title', 'Customer Feedback')
@section('card_name', 'Customer Feedback')
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
                    <h4 class="card-title"><strong>Page List</strong></h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                            <div id="accordionWrap2" role="tablist" aria-multiselectable="true">
                                <div class="card collapse-icon accordion-icon-rotate left">
                                    @foreach($pagesInfo as $key => $page)
                                        <div id="heading{{ $page->id }}" class="card-header col-md-12 mb-1" style="background: #ececea">
                                            <a data-toggle="collapse" data-parent="#accordionWrap2" href="#accordion{{ $page->id }}" aria-expanded="true"
                                               aria-controls="accordion21" class="card-title lead">{{ $page->page_name }}</a>
                                            <span class="badge badge-success badge-pill pull-right">{{ $page->total_feedbacks }}</span>
                                        </div>
                                        <div id="accordion{{ $page->id }}" role="tabpanel" aria-labelledby="heading{{ $page->id }}"
                                             class="collapse col-md-4 {{ $key == 0 ? "show" : '' }}">
                                            <ul class="pl-1">
                                                <li class=" d-flex justify-content-between pt-1 pb-0">
                                                    <div class="col-md-12">
                                                       1. <i class="la la-star text-warning"></i>
                                                    </div>
                                                    <span class="badge badge-primary badge-pill">{{ $page->one_star }}</span>
                                                </li>
                                                <li class=" d-flex justify-content-between pt-1 pb-0">
                                                    <div class="col-md-12">
                                                       2. <i class="la la-star text-warning"></i>
                                                        <i class="la la-star text-warning"></i>
                                                    </div>
                                                    <span class="badge badge-primary badge-pill">{{ $page->two_star }}</span>
                                                </li>
                                                <li class=" d-flex justify-content-between pt-1 pb-0">
                                                    <div class="col-md-12">
                                                        3. <i class="la la-star text-warning"></i>
                                                        <i class="la la-star text-warning"></i>
                                                        <i class="la la-star text-warning"></i>
                                                    </div>
                                                    <span class="badge badge-primary badge-pill">{{ $page->three_star }}</span>
                                                </li>
                                                <li class=" d-flex justify-content-between pt-1 pb-0">
                                                    <div class="col-md-12">
                                                        4. <i class="la la-star text-warning"></i>
                                                        <i class="la la-star text-warning"></i>
                                                        <i class="la la-star text-warning"></i>
                                                        <i class="la la-star text-warning"></i>
                                                    </div>
                                                    <span class="badge badge-primary badge-pill">{{ $page->four_star }}</span>
                                                </li>
                                                <li class=" d-flex justify-content-between pt-1 pb-0">
                                                    <div class="col-md-12">
                                                        5. <i class="la la-star text-warning"></i>
                                                        <i class="la la-star text-warning"></i>
                                                        <i class="la la-star text-warning"></i>
                                                        <i class="la la-star text-warning"></i>
                                                        <i class="la la-star text-warning"></i>
                                                    </div>
                                                    <span class="badge badge-primary badge-pill">{{ $page->five_star }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
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





