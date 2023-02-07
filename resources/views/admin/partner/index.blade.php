@extends('layouts.admin')
@section('title', 'Partner List')
@section('card_name', 'Partner List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Partner List</li>
@endsection
@section('action')
    <a href="{{ route('campaign-offers.list') }}" class="btn btn-warning  round btn-glow px-2"><i class="la la-bullhorn"></i>
        Campaign
    </a>

    <a href="{{ route('partner-offer-home') }}" class="btn btn-instagram  round btn-glow px-2"><i class="la la-list"></i>
        Home Page Offers
    </a>

    <a href="{{ url('partners/create') }}" class="btn btn-success  round btn-glow px-2"><i class="la la-plus"></i>
        Add Partner
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">All Partners</h4>
                    <table class="table table-striped table-bordered" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Company Logo</th>
                            <th>Company Name</th>
{{--                            <th>Category</th>--}}
                            <th width="12%">Contact Parson Mobile</th>
                            <th>Address</th>
                            <th>Offer</th>
                            <th width="12%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($partners as $key=>$partner)
                            @php(  $partnerName = str_replace(" ", "-", strtolower( $partner->company_name_en ) ))
                            <tr>
                                <td class="pt-2">{{ ++$key }}</td>
                                <td><img src="{{ config('filesystems.file_base_url') . $partner->company_logo }}" height="50" width="50"></td>
                                <td class="pt-2">{{ $partner->company_name_en }}</td>
{{--                                <td class="pt-2">{{ $partner->partnerCategory->name_en }}</td>--}}
                                <td class="pt-2">{{ $partner->contact_person_mobile }}</td>
                                <td class="pt-2">{{ $partner->company_address }}</td>
                                <td>
                                    <a href="{{ route('partner-offer', [$partner->id, $partnerName]  ) }}" class="btn btn-outline-warning">
                                        <i class="la la-gift"></i> Partner Offers <span class="ml-1 badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{--{{ $childNumber }}--}}</span>
                                    </a>
                                </td>
                                <td class="action" width="8%">
                                    <a href="{{ url("partners/$partner->id/edit") }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("partner/destroy/$partner->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $partner->id }}" title="Delete the user">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop

{{--<style>--}}
{{--    h4.menu-title {--}}
{{--        font-weight: bold;--}}
{{--    }--}}
{{--</style>--}}

