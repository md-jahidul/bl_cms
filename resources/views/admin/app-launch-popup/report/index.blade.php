@extends('layouts.admin')
@section('title', 'Popup Purchase Report')
@section('card_name', 'Popup Purchase Report')

@section('breadcrumb')
    <li class="breadcrumb-item active">Purchase List</li>
@endsection

@section('content')
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">Date Range</label>
                                <input type="text" required name="date_range" id="from" class="form-control datetime"
                                placeholder="Pick Dates to filter" autocomplete="off">
                            </div>
                            <div class="col-md-3">
                                <br>
                                <button type="submit" class="btn btn-info" value="search">
                                    <i class="ft ft-search"> </i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body card-dashboard">
                    {{-- alt-pagination no-footer dataTable --}}

                    <table class="table table-striped table-bordered" id="Example11" role="grid"
                           aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="5%">SL</th>
                            <th width="12%">Title</th>
                            <th width="25%">Product Code</th>
                            <th width="10%">Popup Proceed</th>
                            <th width="10%">Popup Cancel</th>
                            <th width="10%">Purchase</th>
                            <th width="10%">Purchase Fail</th>
                            <th width="10%">Cancel</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($popups as $popup)
                            @php
                                $purchaseLog = $popup->purchaseLog;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $popup->title }}</td>
                                <td>{{ $popup->product_code }}</td>
                                <td>{{ $purchaseLog->total_popup_continue ?? 0 }}</td>
                                <td>{{ $purchaseLog->total_popup_cancel ?? 0 }}</td>
                                <td>{{ $purchaseLog->total_buy ?? 0 }}</td>
                                <td>{{ $purchaseLog->total_buy_attempt ?? 0 }}</td>
                                <td>{{ $purchaseLog->total_cancel ?? 0 }}</td>
                                <td>
                                    <a href="{{route('app-launch.report-detail', $popup->id)}}"
                                       class="btn btn-sm btn-info">
                                        Details
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

@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">

    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }
    </style>
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>

    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script>
        $(document).ready(function () {

            $('.datetime').daterangepicker({
                timePicker: false,
                singleDatePicker: false,
                autoApply: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            $("#from").val("{{\Illuminate\Support\Facades\Input::get('date_range') ?? ''}}");

            $("#Example11").dataTable({
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [ 10, 25, 50, 75, 100, 200, 500],
                dom: 'Bflrtip',
                buttons: [
                    'csv', 'excel'
                ]
            });

        });

    </script>
@endpush
