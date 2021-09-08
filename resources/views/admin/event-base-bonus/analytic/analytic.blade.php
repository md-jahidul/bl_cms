@extends('layouts.admin')
@section('title', 'Analytics')
@section('card_name', 'Analytics')
@section('breadcrumb')
<li class="breadcrumb-item active">Event Based Campaign Analytics</li>
@endsection
@section('content')
<div class="col-md-12 mt-5">
    <div class="row">
        <div class="col-md-3">
            <label for="dashboard_card_title" class="required">From Date</label>
            <input required type='text' class="form-control" name="from_date" id="from_date" placeholder="Please select from date" />
        </div>
        <div class="col-md-3">
            <label for="dashboard_card_title" class="required">To Date</label>
            <input required type='text' class="form-control" name="to_date" id="to_date" placeholder="Please select to date" />
        </div>
        <div class="col-md-2">
            <button id="find_analytics" class="btn btn-info mt-1"><i class="la la-download"></i>
                Submit
            </button>
        </div>
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
    $('#analytics-table').hide();

    $(document).ready(function() {
        var date = new Date();
        var task_analytics = {};
        date.setDate(date.getDate());
        $('#from_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            showClose: true,
        });

        $('#to_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false, //Important! See issue #1075
            showClose: true,

        });


        $('#find_analytics').click(function() {
            if ($('#from_date').val() == '' || $('#to_date').val() == '') {
                alert('Please select From Date/To Date');
                return false;
            }
            $.ajax({
                url: "{{ url('event-base-bonus/analytics/find') }}",
                method: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'from_date': $('#from_date').val(),
                    'to_date': $('#to_date').val()
                },
                dataType: "json",
                success: function(result) {
                    task_analytics = result;
                    $('#analytics-table').show();
                    var table = $('#task_analytic_table').DataTable({
                        processing: true,
                        serverSide: false,
                        destroy: true,
                        data: task_analytics,
                        columns: [{
                                title: 'Campaign Title',
                                data: 'campaign_title'
                            },
                            {
                                title: 'Task Title',
                                data: 'task_title'
                            },
                            {
                                title: 'Event',
                                data: 'event'
                            },
                            {
                                title: 'Total In Progress',
                                data: 'total_in_progress'
                            },
                            {
                                title: 'Total Completed',
                                data: 'total_completed'
                            },
                            {
                                title: 'Total Claimed',
                                data: 'total_claimed'
                            },
                            {
                                title: 'Action'
                            }
                        ],
                        "columnDefs": [{
                            "render": function(data, type, row) {
                                var url = "event-base-bonus/analytics/" + row.campaign_id + "/" + row.task_id;
                                var domElement = `<a href="{{ url("") }}/${url}" target="_blank"><button class="btn btn-success btn-sm">View User Details</span></button></a>`;
                                return domElement;
                            },
                            "targets": -1,
                            "data": null,
                        }],
                        buttons: [{
                                extend: 'csv',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5]
                                }
                            }
                        ]
                    });
                }
            });
        });
    });
</script>
@endpush