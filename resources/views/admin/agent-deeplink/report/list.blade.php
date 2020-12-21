@extends('layouts.admin')
@section('title', 'Agent Deeplink Report')
@section('card_name', "Agent Deeplink Report")

@section('action')
    <a href="{{ url('deeplink/agent/list') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Agent
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
                                <th width="5%">Sl.</th>
                                <th width="10%">Agent</th>
                                <th width="10%">Deeplink</th>
                                <th width="10%">Deeplink Type</th>
                                <th width="7%">View</th>
                                <th width="7%">Buy</th>
                                <th width="7%">Failure</th>
                                <th width="7%">Cancel</th>
                                <th width="5%">Action</th>
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
                ajax: "{{ route('agent.deeplink.report') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'agent_info', name: 'agent_info'},
                    // {data: 'product_code', name: 'product_code'},
                    {data: 'deep_link', name: 'deep_link'},
                    {data: 'deeplink_type', name: 'deeplink_type'},
                    {data: 'tview', name: 'tview'},
                    {data: 'total_buy', name: 'total_buy'},
                    {data: 'total_cancel', name: 'total_cancel'},
                    {data: 'buy_attempt', name: 'buy_attempt'},

                    {
                        data: 'action',
                        name: 'action',
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
