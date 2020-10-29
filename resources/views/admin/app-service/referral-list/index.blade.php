@extends('layouts.admin')
@section('title', 'Referred List')
@section('card_name', 'Referred List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Referred List</li>
@endsection
@section('action')
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Referred List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <td width="3%">#</td>
                                <th width="5%">Mobile No</th>
                                <th width="5%">Referral Code</th>
                                <th width="30%">App</th>
                                <th width="3%" class="text-center">Share</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($referralList as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{!! $data->mobile_no !!}</td>
                                        <td>{{ $data->referral_code }}</td>
                                        <td>{{ $data->apps->name_en }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-info badge-pill">{{ $data->share_count }}</span>
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

@push('page-css')
@endpush

@push('page-js')
@endpush





