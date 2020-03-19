@extends('layouts.admin')
@section('title', 'About Career')
@section('card_name', 'About Career')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('about-career') }}"> About Career</a></li>
@endsection
@section('action')
    <a href="{{ url("about-career/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add About Career
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>About Career</strong></h4>
                    <table  id="Example1"  class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="25%">Title</th>
                            <th class="">Description</th>
                            <th class="">Child Item</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($aboutEcareers as $item)
                                @php $path = 'partner-offers-home'; @endphp
                                <tr>
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td>{{ $item->title_en }}</td>
                                    <td>{{ $item->description_en }}</td>
                                    <td><a href="{{ route('career-item.list', $item->id) }}" class="btn btn-outline-warning">Child Item</a></td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ url("about-career/$item->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
{{--                                        <a href="#" remove="{{ url("about-career/destroy/$item->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $item->id }}" title="Delete">--}}
{{--                                            <i class="la la-trash"></i>--}}
{{--                                        </a>--}}
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
    {{--    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">--}}
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script>


        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: false,
                searching: false,
                "pageLength": 10,
                "bDestroy": true,
            });
        });

    </script>
@endpush






