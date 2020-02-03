@extends('layouts.admin')
@section('title', 'Item list')
@section('card_name', 'Item list')
@section('breadcrumb')
    <li class="breadcrumb-item active">Item list</li>
@endsection
@section('action')
    <a href="{{ url("$route_slug") }}" class="btn btn-info round btn-glow px-2">Go back Section</a>
    <a href="{{ url("ecarrer-items/$parent_id/create") }}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
        Add New Item
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title pb-1"><strong>Item List</strong></h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="3%">SL</th>
                            <th>Title</th>                            
                            <th width="15%">Status</th>
                            <th width="22%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( !empty($all_items) )
                        @foreach($all_items as $key=> $items)
                            {{-- @php( $itemsType = str_replace(" ", "-", strtolower( $items->type->name ) )) --}}
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $items->title }}</td>
                                <td>{{ ($items->is_active == 1) ? 'Acive' : 'Inactive' }}</td>
                                <td class="text-center" width="22%">
                                    <a href="{{ url("ecarrer-items/$parent_id/$items->id/edit") }}" role="button" class="btn btn-outline-success border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="{{ url("ecarrer-items/$parent_id/destroy/$items->id") }}" role="button" class="btn btn-outline-success border-0" onclick="return confirm('Are you sure?');"><i class="la la-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@stop


