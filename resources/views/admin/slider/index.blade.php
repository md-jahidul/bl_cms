@extends('layouts.master-layout')

@section('main-content')
    <section class="content mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{--<div class="col-md-12">--}}
                        <h3 class="card-title float-left">Slider List</h3>
                        <a href="{{ url('sliders/create') }}" class="btn btn-success float-right" >Add Slider</a>
                        {{--</div>--}}

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th># S.L</th>
                                <th>Title</th>
                                <th>Slider Type</th>
                                <th>description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 0)
                            @foreach($sliders as $slider)
                                @php($i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>{{ $slider->slider_type['name'] }}</td>
                                    <td><a href="{{ url('sliders/'.$slider->id.'/edit') }}" class="mr-3"><i class="fas fa-edit text-primary"></i></a> <a href="#" ><i class="fas fa-trash text-danger"></i></a></td>
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
                                        <option value="1">Admin</option>
                                        <option value="2">Editor</option>
                                        <option value="3">Guest</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
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
@stop