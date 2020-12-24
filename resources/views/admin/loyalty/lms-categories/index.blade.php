@extends('layouts.admin')
@section('title', 'LMS Offer Categories')
@section('card_name', 'LMS')
@section('breadcrumb')
    <li class="breadcrumb-item active">LMS Offer Categories List</li>
@endsection
@section('action')
    <a href="{{ url('las-offer-category/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Category
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title pb-1"><strong>LMS Offer Categories</strong></h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="3%">SL</th>
                            <th width="10%">Title</th>
                            <th width="40%">URL</th>
                            <th width="8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lmsCategories as $key=>$data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data->name_en }}</td>
                                <td>{{ $data->url_slug_en }}</td>
                                <td class="text-center">
                                    <a href="{{ url("las-offer-category/$data->id/edit") }}" role="button" class="btn btn-outline-success border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("las-offer-category/destroy/$data->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete the user">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@stop


