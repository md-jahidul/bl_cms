@extends('layouts.admin')
@section('title', 'Faq')
@section('card_name', 'Faq')
@section('breadcrumb')
    <li class="breadcrumb-item ">Faq List</li>
@endsection
@section('action')
    <a href="{{ url("faq/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Faq
    </a>
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
                            <th width="25%">Question En</th>
                            <th width="25%">Answer Bn</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($faqs as $faq)
                                <tr>
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td>{{ $faq->title }}</td>
                                    <td>{{ $faq->question_en }}</td>
                                    <td>{{ $faq->answer_en }}</td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ url("faq/$faq->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("faq/destroy/$faq->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $faq->id }}" title="Delete">
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





