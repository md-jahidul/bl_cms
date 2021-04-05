@extends('layouts.admin')
@section('title', 'Product Activity')
@section('card_name', 'Product Activity Details')
@section('breadcrumb')
    {{--    <li class="breadcrumb-item "><a href="{{ route('lead-list') }}"> Lead Request List</a></li>--}}
    {{--    <li class="breadcrumb-item active">Lead Request Details</li>--}}
@endsection
@section('action')
    <a href="{{ route('product-activities.history') }}" class="btn btn-warning  btn-glow px-2"><i
            class="la la-list"></i> Back </a>
@endsection
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-6">
                        <h4 class="card-title" id="striped-row-layout-card-center">User Name:
                            <strong>{{ $activity->user->name }}</strong></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-8 pl-0">
                        <h3 class="card-title" id="striped-row-layout-card-center">
                            @if(count($activity->updated_data) == 2)
                                <strong>Product Changes Information</strong>
                            @else
                                <strong>Product Details</strong>
                            @endif
                        </h3>
                    </div>
                </div>
                <hr class="mb-0 mt-0">
                <div class="card-content collpase show">
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <!-- Update Information-->
                            @if(count($activity->updated_data) == 2)
                                <tr>
                                    <th style="background: rgb(229,182,147)" colspan="2">Old Data</th>
                                    <th style="background: rgba(160,208,136,0.88)" colspan="2">New Changes</th>
                                </tr>
                                @foreach($activity->updated_data['old'] as $key => $data)
                                    <tr>
                                        <th width="20%">{{ str_replace('_', ' ', ucfirst($key)) }}</th>
                                        <td>{{ $data }}</td>
                                        <th width="20%">{{ str_replace('_', ' ', ucfirst($key)) }}</th>
                                        <td>{{ $activity->updated_data['new'][$key] }}</td>
                                    </tr>
                                @endforeach
                            <!-- Create and Delete Information-->
                            @else
                            <tr>
                                <th style="background: rgb(199,229,149)" colspan="2">Product Information</th>
                            </tr>
                            @foreach($activity->updated_data['new'] as $key => $data)
                                <tr>
                                    <th width="20%">{{ str_replace('_', ' ', ucfirst($key)) }}</th>
                                    <td>{{ $data }}</td>
                                </tr>
                            @endforeach
                            @endif

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('page-js')

@endpush





