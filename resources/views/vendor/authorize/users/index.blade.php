{{--@extends('vendor.authorize.layouts.auth')--}}

{{--@section('content')--}}
{{--    <div class="panel panel-default">--}}
{{--        <div class="panel-heading">Users</div>--}}
{{--        <div class="panel-body">--}}
{{--            <br/>--}}
{{--            <div class="table-responsive">--}}
{{--                <table class="table table-borderless">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>ID</th>--}}
{{--                        <th>Name</th>--}}
{{--                        <th>Email</th>--}}
{{--                        <th>Role</th>--}}
{{--                        <th>Actions</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($users as $item)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $item->id }}</td>--}}
{{--                            <td>{{ $item->name }}</td>--}}
{{--                            <td>{{ $item->email }}</td>--}}
{{--                            <td>{{ $item->role['name'] }}</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{ url('/' . Config("authorization.route-prefix") . '/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"--}}
{{--                                   title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>--}}

{{--                                @if($item->id != Auth::user()->id)--}}
{{--                                {!! Form::open([--}}
{{--                                    'method'=>'DELETE',--}}
{{--                                    'url' => ['/' . Config("authorization.route-prefix") . '/users', $item->id],--}}
{{--                                    'style' => 'display:inline'--}}
{{--                                ]) !!}--}}
{{--                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete User" />', array(--}}
{{--                                        'type' => 'submit',--}}
{{--                                        'class' => 'btn btn-danger btn-xs',--}}
{{--                                        'title' => 'Delete User',--}}
{{--                                        'onclick'=>'return confirm("Confirm delete?")'--}}
{{--                                )) !!}--}}
{{--                                {!! Form::close() !!}--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <div class="pagination-wrapper"> {!! $users->render() !!} </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}


@extends('layouts.admin')
@section('title', 'User List')
@section('card_name', 'User List')
@section('breadcrumb')
    <li class="breadcrumb-item active">User List</li>
@endsection
@section('action')
    <a href="{{ url('questions/create') }}" class="btn btn-outline-primary  round btn-glow px-2"><i class="la la-user-plus"></i>
        Add User
    </a>
@endsection
@section('content')
{{--    <section>--}}
{{--        <div class="card">--}}
{{--            <div class="card-content show">--}}
{{--                <div class="card-body card-dashboard">--}}
{{--                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"--}}
{{--                           id="Example1" role="grid" aria-describedby="Example1_info" style="">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>#</th>--}}
{{--                            <th>Name</th>--}}
{{--                            <th>Email</th>--}}
{{--                            <th>Role</th>--}}
{{--                            <th>Actions</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($users as $item)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $loop->iteration }}</td>--}}
{{--                                <td>{{ $item->name }}</td>--}}
{{--                                <td>{{ $item->email }}</td>--}}
{{--                                <td>{{ $item->role['name'] }}</td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{ url('/' . Config("authorization.route-prefix") . '/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"--}}
{{--                                       title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>--}}
{{--                                    <a href="{{ url("quick-launch/->id/edit") }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>--}}
{{--                                    @if($item->id != Auth::user()->id)--}}
{{--                                        {!! Form::open([--}}
{{--                                            'method'=>'DELETE',--}}
{{--                                            'url' => ['/' . Config("authorization.route-prefix") . '/users', $item->id],--}}
{{--                                            'style' => 'display:inline'--}}
{{--                                        ]) !!}--}}
{{--                                        {!! Form::button('<span class="la la-trash" aria-hidden="true" title="Delete User" />', array(--}}
{{--                                                'type' => 'submit',--}}
{{--                                                'class' => 'btn btn-danger btn-xs',--}}
{{--                                                'title' => 'Delete User',--}}
{{--                                                'onclick'=>'return confirm("Confirm delete?")'--}}
{{--                                        )) !!}--}}


{{--                                        <a href="#" remove="{{ url("quick-launch/destroy/->id") }}" class="border-0 btn btn-outline-danger delete_btn" title="Delete the user">--}}
{{--                                            <i class="la la-trash"></i>--}}
{{--                                        </a>--}}

{{--                                        {!! Form::close() !!}--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </section>--}}

<!-- Base style table -->

{{--<div class="content-body">--}}

    <section id="configuration">
    <div class="">
        <div class="col-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role['name'] }}</td>
                                    <td>
{{--                                        <a href="{{ url('/' . Config("authorization.route-prefix") . '/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"--}}
{{--                                           title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>--}}
                                        <a href="{{ url('/' . Config("authorization.route-prefix") . '/users/' . $item->id . '/edit') }}" role="button"
                                           class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        @if($item->id != Auth::user()->id)
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/' . Config("authorization.route-prefix") . '/users', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<span class="la la-trash" aria-hidden="true" title="Delete User" />', array(
                                                    'type'    => 'submit',
                                                    'class'   => "border-0 btn btn-outline-danger",
                                                    'title'   => 'Delete User',
                                                    'onclick' =>'return confirm("Confirm delete?")'

                                            )) !!}
{{--                                            'onclick'=>'return confirm("Confirm delete?")'--}}

{{--                                            <a href="#" remove="{{ url('/' . Config("authorization.route-prefix") . '/users', $item->id) }}" data-id="{{ $item->id }}"--}}
{{--                                               class="border-0 btn btn-outline-danger delete_btn" title="Delete the user">--}}
{{--                                                <i class="la la-trash"></i>--}}
{{--                                            </a>--}}

                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{--</div>--}}

@stop

@push('page-js')
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#Example1').DataTable({--}}
{{--                dom: 'Bfrtip',--}}
{{--                buttons: [--}}
{{--                    {--}}
{{--                        extend: 'copy', className: 'copyButton',--}}
{{--                        exportOptions: {--}}
{{--                            columns: [0, 1, 2, 3]--}}
{{--                        }--}}
{{--                    },--}}
{{--                    {--}}
{{--                        extend: 'excel', className: 'excel',--}}
{{--                        exportOptions: {--}}
{{--                            columns: [0, 1, 2, 3]--}}
{{--                        }--}}
{{--                    },--}}
{{--                    {--}}
{{--                        extend: 'pdf', className: 'pdf', "charset": "utf-8",--}}
{{--                        exportOptions: {--}}
{{--                            columns: [0, 1, 2, 3]--}}
{{--                        }--}}
{{--                    },--}}
{{--                    {--}}
{{--                        extend: 'print', className: 'print',--}}
{{--                        exportOptions: {--}}
{{--                            columns: [0, 1, 2, 3]--}}
{{--                        }--}}
{{--                    },--}}
{{--                ],--}}
{{--                paging: false,--}}
{{--                searching: false,--}}
{{--                "bDestroy": true,--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
@endpush







