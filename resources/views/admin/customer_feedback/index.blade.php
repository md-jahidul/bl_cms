@extends('layouts.admin')
@section('title', 'Customer Feedback Questions')
@section('card_name', 'Customer Feedback Questions')
@section('breadcrumb')
<li class="breadcrumb-item ">Question List</li>
@endsection

@section('action')
<a href="{{ url('customer-feedback/add-question') }}" class="btn btn-primary round btn-glow"><i class="la la-plus"></i>
    Add Question
</a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h4 class="pb-1"><strong>Question List</strong></h4>
                <table class="table table-hover table-xl mb-0">
                    <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="20%">Question</th>
                            <th width="30%">Answer</th>
                            <th width="10%">Type</th>
                            <th width="10%">Display</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $qs)
                        <tr>
                            <td width="3%"></td>
                            <td>{{ $qs->question_en }}</td>
                            <td>{{ $qs->answers_en }}</td>
                            <td>{{ $qs->type == 1 ? 'Radio' : 'text' }}</td>
                            <td>
                                <input type="checkbox" class="switch" value="{{ $qs->id }}" data-group-cls="btn-group-sm"/>
                            </td>
                            <td width="20%" class="text-center">
                                <a href="{{ url('customer-feedback/edit-question/'.$qs->id) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                <a href="#" remove="{{ url('customer-feedback/delete-question/'.$qs->id) }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $qs->id }}" title="Delete">
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
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/switch.css') }}">

@endpush

@push('page-js')
<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">

$(function () {
    $('.switch:checkbox').checkboxpicker();
});

</script>
@endpush





