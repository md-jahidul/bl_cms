@extends('layouts.admin')
@section('title', 'Popup Purchase Detail')
@section('card_name', 'Popup Purchase Detail')

@section('breadcrumb')
    <li class="breadcrumb-item active">Popup Detail History</li>
@endsection

@section('action')
    <a href="{{ route('app-launch.report') }}" class="btn btn-primary round btn-glow px-2">
        <i class="la la-list"></i>
        Back to Campaign
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
                                    <td><strong>Campaign Title</strong></td>
                                    <td colspan="5">{{$campaignDetails->campaign_title}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Campaign Stat :</strong></td>
                                    <td>
                                        <span class="badge badge-info">
                                            Total Referrer:
                                            {{ $campaignDetails->referrers_count ?? 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-secondary">
                                            Total Referee:
                                         {{ $campaignDetails->total_referees ?? 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">
                                            Successfully Referrals:
                                            {{ $campaignDetails->total_success ?? 0 }}
                                        </span>
                                    </td>
{{--                                    <td>--}}
{{--                                        <span class="badge badge-warning">--}}
{{--                                            Total Buy Failure:--}}
{{--                                            {{ $popupPurchaseLogDetails->where('action_type', 'buy_failure')->count('action_type') ?? 0 }}--}}
{{--                                        </span>--}}
{{--                                    </td>--}}
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
                            <th width="10%">Referrals MSISDN</th>
                            <th width="12%">Referrals Code</th>
                            <th width="10%">Date</th>
                            <th width="10%">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($campaignDetails->referrers as $detail)
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td width="10%">{{ $detail->msisdn }}</td>
                                <td width="10%">{{ $detail->referral_code }}</td>
                                <td width="15%">
                                    {{\Carbon\Carbon::parse($detail->created_at)->format('d-m-Y h:i A')}}
                                </td>
                                <td width="3%">
                                    <a data-toggle="modal" data-target="#large"
                                       data-id="{{ $detail->id }}"
                                       href="{{--{{ route('refer-and-earn.campaign.details', $data->id) }}--}}"
                                       role="button" class="btn-sm btn-bitbucket border-1 referee-details"> Details</a>
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
        <div class="col-lg-4 col-md-6 col-sm-12">
{{--            <div class="form-group">--}}
{{--            <h5>Large Modal</h5>--}}
{{--            <p>Add class <code>.modal-lg</code> with <code>.modal-dialog</code>                            to use large size of modal.</p>--}}
{{--            <!-- Button trigger modal -->--}}
{{--            <button type="button" class="btn btn-outline-success block btn-lg" data-toggle="modal"--}}
{{--                    data-target="#large">--}}
{{--                Launch Modal--}}
{{--            </button>--}}
            <!-- Modal -->
            <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel17">Basic Modal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <table class="table table-striped table-bordered"
                                   role="grid" aria-describedby="Example1_info" id="referee-info">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="10%">Referees MSISDN</th>
                                    <th width="12%">Referrals Status</th>
                                    <th width="10%">Date</th>
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
{{--        </div>--}}
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
                $(this).DataTable().ajax.reload();

                $("#referee-info").dataTable({
                    scrollX: true,
                    processing: true,
                    searching: false,
                    serverSide: true,
                    ordering: false,
                    autoWidth: false,
                    pageLength: 10,
                    lengthChange: false,
                    ajax: {
                        url: '{{ url('mybl-refer-and-earn/referee-details') }}' + "/" + refererId,
                        {{--url: '{{ route('lead-list.ajex') }}',--}}
                        data: {
                            // applicant_name: function () {
                            //     return $('input[name="applicant_name"]').val();
                            // },
                            // date_range: function () {
                            //     return $('input[name="date_range"]').val();
                            // },
                            // lead_category: function () {
                            //     return $('#lead_category').val();
                            // },
                        }
                    },

                    "drawCallback": function (settings) {
                        // Here the response
                        var response = settings.json;
                        if (response.permission == false){
                            $('#permission_error').show()
                        }else {
                            $('#permission_error').hide()
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
                                return row.status;
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


/*                $.ajax({
                    url: "{{ url('mybl-refer-and-earn/referee-details') }}" + "/" + refererId,
                    success: function(result){
                        // console.log(result)
                        var dataRow = '';

                        dataRow += `
                            <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                                   role="grid" aria-describedby="Example1_info" style="">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="10%">Referrals MSISDN</th>
                                    <th width="12%">Referrals Code</th>
                                    <th width="10%">Date</th>
                                    <th width="10%">Details</th>
                                </tr>
                                </thead>
                                <tbody id="referee-info">
                        `
                            dataRow += `
                            <tr>
                                <td>1</td>
                                <td>GG</td>
                                <td>HHH</td>
                                <td>EE</td>
                                <td>PP</td>
                            </tr>
                            `
                            dataRow += `
                            <tr>
                                <td>2</td>
                                <td>GG</td>
                                <td>HHH</td>
                                <td>EE</td>
                                <td>PP</td>
                            </tr>
                            `


                        dataRow += `
                            </tbody>
                        </table>
                        `


                        $(".modal-body").append(dataRow);
                }});*/
                // alert(camId);
            })

        });
    </script>
@endpush
