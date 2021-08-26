@extends('layouts.admin')
@section('title', 'Campaign Details')
@section('card_name', 'Campaign Details')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('event-base-bonus/campaigns') }}"> Campaign List</a></li>
    <li class="breadcrumb-item active"> Campaign Details</li>
@endsection
@section('action')
    <a href="{{ url('event-base-bonus/campaigns') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')

    <section id="configuration">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                        </div>
                    </div>
                </div>
            </div>
    </section>
@stop

@push('page-js')
@endpush
