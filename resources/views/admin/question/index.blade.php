{{--@extends('layouts.master-layout')--}}

{{--@section('main-content')--}}
    {{--<section class="content mt-3">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header">--}}
                        {{--<div class="col-md-12">--}}
                        {{--<h3 class="card-title float-left">Question List</h3>--}}
                        {{--<a href="{{ url('question/create') }}" class="btn btn-success float-right" >Add Question</a>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<!-- /.card-header -->--}}
                    {{--<div class="card-body">--}}
                        {{--<table id="example1" class="table table-bordered table-hover">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th># S.L</th>--}}
                                {{--<th>Question</th>--}}
                                {{--<th>Point</th>--}}
                                {{--<th>Tag</th>--}}
                                {{--<th>Action</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@php($i = 0)--}}
                            {{--@foreach($questions as $question)--}}
                                {{--@php($i++)--}}
                                {{--<tr>--}}
                                    {{--<td>{{ $i }}</td>--}}
                                    {{--<td>{{ $question->question_text }}</td>--}}
                                    {{--<td>{{ $question->point }}</td>--}}
                                    {{--<td>{{ $question->tag['title'] }}</td>--}}
                                    {{--<td><a href="{{ url('question/edit/'.$question->id) }}" class="mr-3"><i class="fas fa-edit text-primary"></i></a> <a href="#" ><i class="fas fa-trash text-danger"></i></a></td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}

                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                    {{--<!-- /.card-body -->--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- /.col -->--}}
        {{--</div>--}}
        {{--<!-- /.row -->--}}
    {{--</section>--}}

    {{--User Create Modal--}}
    {{--<div class="modal fade" id="modal-default">--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<h4 class="modal-title">New User</h4>--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                {{--</div>--}}

                {{--<form role="form" action="{{ url('users/store') }}" autocomplete="off">--}}
                    {{--<div class="modal-body">--}}
                        {{--<!-- general form elements -->--}}
                        {{--<div class="card">--}}
                            {{--<!-- form start -->--}}
                            {{--@csrf--}}
                            {{--<div class="card-body">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="exampleInputEmail1">User Name</label>--}}
                                    {{--<input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter email">--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="exampleInputEmail1">Email address</label>--}}
                                    {{--<input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label>User Role</label>--}}
                                    {{--<select class="form-control" name="role">--}}
                                        {{--<option value="1">Admin</option>--}}
                                        {{--<option value="2">Editor</option>--}}
                                        {{--<option value="3">Guest</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label for="exampleInputPassword1">Password</label>--}}
                                    {{--<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<!-- /.card-body -->--}}
                        {{--</div>--}}
                        {{--<!-- /.card -->--}}
                    {{--</div>--}}
                    {{--<div class="modal-footer justify-content-between">--}}
                        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                        {{--<button type="submit" class="btn btn-primary">Save changes</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
            {{--<!-- /.modal-content -->--}}
        {{--</div>--}}
        {{--<!-- /.modal-dialog -->--}}
    {{--</div>--}}
{{--@stop--}}




@extends('layouts.admin')
@section('title', 'questions List')
@section('card_name', 'Question List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Questions List</li>
@endsection
@section('action')
    <a href="{{ url('questions/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Questions
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">


                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th># S.L</th>
                            <th>Question</th>
                            <th>Point</th>
                            <th>Tag</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 0)
                        @foreach($questions as $question)
                            @php($i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $question->question_text }}</td>
                                <td>{{ $question->point }}</td>
                                <td>{{ $question->tag['title'] }}</td>
                                <td><a href="{{ url('question/edit/'.$question->id) }}" class="mr-3"><i class="fas fa-edit text-primary"></i></a> <a href="#" ><i class="fas fa-trash text-danger"></i></a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </section>

@stop

@push('page-js')
    <script>
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf', "charset": "utf-8",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

    </script>
@endpush




