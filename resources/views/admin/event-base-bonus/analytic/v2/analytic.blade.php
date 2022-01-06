@extends('layouts.admin')
@section('title', 'Event Based Bonus Analytics')
@section('card_name', 'Event Based Bonus Analytics')
@section('breadcrumb')
    <li class="breadcrumb-item active">Event Based Campaign Analytics</li>
@endsection
@section('content')
    <div class="row" style="margin-bottom: -20px;">
        <div class="col-md-12" style="margin-top: 10px;">
            <table border="0" cellspacing="5" cellpadding="5" style="float: right">
                <tr>
                    <td>From:</td>
                    <td> <input required type='text' class="form-control" name="from_date" id="from_date" placeholder="Please select from date" autocomplete="off"/>
                    </td>
                    <td>To:</td>
                    <td> <input required type='text' class="form-control" name="to_date" id="to_date" placeholder="Please select to date" autocomplete="off"/>
                    </td>
                    <td><input id="find_analytics" value="Go" class="btn btn-sm btn-success " type="button"></td>
                </tr>
            </table>
        </div>
    </div>
    <section id="analytics-table" class="mt-2">
        <div class="">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered text-center" id="task_analytic_table"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            var date = new Date();
            date.setDate(date.getDate());
            $('#from_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                showClose: true
            });
            $('#to_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                showClose: true
            });
            $('#task_analytic_table').DataTable({
                processing: true,
                serverSide: false,
                pageLength: 10,
                destroy: true,
                deferLoading: false,
                sPagingType: 'simple',
                ajax: {
                    url: "{{ url('event-base-bonus/v2/analytics/find') }}",
                    method: "post",
                    dataSrc: '',
                    data: function(data) {
                        data._token = "{{ csrf_token() }}";
                        data.analytics_type = "campaign";
                        data.from_date = $("#from_date").val();
                        data.to_date = $("#to_date").val();
                    }
                },
                columns: [{
                    title: 'SL'
                },
                    {
                        title: 'Campaign Title',
                        data: 'title'
                    },
                    {
                        title: 'Start Date',
                        data: 'start_date'
                    },
                    {
                        title: 'End Date',
                        data: 'end_date'
                    },
                    {
                        title: 'Total Users',
                        data: 'total_users'
                    },
                    {
                        title: 'Action'
                    }
                ],
                dom: 'Blfrtip',
                "columnDefs": [{
                    "targets": 0,
                    "data": null,
                },
                    {
                        "targets": 4,
                        "data": null,
                        render: function(data, type, row) {
                            var url = "event-base-bonus/v2/analytics/" + row.id;
                            var domElement = row.total_users ? `<a href="{{ url("") }}/${url}" target="_blank">` + row.total_users + `</a>` : row.total_users;
                            return domElement;
                        }
                    },
                    {
                        "targets": 5,
                        "data": null,
                        render: function(data, type, row) {
                            var url = "event-base-bonus/v2/analytics/" + row.id;
                            var domElement = `<a href="{{ url("") }}/${url}" target="_blank"><button class="btn btn-success btn-sm">View Details</span></button></a>`;
                            return domElement;
                        },
                    }
                ],
                buttons: [{
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4]
                        }
                    }
                ],
                "fnCreatedRow": function(row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }
            });
            $("#find_analytics").click(function() {
                $('#task_analytic_table').DataTable().ajax.reload();
            });
        });
    </script>
@endpush