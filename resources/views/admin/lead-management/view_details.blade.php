@extends('layouts.admin')
@section('title', 'Lead Info')
@section('card_name', 'Lead Request Info')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ route('lead-list') }}"> Lead Request List</a></li>
    <li class="breadcrumb-item active">Lead Request Details</li>
@endsection
@section('action')
    <a href="{{ route('lead-list') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Back </a>
@endsection
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <form role="form" action="{{ route('lead.change_status', $requestInfo->id) }}" method="POST">
                @csrf
                @method('Put')
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-6 float-left pt-1">
                            <h4 class="card-title" id="striped-row-layout-card-center pt-2"><strong>Lead Change Status</strong></h4>
                        </div>

                        <div class="col-md-2 float-right">
                            <button type="submit" class="btn btn-success round"><i class="la la-refresh"></i> Update</button>
                        </div>

                        <div class="col-md-4 float-right">
                            <select class="form-control" name="status" id="selectColor2">
                                <option value="pending" {{ $requestInfo->status == "pending" ? "selected" : "" }}>Pending</option>
                                <option value="in_progress" {{ $requestInfo->status == "in_progress" ? 'selected' : "" }}>In Progress</option>
                                <option value="done" {{ $requestInfo->status == "done" ? "selected" : "" }}>Done</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <form role="form" action="{{ url('download/file') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-8 float-left">
                            <h3 class="card-title" id="striped-row-layout-card-center pt-2"><i class="la la-th-list"></i> <strong>Lead Request Details</strong></h3>
                        </div>
                        <div class="col-md-1 float-right">
                            <a href="{{ URL("download-pdf/$requestInfo->id") }}" role="button" class="btn-sm btn-info border-0"><i class="la la-download" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <hr class="mb-0 mt-0">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                @foreach($requestInfo->form_data as $field => $value)
                                    @php
                                        $fieldToUpper = strtoupper(str_replace('_', ' ', $field))
                                    @endphp
                                    {{--Corporate responsibility Section--}}
                                    @if($requestInfo->lead_category_id == 5)
                                        <tr style="background: rgba(225,233,221,0.88)">
                                            <th colspan="3">{{ $fieldToUpper }}</th>
                                        </tr>
                                        @foreach($value as $subField => $subValue)
                                            @if($subField == "company_files")
                                                <tr>
                                                    <th class="text-right" width="30%">{{ str_replace('_', ' ', ucwords($subField)) }}</th>
                                                    @if($subValue)
                                                        <td>
                                                            <a href="{{ url("download/file") }}" class="text-warning">
                                                                <input type="hidden" name="file_path" value="{{ $subValue }}">
                                                                <button type="submit" class="btn btn-sm btn-outline-warning"><i class="la la-download"></i> {{ $subValue }}</button>
                                                            </a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @else
                                                <tr>
                                                    <th class="text-right" width="30%">{{ str_replace('_', ' ', ucwords($subField)) }}</th>
                                                    <td>
                                                        {{ $subValue }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    {{--Other Module Section--}}
                                    @else
                                        @if($field == "applicant_cv")
                                            <tr>
                                                <th class="text-right" width="30%">{{ $fieldToUpper }}</th>
                                                @if($value)
                                                    <td>
                                                        <a href="{{ url("download/file") }}" class="text-warning">
                                                            <input type="hidden" name="file_path" value="{{ $value }}">
                                                            <button type="submit" class="btn btn-sm btn-outline-warning"><i class="la la-download"></i> Download CV</button>
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @else
                                            <tr>
                                                <th class="text-right" width="30%">{{ $fieldToUpper }}</th>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@push('page-js')

@endpush





