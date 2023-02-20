@extends('layouts.admin')
@section('title', 'SIM & Offers')
@section('card_name', 'SIM & Offers')
@section('action')

@endsection
@section('content')
<section>
    <div class="row">
        <div id="recent-sales" class="col-12 col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sim Type</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                </div>
                <div class="card-content mt-1">
                    <div class="table-responsive">
                        <table id="recent-orders" class="table table-hover table-xl mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Sim Type</th>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Products</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($simCategories as $simCategory)
                                @php
                                    $path = 'partner-offers-home';
                                    if($simCategory->name == "Prepaid"){
                                        $url = URL::to('offers/prepaid');
                                    }
                                    else{
                                        $url = URL::to('offers/postpaid');
                                    }
                                @endphp
                                <tr>
                                    <td class="text-truncate">{{ $simCategory->name }}</td>
                                    <td>
                                        <div class="badge badge-info badge-square">
                                            <span>Fixed</span>
                                            <i class="la la-lock font-medium-2"></i>
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ $url }}" class="btn btn-sm btn-outline-success round">View Products</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="recent-sales" class="col-12 col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sim Categories</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                </div>
                <div class="card-content mt-1">
                    <div class="table-responsive">
                        <table id="recent-orders" class="table table-hover table-xl mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0">Childes</th>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($offerCategories as $offerCategory)
{{--                                                @if($offerCategory->alias != "call_rate")--}}
                                        <tr>
                                            <td class="text-truncate">{{ $offerCategory->name_en }}</td>
                                            <td>
                                                {!!  (strtolower($offerCategory->alias) == 'packages' || strtolower($offerCategory->alias) == 'others') ? "<a href='".route('child_menu', [$offerCategory->id, $offerCategory->alias])."' class='btn btn-sm btn-outline-success round'> Childs</a>" : '<div class="badge badge-pill badge-danger">No</div>' !!}
                                            </td>
                                            <td>
                                                <div class="badge badge-info badge-square">
                                                    <span>Fixed</span>
                                                    <i class="la la-lock font-medium-2"></i>
                                                </div>
                                            </td>

                                            <td width="6%" class="text-center">
                                                <a href="{{ url("offer-categories/$offerCategory->id/edit") }}"><i class="la la-pencil" aria-hidden="true"></i></a>
                                            </td>

                                        </tr>
{{--                                                @endif--}}
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

@push('page-css')
<style>
    #sortable tr td{
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }
</style>
@endpush

@push('page-js')

@endpush





