@extends('layouts.admin')
@section('title', 'Lead Info')
@section('card_name', 'Lead Request Info')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ route('lead-list') }}"> Lead Request List</a></li>
    <li class="breadcrumb-item active">Lead Request Details</li>
@endsection
@section('action')
{{--    <a href="{{ route('product.list', $type) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Back </a>--}}
@endsection
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <form role="form" action="{{ route('lead.change_status', $requestInfo->id) }}" method="POST">
                @csrf
                @method('Put')
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-6 float-left">
                            <h4 class="card-title" id="striped-row-layout-card-center pt-2"><i class="la la-th-list"></i> <strong>Lead Request Details</strong></h4>
                        </div>
                        <div class="col-md-3 float-right">
                            <select class="form-control bg-warning text-white" name="status" id="selectColor2">
                                <option value="pending" class="text-white" {{ $requestInfo->status == "pending" ? 'selected' : "" }}>Pending</option>
                                <option value="in_progress" {{ $requestInfo->status == "in_progress" ? 'selected' : "" }}>In Progress</option>
                                <option value="done" {{ $requestInfo->status == "done" ? 'selected' : "" }}>Done</option>
                            </select>
                        </div>


                    </div>
                    <hr class="mb-0 mt-0">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <th class="text-right" width="30%">Name</th>
                                    <td>{{ $requestInfo->name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Mobile</th>
                                    <td>{{ $requestInfo->mobile }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Email</th>
                                    <td>{{ $requestInfo->email }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">District</th>
                                    <td>{{ $requestInfo->district }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Thana</th>
                                    <td>{{ $requestInfo->thana }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Address</th>
                                    <td>{{ $requestInfo->address }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Category</th>
                                    <td>{{ ucwords($requestInfo->category) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Sub Category</th>
                                    <td>{{ ucwords($requestInfo->sub_category) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Request Type</th>
                                    <td>{{  str_replace('_', ' ', ucwords($requestInfo->request_type)) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Status</th>
                                    <td>
                                        <strong><span class="badge badge-success badge-pill mr-1">{{ str_replace('_', ' ', ucwords($requestInfo->status))}}</span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%"></th>
                                    <td>
                                        <button type="submit" class="btn btn-success round"><i class="la la-refresh"></i> Update</button>
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop


{{--<style>--}}
{{--    .profile-pic {--}}
{{--        position: relative;--}}
{{--        display: inline-block;--}}
{{--    }--}}
{{--    .profile-pic:hover .edit {--}}
{{--        display: block;--}}
{{--    }--}}
{{--    .edit {--}}
{{--        display: none;--}}
{{--    }--}}
{{--</style>--}}

@push('page-js')

@endpush





