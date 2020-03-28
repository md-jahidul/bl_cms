@extends('layouts.admin')
@section('title', 'User List')
@section('card_name', 'User List')
@section('breadcrumb')
    <li class="breadcrumb-item active">User List</li>
@endsection
@section('action')
    <a href="{{ url('authorize/users/create') }}" class="btn btn-outline-primary  round btn-glow px-2"><i class="la la-user-plus"></i>
        Add User
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
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                @php
                                    $roles_dom = '';
                                     foreach($item->roles as $r){
                                        $roles_dom .=   '<span class="badge badge-success badge-pill mr-1">' . $r->name . '</span>';
                                     }
                                @endphp

                                <tr data-id="{{ $item->id  }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{!!  $roles_dom !!}</td>
                                    <td>
{{--                                        @if($item->id !=  5 && $item->id != Auth::user()->id)--}}
{{--                                            <a href="{{ url('/' . Config("authorization.route-prefix") . '/users/' . $item->id . '/edit') }}" role="button"--}}
{{--                                           class=" border-0"><i class="la la-pencil" aria-hidden="true"></i></a>--}}
{{--                                        @endif--}}

                                        @if($item->id != Auth::user()->id )
                                            @if($item->id !=  $superAdmin['assetlite_super_Admin'] && $item->id != $superAdmin['lead_super_Admin'])
                                                <a href="{{ url('/' . Config("authorization.route-prefix") . '/users/' . $item->id . '/edit') }}" role="button"
                                                   class=" border-0"><i class="la la-pencil" aria-hidden="true"></i></a>

                                                {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => ['/' . Config("authorization.route-prefix") . '/users', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::button('<span class="la la-trash" aria-hidden="true" title="Delete User" />', array(
                                                        'type'    => 'submit',
                                                        'class'   => "border-0 ",
                                                        'title'   => 'Delete User',
                                                        'onclick' =>'return confirm("Confirm delete?")'

                                                )) !!}
                                                {!! Form::close() !!}
                                            @endif
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

@push('page-js')

@endpush







