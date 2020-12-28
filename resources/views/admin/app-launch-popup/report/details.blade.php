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
                                    <td>Popup Proceed: {{ $popupPurchaseLog->total_popup_continue ?? 0 }}</td>
                                    <td>Popup Cancel: {{ $popupPurchaseLog->total_popup_cancel ?? 0 }}</td>
                                    <td>Total Buy: {{ $popupPurchaseLog->total_buy ?? 0 }}</td>
                                    <td>Total Buy Failure: {{ $popupPurchaseLog->total_buy_attempt ?? 0 }}</td>
                                    <td>Total Buy Cancel: {{ $popupPurchaseLog->total_cancel ?? 0 }}</td>
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
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#Example1').DataTable({
                // dom: 'Bfrtip',
                // buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10
            });
        });

    </script>
@endpush
