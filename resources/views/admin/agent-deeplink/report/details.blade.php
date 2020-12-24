@extends('layouts.admin')
@section('title', 'Agent Deeplink Report Details')
@section('card_name', "Agent Deeplink Report Details")

@section('action')
    <a href="{{ url('agent/deeplink/report') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Report
        List </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="row table-responsive">
                    <div class="col-md-12 pt-2 pb-2">
                        <table class="table table-striped table-bordered dataTable"
                               id="question_list_table" role="grid">
                            <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Msisdn</th>
                                <th width="12%">Action Type</th>
                                <th width="10%">Action Status</th>
                                <th width="30%">Action URL</th>
                                <th width="15%">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
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
        .add-button {
            margin-top: 1.9rem !important;
        }

        .filter_data {
            text-align: right;
        }

        .dataTable {
            width: 100% !important;
        }
    </style>
@endpush

@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>

    <script>
        $(function () {

            $('#question_list_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('agent.deeplink.report.details',$deeplinkId) }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'msisdn', name: 'msisdn'},
                    {data: 'action_type', name: 'action_type'},
                    {data: 'action_status', name: 'action_status'},
                    {data: 'action_url', name: 'action_url'},
                    {
                        data: 'date',
                        name: 'date',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
            $(document).on('change', '#filter_category', function (e) {
                console.log('change');
                $('#question_list_table').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
