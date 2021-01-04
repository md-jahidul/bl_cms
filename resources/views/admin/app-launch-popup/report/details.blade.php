@extends('layouts.admin')
@section('title', 'Popup Purchase Detail')
@section('card_name', 'Popup Purchase Detail')

@section('breadcrumb')
    <li class="breadcrumb-item active">Popup Detail History</li>
@endsection

@section('action')
    <a href="{{ route('app-launch.report') }}" class="btn btn-primary round btn-glow px-2">
        <i class="la la-list"></i>
        Back to Report List
    </a>
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
                                <label class="control-label">MSISDN</label>
                                <input type="text" name="msisdn" placeholder="e.g: 019xxxxxxxx" class="form-control"
                                       value="{{\Illuminate\Support\Facades\Input::get('msisdn') ?? old('msisdn')}}">
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

                <div class="card-header">
                    <div class="row">

                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <td><strong>Popup Title</strong></td>
                                    <td colspan="5">{{$popup->title}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Popup Stat :</strong></td>
                                    <td>
                                        <span class="badge badge-info">
                                            Popup Proceed:
                                            {{ $popupPurchaseLogDetails->where('action_type', 'popup_continue')->count('action_type') ?? 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">
                                            Popup Cancel:
                                         {{ $popupPurchaseLogDetails->where('action_type', 'popup_cancel')->count('action_type') ?? 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">
                                            Total Buy:
                                            {{ $popupPurchaseLogDetails->where('action_type', 'buy_success')->count('action_type') ?? 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-warning">
                                            Total Buy Failure:
                                            {{ $popupPurchaseLogDetails->where('action_type', 'buy_failure')->count('action_type') ?? 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">
                                            Total Buy Cancel:
                                            {{ $popupPurchaseLogDetails->where('action_type', 'cancel')->count('action_type') ?? 0 }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="5%">SL</th>
                            <th width="10%">MSISDN</th>
                            <th width="12%">Action Type</th>
                            <th width="10%">Date</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($popupPurchaseLogDetails as $detail)
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td width="10%">{{ $detail->msisdn }}</td>
                                <td width="10%">{{ strtoupper($detail->action_type)}}</td>
                                <td width="10%">
                                    {{\Carbon\Carbon::parse($detail->created_at)->format('d-m-Y h:i A')}}
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

            $('#Example1').DataTable({
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [ 10, 25, 50, 75, 100, 200, 500],
                dom: 'B<"bottom"flp>rti',
                buttons: [
                    'csv', 'excel'
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

    </script>
@endpush
