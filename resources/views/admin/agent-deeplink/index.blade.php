@extends('layouts.admin')
@section('title', 'Agent')
@section('card_name', 'Agent')
@section('breadcrumb')
    <li class="breadcrumb-item active">Agent List</li>
@endsection
@section('action')
    <a href="{{route('deeplink.agent.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Agent
    </a>
@endsection
@section('content')
    <section>

        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
{{--                    alt-pagination no-footer dataTable--}}
                    <table class="table table-striped table-bordered "
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="10%">Name</th>
                            <th width="10%">Msisdn</th>
                            <th width="10%">Email</th>
                            <th width="10%">Address</th>
                            <th width="10%">Status</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $sl=1; @endphp
                        @foreach ($agent as $list)
                            <tr>
                                <td width="5%">{{$sl++}}</td>
                                <td width="10%">
                                    {{$list->name}}
                                </td>
                                <td width="10%">
                                <a href="{{route('deeplink.agent.edit',$list->id)}}">
                                    {{(empty($list->msisdn)?'N/A':$list->msisdn)}}
                                </a>
                                </td>
                                <td width="10%">{{(empty($list->email)?'N/A':$list->email)}}</td>
                                <td width="10%">{{(empty($list->address)?'N/A':$list->address)}}</td>
                                <td width="10%">
                                    @if($list->is_active==1)
                                <span class="badge badge-success">Active</span>
                                  @else
                                        <span class="badge badge-warning">Inactive</span>
                                 @endif

                                </td>
                                <td width="25%">
                                    <div class="row justify-content-md-center no-gutters">
                                            <a role="button" title="Active Or Inactive" href="{{route('deeplink.agent.statusChange',$list->id)}}"
                                               class="btn btn-sm btn-outline-warning">
                                                @if($list->is_active==1)
                                                    <i class="la la-toggle-on"></i>
                                                @else
                                                    <i class="la la-toggle-off"></i>
                                                @endif

                                            </a>
                                            <a role="button" title="Edit" href="{{route('deeplink.agent.edit',$list->id)}}" class="btn btn-sm btn-outline-success ml-1 mr-1" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-danger  mr-1" onclick="showDelete('{{$list->id}}')" >
                                                <i class="la la-trash"></i>
                                            </a>
                                        <a href="{{route('deeplink.agent.deeplink.list',$list->id)}}" class="btn btn-sm btn-outline-success">
                                            <i class="la la-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </section>


    <div class="modal fade" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-danger text-light">
                    <h1 style="color:#FFF"><i class="glyphicon glyphicon-thumbs-up"></i>Delete</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <form id="deleteForm" action="" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="modal-text" class="text-center font-weight-bold "></p>
                        <input name="id" id="deleteID" type="hidden" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info pull-left" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-outline-danger pull-left">Delete</button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Modal -->


@endsection




@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style></style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script>




        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10
            });
        });
        function showDelete(id){

            //to clear the url if its not given delete query will show bug when url is in edit
            let uri = window.location.toString();
            if (uri.indexOf("destroy/")) {
                let clean_uri = uri.substring(0, uri.indexOf("users/"));
                window.history.replaceState({}, document.title, clean_uri);
            }
            //to clear the url if its not given delete query will show bug when url is in edit

            $('#danger').modal("show");
            $("#modal-text").html("Are you sure you want to Remove this Agent?");
            $('#deleteForm').attr('action', 'destroy/'+id)
            $('#deleteID').attr('value',id)
        }
    </script>
@endpush

