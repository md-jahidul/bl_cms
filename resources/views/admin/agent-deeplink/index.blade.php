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
                        <tr style="text-align: center">
                            <th width="10%">ID</th>
                            <th width="10%">Name</th>
                            <th width="10%">Msisdn</th>
                            <th width="10%">Email</th>
                            <th width="10%">Address</th>
                            <th width="10%">Status</th>
                            <th width="30%">Action</th>
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
                                <td width="30%">
                                    <div class="col-md-12">
                                        <a role="button" title="Active Or Inactive"
                                           href="{{route('deeplink.agent.statusChange',$list->id)}}"
                                           class="btn btn-sm btn-outline-warning mb-1">
                                            @if($list->is_active==1)
                                                <i class="la la-toggle-on"></i>
                                            @else
                                                <i class="la la-toggle-off"></i>
                                            @endif

                                        </a>
                                        <a role="button" title="Edit" href="{{route('deeplink.agent.edit',$list->id)}}"
                                           class="btn btn-sm btn-outline-success  mb-1">
                                            <i class="la la-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-danger  mb-1"
                                           onclick="showDelete('{{$list->id}}')" title="delete">
                                            <i class="la la-trash"></i>
                                        </a>
                                        <a href="{{route('deeplink.agent.deeplink.list',$list->id)}}"
                                           class="btn btn-sm btn-outline-success  mb-1" title="View Detail">
                                            <i class="la la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-success  mb-1" title="Send mail"
                                           data-toggle="modal" data-target="#sendEmail"
                                           onclick="return agentEmailSet('{{$list->email}}','{{$list->name}}')">
                                            <i class="la la-send"></i>
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
    {{--==============================Email Modal ======================================--}}

    <div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-success text-light">
                    <h2 style="color:#FFF"><i class="la la-pencil-square"></i> <b>Send email</b></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <form id="deleteForm" action="{{ route('agent.deeplink.emailsend') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" readonly required>
                            <input type="hidden" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Subject:</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <textarea id="email-body" name="body"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info pull-left" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-outline-success pull-left">Send</button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{--==============================Email Modal ======================================--}}

@endsection




@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        div#Example1_length {
            margin-bottom: -47px;
        }

    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $("textarea#email-body").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']]
                ],
                height: 300
            })
        })

        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Blfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10
            });
        });

        function showDelete(id) {

            //to clear the url if its not given delete query will show bug when url is in edit
            let uri = window.location.toString();
            if (uri.indexOf("destroy/")) {
                let clean_uri = uri.substring(0, uri.indexOf("users/"));
                window.history.replaceState({}, document.title, clean_uri);
            }
            //to clear the url if its not given delete query will show bug when url is in edit

            $('#danger').modal("show");
            $("#modal-text").html("Are you sure you want to Remove this Agent?");
            $('#deleteForm').attr('action', 'destroy/' + id)
            $('#deleteID').attr('value', id)
        }

        function agentEmailSet(emailId, name) {
            $('#email').empty();
            $('#subject').empty();
            $('#name').empty();
            $('#email').val(emailId);
            $('#subject').val(name);
            $('#name').val(name);
        }
    </script>
@endpush

