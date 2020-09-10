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
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="20%">Question</th>
                            <th width="30%">Options</th>
                            <th width="10%">Type</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach($questions as $qs)
                            @php $options = json_decode($qs->answers_en) @endphp
                        <tr data-index="{{ $qs->id }}" data-position="{{ $qs->sort }}">
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <td>{{ $qs->question_en }} {!! $qs->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                            <td>
                                @if($qs->type == 1)
                                    @foreach($options as $op)
                                        <strong><span class="badge badge-secondary badge-pill">{{ $op }}</span></strong>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $qs->type == 1 ? 'Radio' : 'Textarea' }}</td>
                            <td width="20%" class="text-right">
                                <a href="{{ url('customer-feedback/edit-question/'.$qs->id) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                <a href="#" remove="{{ url('customer-feedback/question-delete/'.$qs->id) }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $qs->id }}" title="Delete">
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
<link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
<style>
    #sortable tr td{
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/switch.css') }}">
@endpush

@push('page-js')
<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>
<script>
    var auto_save_url = "{{ url('customer-feedback/question-sortable') }}";
</script>
@endpush





