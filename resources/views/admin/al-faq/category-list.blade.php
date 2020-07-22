@extends('layouts.admin')
@section('title', 'Faq')
@section('card_name', 'Faq')
@section('breadcrumb')
    <li class="breadcrumb-item ">Faq List</li>
@endsection
@section('action')
{{--    <a href="{{ url("faq/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Faq--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Faq List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="25%">Title</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ url("faq/$category->slug") }}" role="button" class="btn-sm btn-info"><i class="la la-question" aria-hidden="true"></i> Questions</a>
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

@push('page-css')
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')

@endpush





