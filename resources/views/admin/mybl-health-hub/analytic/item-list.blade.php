@extends('layouts.admin')
@section('title', 'Health Hub Item Analytics')
@section('card_name', 'Health Hub Item Analytics')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ route('health-hub.index') }}">Health Hub List</a>
    </li>
    <li class="breadcrumb-item active">Item Report List</li>
@endsection

@section('action')
    <a href="{{ route('health-hub.index') }}" class="btn btn-blue-grey  btn-glow px-2"><i class="la la-arrow-left"></i>
        Back to Health Hub Items
    </a>
@endsection

@section('content')
    <!--Health Hub Category Analytic Data-->
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <h4><strong>In App Health Hub Category Analytic Data</strong></h4><hr>
                    <form id="filter-form" class="form">
                        <div class="row pl-1 mb-1">
                            <div class="col-md-3">
                                <label class="control-label">Date Range</label>
                                <input type="text" name="date_range" id="date_range_feed_cat" class="form-control datetime"
                                       placeholder="Pick Dates to filter" autocomplete="off">
                            </div>
                            <div class="pl-1">
                                <br>
                                <button type="submit" name="excel_export" value="feed_cat_export"
                                        class="btn btn-outline-secondary" id="excel-export">
                                    <i class="la la-download"></i> Excel Export
                                </button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped table-bordered dataTable" id="healthHubCategory">
                        <thead>
                        <tr>
                            <th width="3%">SL</th>
                            <th>Item Name</th>
                            <th>Total Unique Hit</th>
                            <th>Total Hit</th>
                            <th width="12%">Details</th>
                        </tr>
                        </thead>
                        <tbody id="feedCatData">
                            <tr>
                                <td>1</td>
                                <td class="title">Health Hub</td>
                                <td class="unique_hit"></td>
                                <td class="total_hit_count"></td>
                                <td id="feedCatDetailsBtn">
                                    <a data-toggle="modal" data-target="#feedCatModal" href=""
                                       role="button" class="btn-sm btn-bitbucket border-1">Details</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

    <!--Health Hub Content Analytic Data-->
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <h4><strong>In App Health Hub Content Analytic Data</strong></h4><hr>
                    <form id="filter-form" class="form">
                        <div class="row pl-1 mb-1">
                            <div class="col-md-3">
                                <label class="control-label">Date Range</label>
                                <input type="text" name="date_range" id="date_range" class="form-control datetime"
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
                                <button type="submit" name="excel_export" value="items_export"
                                        class="btn btn-outline-secondary" id="excel-export">
                                    <i class="la la-download"></i> Excel Export
                                </button>
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
                            <th>Total Session Time (Sec)</th>
                                                            <th>Deeplink Hits</th>
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
                                <td>{{ $data['total_session_time'] }}</td>
                                                                <td>0</td>
                                <td>
                                    <a data-toggle="modal" data-target="#large"
                                       data-id="{{ $data['id'] }}"
                                       href="{{ route('refer-and-earn.campaign.details', $data['id']) }}"
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
                        <form id="filter-form" class="form">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <input type="hidden" name="item_id">
                                    <button type="button" name="excel_export" value="item_export_details"
                                            class="btn btn-outline-secondary" id="item_details_export">
                                        <i class="la la-download"></i> Excel Export
                                    </button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped table-bordered dataTable"
                               role="grid" aria-describedby="Example1_info" id="itemDetails">
                            <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="10%">MSISDN</th>
                                <th width="10%">Hit Count</th>
                                <th width="10%">Average Session Time (Sec)</th>
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

    {{--Modal Start Feed Category Details--}}
        <div class="col-lg-12 col-md-6 col-sm-12">
        <!-- Modal -->
        <div class="modal fade text-left" id="feedCatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Health Hub In App Clicked Msisdn</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="overflow-x:auto;">
                        <form id="filter-form" class="form">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <input type="hidden" name="feed_cat_id">
                                    <button type="button" name="excel_export" value="feed_cat_details_export"
                                            class="btn btn-outline-secondary" id="feed_cat_details_export">
                                        <i class="la la-download"></i> Excel Export
                                    </button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped table-bordered" id="feedCatDetailsTable">
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
    {{--Modal End Feed Category--}}

    <!-- Deeplink Analytic Data Start-->
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <h4><strong>Health Hub Deeplink Analytic Data</strong></h4><hr>
                    <form id="filter-form" class="form">
                        <div class="row pl-1 mb-1">
                            <div class="col-md-3">
                                <label class="control-label">Date Range</label>
                                <input type="text" name="date_range_deeplink" id="date_range_deeplink" class="form-control datetime"
                                       value="{{\Illuminate\Support\Facades\Input::get('date_range_deeplink') ?? old('date_range_deeplink')}}"
                                       placeholder="Pick Dates to filter" autocomplete="off">
                            </div>
                            <div class="pl-1">
                                <br>
                                <button type="submit" name="excel_export" value="deeplink_items_export"
                                        class="btn btn-outline-secondary" id="excel-export">
                                    <i class="la la-download"></i> Excel Export
                                </button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="3%">SL</th>
                            <th>Item Name</th>
                            <th>Total Unique Hit</th>
                            <th>Total Hit</th>
                            <th width="12%">Details</th>
                        </tr>
                        </thead>
                        <tbody id="deeplinkAnalyticData">
                            <tr>
                                <td>1</td>
                                <td class="title">Health Hub</td>
                                <td class="unique_hit"></td>
                                <td class="total_hit_count"></td>
                                <td id="feedCatDetailsBtn">
                                    <a data-toggle="modal" data-target="#deeplinkItemDetails" href=""
                                       role="button" class="btn-sm btn-bitbucket border-1">Details</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
    <!-- Deeplink Analytic Data End-->

    {{--Modal Deeplink Details Start--}}
        <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="modal fade text-left" id="deeplinkItemDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
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
                        <form id="filter-form" class="form">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <input type="hidden" name="deeplink_item_id">
                                    <button type="button" name="excel_export" value="deeplink_item_export_details"
                                            class="btn btn-outline-secondary" id="deeplink_item_details_export">
                                        <i class="la la-download"></i> Excel Export
                                    </button>
                                </div>
                            </div>
                        </form>
{{--                        <table class="table table-striped table-bordered dataTable"--}}
{{--                               role="grid" aria-describedby="Example1_info" id="deeplinkItemDetails">--}}
                        <table class="table table-striped table-bordered dataTable" id="deeplinkItemDetailsTable">
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
    {{--Modal Deeplink Details End--}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">

{{--    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">--}}
{{--    <link rel="stylesheet" type="text/css"--}}
{{--          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">--}}
{{--    <style>--}}
{{--        table.dataTable tbody td {--}}
{{--            max-height: 40px;--}}
{{--        }--}}
{{--    </style>--}}
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>

{{--    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>--}}
{{--    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>--}}
{{--    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"--}}
{{--            type="text/javascript"></script>--}}
{{--    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"--}}
{{--            type="text/javascript"></script>--}}
    <script>
        $(document).ready(function () {
            $('input[name="date_range"]').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY/MM/DD'
                },
            });
            $('input[name="date_range_deeplink"]').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY/MM/DD'
                },
            });
            function feedInAppHitCounts(){
                $.ajax({
                    // method: 'POST',
                    url: '{{ url('health-hub-category/in-app-analytic') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        date_range: function () {
                            return $('input[name="date_range"]').val();
                        }
                    },
                    success: function (result) {
                        // console.log(result)
                        // $("#healthHubCategory tbody").children().remove()

                        $('.title').text(result.title_en)
                        $('.unique_hit').text(result.total_unique_hit)
                        $('.total_hit_count').text(result.total_hit_count)
                        $('#feedCatDetailsBtn a').attr('data-id', result.id)
                    }
                });
            }
            feedInAppHitCounts()

            $('#date_range_feed_cat').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
                feedInAppHitCounts()
            });

            $('#date_range_feed_cat').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                feedInAppHitCounts()
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $('input[name="date_range_deeplink"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
            });

            $('input[name="date_range_deeplink"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });


            // Modal Inject Data
            $('#feedCatDetailsBtn a').click(function (){
                var feedCatId = $(this).attr('data-id');
                $('input[name="feed_cat_id"]').val(feedCatId)
                $("#feedCatDetailsTable").dataTable({
                    processing: true,
                    searching: false,
                    serverSide: true,
                    autoWidth: false,
                    pageLength: 5,
                    lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
                    ordering: false,
                    lengthChange: true,
                    ajax: {
                        url: '{{ url('health-hub-category/in-app-analytic-details') }}' + "/" + feedCatId,
                        data: {
                            date_range: $('input[name="date_range"]').val()
                        }
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
                                return "0" + row.msisdn;
                            }
                        },
                        {
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
                    $("#feedCatDetailsTable").dataTable().fnDestroy();
                })
            })


            {{--$('#item_details_export').on('click', function () {--}}
            {{--    var query = {--}}
            {{--        date_range: $('input[name="date_range"]').val(),--}}
            {{--        excel_export: $(this).val(),--}}
            {{--        item_id: $('input[name="item_id"]').val(),--}}
            {{--    }--}}
            {{--    var url = "{{URL::to('health-hub-analytic-data')}}?" + $.param(query)--}}
            {{--    window.location = url;--}}
            {{--});--}}

            $('#deeplink_item_details_export').on('click', function () {
                var query = {
                    date_range: $('input[name="date_range_deeplink"]').val(),
                    excel_export: $(this).val(),
                    item_id: $('input[name="deeplink_item_id"]').val(),
                }
                window.location = "{{URL::to('health-hub-deeplink/analytic')}}?" + $.param(query);
            });


            $('#feed_cat_details_export').on('click', function () {
                var query = {
                    date_range: $('input[name="date_range_feed_cat_details"]').val(),
                    excel_export: $(this).val(),
                    item_id: $('input[name="feed_cat_id"]').val(),
                }
                window.location = "{{URL::to('health-hub-category/in-app-analytic')}}?" + $.param(query);
            });

            {{--$('#clear-filter').click(function () {--}}
            {{--    $('input[name="date_range"]').val('')--}}
            {{--    $('input[name="msisdn"]').val('')--}}
            {{--    $('#filter-form').submit();--}}
            {{--})--}}


            // $('#clear-filter-deeplink').click(function () {
            //     $('input[name="date_range_deeplink"]').val('')
            //     $('input[name="msisdn"]').val('')
            //     $('#filter-form').submit();
            // })

            {{--// $('.datetime').daterangepicker({--}}
            {{--//     timePicker: false,--}}
            {{--//     singleDatePicker: false,--}}
            {{--//     autoApply: true,--}}
            {{--//     locale: {--}}
            {{--//         format: 'YYYY/MM/DD'--}}
            {{--//     }--}}
            {{--// });--}}

            {{--$('input[name="date_range"]').daterangepicker({--}}
            {{--    autoUpdateInput: false,--}}
            {{--    showDropdowns: true,--}}
            {{--    locale: {--}}
            {{--        cancelLabel: 'Clear',--}}
            {{--        format: 'YYYY/MM/DD'--}}
            {{--    },--}}
            {{--});--}}

            {{--$("#date_range").val("{{\Illuminate\Support\Facades\Input::get('date_range') ?? ''}}");--}}
            {{--$("#date_range_deeplink").val("{{\Illuminate\Support\Facades\Input::get('date_range_deeplink') ?? ''}}");--}}

            {{--$('.item-details').click(function (){--}}
            {{--    var itemId = $(this).attr('data-id');--}}
            {{--    $('input[name="item_id"]').val(itemId)--}}
            {{--    $("#itemDetails").dataTable({--}}
            {{--        processing: true,--}}
            {{--        searching: false,--}}
            {{--        serverSide: true,--}}
            {{--        autoWidth: false,--}}
            {{--        pageLength: 5,--}}
            {{--        lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],--}}
            {{--        ordering: false,--}}
            {{--        lengthChange: true,--}}
            {{--        ajax: {--}}
            {{--            url: '{{ url('health-hub-item-details') }}' + "/" + itemId,--}}
            {{--            data: {--}}
            {{--                date_range: $('input[name="date_range"]').val()--}}
            {{--            }--}}
            {{--        },--}}
            {{--        columns: [--}}
            {{--            {--}}
            {{--                name: 'sl',--}}
            {{--                width: "2%",--}}
            {{--                render: function () {--}}
            {{--                    return null;--}}
            {{--                }--}}
            {{--            },--}}
            {{--            {--}}
            {{--                name: 'msisdn',--}}
            {{--                width: "15%",--}}
            {{--                render: function (data, type, row) {--}}
            {{--                    return "0" + row.msisdn;--}}
            {{--                }--}}
            {{--            },--}}
            {{--            {--}}
            {{--                name: 'hit_count',--}}
            {{--                width: "15%",--}}
            {{--                render: function (data, type, row) {--}}
            {{--                    return row.hit_count;--}}
            {{--                }--}}
            {{--            },--}}
            {{--            {--}}
            {{--                name: 'avg_session_count',--}}
            {{--                width: "15%",--}}
            {{--                render: function (data, type, row) {--}}
            {{--                    return row.avg_session_count;--}}
            {{--                }--}}
            {{--            }--}}
            {{--        ],--}}
            {{--        "fnCreatedRow": function (row, data, index) {--}}
            {{--            $('td', row).eq(0).html(index + 1);--}}
            {{--        }--}}

            {{--    });--}}

            {{--    $('.modal').on('hidden.bs.modal', function () {--}}
            {{--        $("#itemDetails").dataTable().fnDestroy();--}}
            {{--    })--}}
            {{--})--}}


            $('input[name="date_range_deeplink"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
                deeplinkAnalytic()
            });

            $('input[name="date_range_deeplink"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                deeplinkAnalytic()
            });

            function deeplinkAnalytic(){
                $.ajax({
                    // method: 'POST',
                    url: '{{ url('health-hub-deeplink/analytic') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        date_range_deeplink: function () {
                            return $('input[name="date_range_deeplink"]').val();
                        }
                    },
                    success: function (result) {
                        $('#deeplinkAnalyticData .title').text(result.title_en)
                        $('#deeplinkAnalyticData .unique_hit').text(result.total_unique_hit)
                        $('#deeplinkAnalyticData .total_hit_count').text(result.total_hit_count)
                        $('#deeplinkAnalyticData #feedCatDetailsBtn a').attr('data-id', result.id)
                    }
                });
            }
            deeplinkAnalytic()

            $('#deeplinkAnalyticData a').click(function (){
                // alert('Hi')
                var itemId = $(this).attr('data-id');
                $('input[name="deeplink_item_id"]').val(itemId)
                $("#deeplinkItemDetailsTable").dataTable({
                    processing: true,
                    searching: false,
                    serverSide: true,
                    autoWidth: false,
                    pageLength: 5,
                    lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
                    ordering: false,
                    lengthChange: true,
                    ajax: {
                        url: '{{ url('health-hub-deeplink/analytic-details/') }}' + "/" + itemId,
                        data: {
                            date_range: $('input[name="date_range_deeplink"]').val()
                        }
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
                                return "0" + row.msisdn;
                            }
                        },
                        {
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
                    $("#deeplinkItemDetailsTable").dataTable().fnDestroy();
                })
            })
        });

    </script>
@endpush
