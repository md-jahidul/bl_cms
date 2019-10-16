@extends('layouts.admin')
@section('title', 'Role List')
@section('card_name', 'Role List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Role List</li>
@endsection
@section('action')
    <a href="{{ url('authorize/roles/create') }}" class="btn btn-outline-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Role
    </a>
@endsection
@section('content')
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
                                    <th>ID</th>
                                    <th> Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ url('/' . Config("authorization.route-prefix") . '/roles/' . $item->id . '/edit') }}" class="border-0 btn btn-outline-primary"
                                               title="Edit Role"><span class="la la-pencil" aria-hidden="true"></span></a>

                                            @if($item->id > 2)
                                                {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => ['/' . Config("authorization.route-prefix") . '/roles', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::button('<span class="la la-trash" aria-hidden="true" title="Delete Role" />', array(
                                                        'type' => 'submit',
                                                        'class'   => "border-0 btn btn-outline-danger",
                                                        'title' => 'Delete Role',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
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
@stop



