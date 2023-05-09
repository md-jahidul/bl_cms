@extends('layouts.admin')
@section('title', 'Course Transaction Status')
@section('card_name', 'Course Transaction Status')
@section('breadcrumb')
    <li class="breadcrumb-item active">Course Transaction Status</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="col-md-12 mt-5" >
                        <div class="row">
                            <div class="col-md-3">
                                <input class="form-control filter" name="invoice_id" placeholder="Enter Invoice Id to Filter" id="invoice_id"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <table class="table table-striped table-bordered dataTable"
                            id="product_list" role="grid">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Invoice Id</th>
                                <th>Contact no</th>
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
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function () {
            $("#transaction_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ route('mybl.transaction-status.course.list') }}',
                    data: {
                        invoice_id: function () {
                            return $("#invoice_id").val();
                        }
                    }
                },
                columns: [
                    {
                        name: 'sl',
                        width: '30px',
                        render: function () {
                            return null;
                        }
                    },

                    {
                        name: 'invoice_id',
                        render: function (data, type, row) {
                            let detail_question_url = "{{ URL('mybl/products/') }}" + "/" + row.invoice_id;
                            return '<a href="' + detail_question_url + '">' + row.invoice_id  + '</a>';
                        }
                    },

                    {
                        name: 'contact_no',
                        render: function (data, type, row) {
                            return row.contact_no;
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('change', '.filter', function (e) {
                $('#transaction_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
