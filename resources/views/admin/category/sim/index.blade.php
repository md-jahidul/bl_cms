@extends('layouts.admin')
@section('title', 'Slider List')
@section('card_name', 'Slider List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Slider List</li>
@endsection
@section('action')
    <!-- <a href="{{ url('sliders/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Slider
    </a> -->
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title pb-1"><strong>SIM Categories</strong></h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th width="22%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($simCategories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td class="text-center" width="22%">
{{--                                    <a href="{{ url("sliders/$category->id/edit") }}" role="button" class="btn btn-outline-success border-0"><i class="la la-pencil" aria-hidden="true"></i></a>--}}
                                    <a href="" class="btn btn-outline-warning"><i class="la la-image"></i> Offers <span class="ml-1 badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{--{{ $childNumber }}--}}</span></a>
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


