@extends('layouts.admin')
@section('title', 'Notification Purchase Report')
@section('card_name', 'Notification Purchase Report')
@section('breadcrumb')
    <li class="breadcrumb-item active">Notification Purchases Details</li>
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
                                <th width="10%">Msisdn</th>
                                <th width="7%">Action Type</th>
                                <th width="7%">Date</th>

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

        .dt-buttons.btn-group {
            margin-bottom: 2px;
        }

        div#question_list_table_length {
            margin-bottom: -50px;
        }
    </style>
@endpush

@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>

    <script>
        $(function () {
            let URL = "{{ route('push.notification.purchase.report.details',$id) }}?from={{$from}}&to={{$to}}";
            $('#question_list_table').DataTable({
                processing: true,
                serverSide: false,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                pageLength: 10,
                ajax: URL,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'msisdn', name: 'msisdn'},
                    {data: 'action_type', name: 'action_type'},
                    {
                        data: 'date',
                        name: 'date',
                        orderable: true,
                        searchable: true
                    },
                ],
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1, 2, 3]
                        }
                    }
                ]
            });
            $(document).on('change', '#filter_category', function (e) {
                $('#question_list_table').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
