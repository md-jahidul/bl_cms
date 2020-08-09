@extends('layouts.admin')
@section('title', 'Feed Category')
@section('card_name', 'Feed Category')
@section('breadcrumb')
    <li class="breadcrumb-item active">Feed Category List</li>
@endsection

@section('action')
            <a href="{{route('feeds.categories.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
                Create Category
            </a>
@endsection

@section('content')

<section>
    <div class="card card-info mt-0" style="box-shadow: 0px 0px">
        <div class="card-content">
            <div class="card-body card-dashboard">
                <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1" role="grid" aria-describedby="Example1_info" style="">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Parent</th>
                        <th>Order</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->parent->name}}</td>
                                <td>{{$category->order}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->status == 1 ? 'Yes' : 'No'}}</td>
                                {{--<td width="15%">
                                    <div class="row">

                                        <div class="col-md-2 m-1">
                                            <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information" data-placement="left" href="{{route('notification.edit',$notification->id)}}" class="btn-pancil btn btn-outline-success" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-2 m-1">
                                            <a  role="button"
                                                data-id=""
                                                href="{{route('notification.show',$notification->id)}}"
                                                data-placement="right"
                                                class="showButton btn btn-outline-info"
                                                onclick=""><i class="la la-paper-plane"></i></a>
                                        </div>

                                        <div class="col-md-2 m-1">
                                            <a  role="button"
                                                data-id=""
                                                href="{{route('notification.show-all',$notification->id)}}"
                                                data-placement="right"
                                                class="showButton btn btn-outline-info"
                                                onclick=""><i class="la la-adn"></i></a>
                                        </div>

                                    </div>
                                </td>--}}
                            </tr>
                       @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>

@endsection




@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#Example1').DataTable({
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10
            });
        });

    </script>
@endpush
