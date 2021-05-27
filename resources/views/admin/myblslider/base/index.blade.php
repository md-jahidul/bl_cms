@extends('layouts.admin')
@section('title', 'Base Msisdn')
@section('card_name',"Base Msisdn")
@section('breadcrumb')
    <li class="breadcrumb-item active">Base Msisdn List</li>
@endsection
@section('action')
    <a href="{{route('myblslider.base.msisdn.create')}}" class="btn btn-info btn-glow px-2">
        Add Base
    </a>
{{--    <a href="{{route('myblslider.index')}}" class="btn btn-primary btn-glow px-2">--}}
{{--        Slider list--}}
{{--    </a>--}}
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">

                    <table class="table table-striped table-bordered dataTable">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="55%">Title</th>
                            <th width="20%">Create Date</th>
                            <th width="10%">Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($baseList as $key=>$list)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$list->title}}</td>
                                <td>{{date("d-M-Y h:i:s A", strtotime($list->created_at))}}</td>
                                <td>{{$list->status==1?'Active':'Inactive'}}</td>
                                <td>
                                    <a href="{{ route('myblslider.base.msisdn.edit', $list->id) }}" class="btn btn-xs btn-info">Edit</a>
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
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>

        $(document).ready(function () {
            $('.dataTable').DataTable({
                // dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10
            });
        });
    </script>
@endpush





