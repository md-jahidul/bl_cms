@extends('layouts.admin')
@section('title', 'Campaign Detail')
@section('card_name', 'Campaign Detail')

@section('breadcrumb')
    <li class="breadcrumb-item active">Campaign Detail History</li>
@endsection

@section('action')
    <a href="{{ route('mybl-refer-and-earn.index') }}" class="btn btn-primary round btn-glow px-2">
        <i class="la la-list"></i>
        Back to Campaign
    </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-header">
                    <div>
                        <h3><strong>{{$campaignDetails->campaign_title}}</strong></h3>
                    </div><br>

                    <div>
                        <h5>Filter</h5>
                    </div>
                    <hr class="mt-0 mb-0">
                    <div class="row mb-1">
                        <div class="card-body">
                        <form id="filter-form" class="form">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label">Date Range</label>
                                    <input type="text" name="date_range" id="from" class="form-control datetime"
                                           placeholder="Pick Dates to filter" autocomplete="off">
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">MSISDN</label>
                                    <input type="text" name="msisdn" placeholder="e.g: 019xxxxxxxx" class="form-control"
                                           value="{{\Illuminate\Support\Facades\Input::get('msisdn') ?? old('msisdn')}}">
                                </div>
                                <div class="col-md-1">
                                    <br>
                                    <button type="submit" class="btn btn-info" value="search">
                                        <i class="ft ft-search"> </i> Search
                                    </button>
                                </div>

                                <div class="ml-2 col-md-3">
                                    <br>
                                    <button type="button" class="btn btn-warning" id="clear-filter">
                                        <i class="ft ft-crosshair"> </i> Clear Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    <div>
                        <h5>Campaign Stat</h5>
                    </div>
                    <hr class="mt-0">

                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card bg-gradient-directional-primary">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="icon-rocket success text-white font-large-2 float-left"></i>
                                            </div>
                                            <div class="media-body text-white text-right">
                                                <h3 class="text-white"><b>{{ $campaignDetails->total_referrers ?? 0 }}</b></h3>
                                                <span>Total Referrals</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card bg-gradient-directional-grey-blue">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="icon-star text-white font-large-2 float-left"></i>
                                            </div>
                                            <div class="media-body text-white text-right">
                                                <h3 class="text-white"><b>{{ $campaignDetails->total_referees ?? 0 }}</b></h3>
                                                <span>Total Referees</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card bg-gradient-directional-cyan">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="icon-like text-white font-large-2 float-left"></i>
                                            </div>
                                            <div class="media-body text-white text-right">
                                                <h3 class="text-white"><b>{{ $campaignDetails->total_success + $campaignDetails->total_claimed }}</b></h3>
                                                <span>Total Redeemed</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card bg-gradient-directional-success">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="icon-emoticon-smile text-white font-large-2 float-left"></i>
                                            </div>
                                            <div class="media-body text-white text-right">
                                                <h3 class="text-white"><b>{{ $campaignDetails->total_claimed ?? 0 }}</b></h3>
                                                <span>Total Claimed</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card bg-gradient-directional-warning">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="icon-paper-plane text-white font-large-2 float-left"></i>
                                            </div>
                                            <div class="media-body text-white text-right">
                                                <h3 class="text-white"><b>{{ $campaignDetails->total_invited }}</b></h3>
                                                <span>Total Invited</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="1%">SL</th>
                            <th width="10%">Referrals MSISDN</th>
                            <th width="12%">Referrals Code</th>

                            <th width="12%">Total Invited</th>
                            <th width="12%">Total Successful Refer</th>
                            <th width="12%">Total Claim</th>

                            <th width="10%">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($campaignDetails->referrers_info as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail['msisdn'] }}</td>
                                <td>{{ $detail['referral_code'] }}</td>

                                <td>{{ $detail['total_invited'] }}</td>
                                <td>{{ $detail['total_redeemed'] }}</td>
                                <td>{{ $detail['total_claimed'] }}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#large"
                                       data-id="{{ $detail['id'] }}"
                                       href="{{--{{ route('refer-and-earn.campaign.details', $data->id) }}--}}"
                                       role="button" class="btn-sm btn-bitbucket border-1 referee-details"> Referees List</a>
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
                            <h4 class="modal-title" id="myModalLabel17">Referees List</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="overflow-x:auto;">

                            <table class="table table-striped table-bordered dataTable"
                                   role="grid" aria-describedby="Example1_info" id="referee-info">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="10%">Referees MSISDN</th>
                                    <th width="10%">Referrals Code</th>
                                    <th width="10%">Referees MSISDN</th>
                                    <th width="12%">Status</th>
                                    <th width="10%">Referees Product Code</th>
                                    <th width="10%">Referees Reward Vol.</th>
                                    <th width="10%">Referrals Product Code</th>
                                    <th width="10%">Referrals Reward Vol.</th>
                                    <th width="10%">Invited Date & Time</th>
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
        @media (min-width: 1200px){
            .col-xl-3 {
                flex: 0 0 25%;
                max-width: 20% !important;
            }
        }
        .modal-lg {
            max-width: 95%; !important;
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

            $('.referee-details').click(function (){
                var refererId = $(this).attr('data-id');

                $("#referee-info").dataTable({
                    processing: true,
                    searching: false,
                    serverSide: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false,
                    lengthChange: true,
                    ajax: {
                        url: '{{ url('mybl-refer-and-earn/referee-details') }}' + "/" + refererId,
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
                            name: 'referee_msisdn',
                            width: "15%",
                            render: function (data, type, row) {
                                return row.referral.msisdn;
                            }
                        },
                        {
                            name: 'referee_msisdn',
                            width: "15%",
                            render: function (data, type, row) {
                                return row.referral.referral_code;
                            }
                        },
                        {
                            name: 'referee_msisdn',
                            width: "15%",
                            render: function (data, type, row) {
                                return row.referee_msisdn;
                            }
                        },
                        {
                            name: 'status',
                            width: "6%",
                            render: function (data, type, row) {
                                const status = row.status[0].toUpperCase() + row.status.substring(1);
                                let statusData = '';
                                if (row.status === 'redeemed') {
                                    statusData = `<span class="badge badge-info">`+status+`</span>`;
                                } else if (row.status === 'claimed') {
                                    statusData = `<span class="badge badge-success">`+status+`</span>`;
                                } else {
                                    statusData = `<span class="badge badge-warning">`+status+`</span>`;
                                }
                                return statusData;
                            }
                        },

                        {
                            name: 'referee_product_code',
                            width: "15%",
                            render: function (data, type, row) {

                                let dataInfo = "";
                                if (row.status === 'redeemed' || row.status === 'claimed') {
                                    dataInfo += "{{ $campaignDetails->referee_product_code }}"
                                }
                                return dataInfo;
                            }
                        },
                        {
                            name: 'referee_reward_vol',
                            width: "15%",
                            render: function (data, type, row) {
                                let dataInfo = "";
                                if (row.status === 'redeemed' || row.status === 'claimed') {
                                    dataInfo += "{{ $campaignDetails->referee_data }}"
                                }
                                return dataInfo;
                            }
                        },
                        {
                            name: 'referrer_product_code',
                            width: "15%",
                            render: function (data, type, row) {
                                let dataInfo = "";
                                if (row.status === 'claimed') {
                                    dataInfo += "{{ $campaignDetails->referrer_product_code }}";
                                }
                                return dataInfo;
                            }
                        },

                        {
                            name: 'referrer_reward_vol',
                            width: "15%",
                            render: function (data, type, row) {

                                let dataInfo = "";
                                if (row.status === 'claimed') {
                                    dataInfo += "{{ $campaignDetails->referrer_data }}";
                                }
                                return dataInfo;
                            }
                        },

                        {
                            name: 'created_at',
                            width: "10%",
                            render: function (data, type, row) {
                                return row.created_at;
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
