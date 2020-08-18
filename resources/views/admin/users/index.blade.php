@extends('layouts.master-layout')

@section('main-content')
    <section class="content mt-3">

        <div class="row">
            <div class="col-12">
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                @if(session()->has('delete'))
                    <div class="alert alert-danger">
                        {{ session()->get('delete') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        {{--<div class="col-md-12">--}}
                            <h3 class="card-title float-left">Users</h3>
                            <button class="btn btn-success float-right" data-toggle="modal" data-target="#modal-default">Add User</button>
                        {{--</div>--}}

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th># S.L</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php($i = 0)
                                @foreach($users as $user)
                                    @php($i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ (!empty($user->role)) ? $user->role : 'N/A' }}</td>
                                        <td><a href="#" onclick="showEdit('{{$user->id}}','{{$user->name}}','{{$user->email}}','{{$user->role}}')" class="mr-3">
                                                <i class="fas fa-edit text-primary"></i>
                                            </a>
                                            <a href="#" onclick="showDelete('{{$user->id}}','{{$user->name}}')">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    {{--User Create Modal--}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="{{ url('users/store') }}" autocomplete="off">
                    <div class="modal-body">
                        <!-- general form elements -->
                        <div class="card">
                            <!-- form start -->
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">User Name</label>
                                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>

                                    <div class="form-group">
                                        <label>User Role</label>
                                        <select class="form-control" name="role">
                                            <option value="admin">Admin</option>
                                            <option value="editor">Editor</option>
                                            <option value="guest">Guest</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password:</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-info text-light">
                <h1><i class="glyphicon glyphicon-thumbs-up"></i>Update </h1>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form id="updateForm" role="form" action="" method="POST">
                <div class="modal-body">
                    <!-- general form elements -->
                    <div class="card">
                        <!-- form start -->
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input value="" type="text" class="form-control" name="name" id="username" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input value="" type="email" class="form-control" name="email" id="email" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="role">User Role</label>
                                    <select id="role" class="form-control" name="role">
                                        <option value="admin">Admin</option>
                                        <option value="editor">Editor</option>
                                        <option value="guest">Guest</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Old Password:</label>
                                    <input type="password" name="old_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                </div>
                            </div>
                            <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Modal -->

    <div class="modal fade" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-danger text-light">
                <h1><i class="glyphicon glyphicon-thumbs-up"></i>Delete</h1>
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

@stop

@push('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#users_data').DataTable();
        } );

        function showEdit(id,name,email,role){

            //to clear the url if its not given delete query will show bug when url is in edit
            var uri = window.location.toString();
            if (uri.indexOf("users/")) {
                var clean_uri = uri.substring(0, uri.indexOf("users/"));
                window.history.replaceState({}, document.title, clean_uri);
            }
            //to clear the url if its not given delete query will show bug when url is in edit

            $('#update').modal("show");
            $("#username").val(name);
            $("#email").val(email);
            $("#role").val(role);
            $('#updateForm').attr('action', 'users/update/'+id)
            $('#deleteID').attr('value',id)
        }

        function showDelete(id,name){

        //to clear the url if its not given delete query will show bug when url is in edit
        var uri = window.location.toString();
        if (uri.indexOf("users/")) {
            var clean_uri = uri.substring(0, uri.indexOf("users/"));
            window.history.replaceState({}, document.title, clean_uri);
        }
        //to clear the url if its not given delete query will show bug when url is in edit

        $('#danger').modal("show");
        $("#modal-text").html("Are you sure you want to Move this Tag <srtong class='text-danger'>( "+ name +" )</srtong> to the trash ?");
        $('#deleteForm').attr('action', 'users/destroy/'+id)
        $('#deleteID').attr('value',id)
    }

    </script>
@endpush
