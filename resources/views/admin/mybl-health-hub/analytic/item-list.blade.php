@extends('layouts.admin')
@section('title', 'Refer And Earn Analytics')
@section('card_name', 'Refer And Earn Analytics')
@section('breadcrumb')
    <li class="breadcrumb-item active">List</li>
@endsection

@section('action')
    <a href="{{ route('health-hub.index') }}" class="btn btn-blue-grey  btn-glow px-2"><i class="la la-arrow-left"></i>
        Back to Health Hub Items
    </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <form id="filter-form" class="form">
                        <div class="row pl-1 mb-1">
                            <div class="col-md-3">
                                <label class="control-label">Date Range</label>
                                <input type="text" name="date_range" id="from" class="form-control datetime"
                                       value="{{\Illuminate\Support\Facades\Input::get('date_range') ?? old('date_range')}}"
                                       placeholder="Pick Dates to filter" autocomplete="off">
                            </div>
                            <div class="pl-1">
                                <br>
                                <button type="submit" class="btn btn-outline-info" value="search">
                                    <i class="ft ft-search"> </i> Search
                                </button>
                            </div>
                            <div class="pl-1">
                                <br>
                                <button type="button" class="btn btn-outline-warning" id="clear-filter">
                                    <i class="ft ft-remo"> </i> Clear Filter
                                </button>
                            </div>
                            <div class="pl-1">
                                <br>
                                <a href="#" class="btn btn-outline-primary" id="items-export">
                                    <i class="ft ft-download"> </i> Excel Export
                                </a>
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                            <tr>
                                <th width="3%">SL</th>
                                <th>Icon</th>
                                <th>Item Name</th>
                                <th>Total Unique Hit</th>
                                <th>Total Hit</th>
{{--                                <th>Total Session Time</th>--}}
{{--                                <th>Deeplink Hits</th>--}}
                                <th width="12%">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($itemsAnalyticData as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset($data['icon']) }}" alt="Icon Image" width="45" height="45">
                                </td>
                                <td>{{ $data['title_en'] }}</td>
                                <td>{{ $data['total_unique_hit'] }}</td>
                                <td>{{ $data['total_hit_count'] }}</td>
{{--                                <td>{{ $data['total_session_time'] }}</td>--}}
{{--                                <td>0</td>--}}
                                <td>
                                    <a data-toggle="modal" data-target="#large"
                                       data-id="{{ $data['id'] }}"
                                       href="{{--{{ route('refer-and-earn.campaign.details', $data->id) }}--}}"
                                       role="button" class="btn-sm btn-bitbucket border-1 item-details">Item Details</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

    {{--Modal Start--}}
    <div class="col-lg-12 col-md-6 col-sm-12">
        <!-- Modal -->
        <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Item Analytic</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="overflow-x:auto;">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <button type="submit" name="export_type" value="xlsx" class="btn btn-outline-primary"><i
                                        class="la la-file-excel-o"></i> Excel
                                </button>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered dataTable"
                               role="grid" aria-describedby="Example1_info" id="referee-info">
                            <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="10%">MSISDN</th>
                                <th width="10%">Hit Count</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Modal End--}}
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
            $('#items-export').click(function () {
                alert("Hii");
            })

            $('#clear-filter').click(function () {
                $('input[name="date_range"]').val('')
                $('input[name="msisdn"]').val('')
                $('#filter-form').submit();
            })

            $('.datetime').daterangepicker({
                timePicker: false,
                singleDatePicker: false,
                autoApply: true,
                locale: {
                    format: 'YYYY/MM/DD'
                }
            });

            $("#from").val("{{\Illuminate\Support\Facades\Input::get('date_range') ?? ''}}");

            $('#Example1').DataTable({
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [ 10, 25, 50, 75, 100, 200, 500],
                // dom: 'Bflrtip',
                // buttons: [
                //     'csv', 'excel'
                // ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });

            $('.item-details').click(function (){
                var itemId = $(this).attr('data-id');
                $("#referee-info").dataTable({
                    processing: true,
                    searching: false,
                    serverSide: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false,
                    lengthChange: true,
                    ajax: {
                        url: '{{ url('health-hub-item-details') }}' + "/" + itemId,
                        data: {}
                    },
                    columns: [
                        {
                            name: 'sl',
                            width: "2%",
                            render: function () {
                                return null;
                            }
                        },
                        {
                            name: 'msisdn',
                            width: "15%",
                            render: function (data, type, row) {
                                return row.msisdn;
                            }
                        },                        {
                            name: 'hit_count',
                            width: "15%",
                            render: function (data, type, row) {
                                return row.hit_count;
                            }
                        }
                    ],
                    "fnCreatedRow": function (row, data, index) {
                        $('td', row).eq(0).html(index + 1);
                    }

                });

                $('.modal').on('hidden.bs.modal', function () {
                    $("#referee-info").dataTable().fnDestroy();
                })
            })
        });

    </script>
@endpush
