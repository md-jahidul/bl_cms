@extends('layouts.admin')
@section('title', 'Offer Category List')
@section('card_name', 'Offer Category List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('offer-categories') }}"> Offer Categories List</a></li>
    <li class="breadcrumb-item ">{{ ucfirst($type) }} Child Menu List</li>
@endsection
@section('action')
{{--    <a href="{{ route("offer-categories.create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Offer--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ (isset($type)) ? ucfirst($type) : 'Offer' }} Categories</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td><i class="icon-cursor-move icons"></i></td>
                            <th width="25%">Name</th>
                            <th width="25%">Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($offerCategories as $offerCategory)
                                @php $type = strtolower($type) @endphp
                                <tr data-index="{{ $offerCategory->id }}" data-position="{{ $offerCategory->display_order }}">
                                    <td width="3%" class="cursor-pointer"><i class="icon-cursor-move icons"></i></td>
                                    <td width="15%">{{ $offerCategory->name_en }} {!! $offerCategory->status == 0 ? '<span class="text-danger"><b>( Inactive )</b></span>' : '' !!}
                                        {!!  (strtolower($offerCategory->alias) == 'packages' || strtolower($offerCategory->alias) == 'others') ? "<a href='".route('child_menu', [$offerCategory->id, $offerCategory->alias])."' class='btn btn-outline-primary float-md-right'> Child Menu</a>" : '' !!}
                                    </td>
                                    <td width="20%">{{ $offerCategory->type->name ?? '' }}</td>
                                    <td width="3%" class="text-center">
                                        <a href="{{ url("offer-categories/$parent_id/$type/edit/$offerCategory->id") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
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
@endpush

@push('page-js')
    <script>
        var auto_save_url = "{{ url('offer-categories/sorted-data-save') }}";
    </script>
@endpush





