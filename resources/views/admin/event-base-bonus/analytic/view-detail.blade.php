@extends('layouts.admin')
@section('title', 'Analytics')
@section('card_name', 'Analytics')
@section('breadcrumb')
<li class="breadcrumb-item active">Event Based Campaign Analytics</li>
@endsection
@section('content')
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
                    console.log(task_analytics);
                    $('#analytics-table').show();
                    var table = $('#task_analytic_table').DataTable({
                        processing: true,
                        serverSide: false,
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
                            "targets": -1,
                            "data": null,
                            "defaultContent": "<a href='{{ url('event-base-bonus/analytics/view-details') }}' class='btn btn-success'>View User Details</button>"
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

                    $('#task_analytic_table tbody').on('click', 'button', function() {
                        var data = table.row($(this).parents('tr')).data();
                        $.ajax({
                            url: "{{ url('event-base-bonus/analytics/search') }}",
                            method: "post",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "event_based_campaign_id": data.campaign_id,
                                "campaign_task_id": data.task_id
                            },
                            dataType: "json",
                            success: function(result) {
                                console.log(result);
                            }
                        });
                    });
                }
            });
        });
    });
</script>
@endpush