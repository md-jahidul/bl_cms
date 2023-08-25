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
                <div class="row" style="margin-bottom: -20px;">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <table border="0" cellspacing="5" cellpadding="5" style="float: right">
                            <tr>
                                <td>Invoice Id:</td>
                                <td><input type="text" class="form-control" id="invoice_id" name="invoice_id" autocomplete="off"></td>
                                <td>From:</td>
                                <td><input type="text" class="datepicker form-control" id="from" name="from" autocomplete="off"></td>
                                <td>To:</td>
                                <td><input type="text" class="datepicker form-control" id="to" name="to" autocomplete="off"></td>
                                <td><input id="submit" value="Search"  class="btn btn-sm btn-success "  type="button" ></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <div class="col-md-12 mt-3">
                        <table class="table table-striped table-bordered dataTable"
                            id="transaction_list" role="grid">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Invoice Id</th>
                                <th>Contact no</th>
                                <th>Sub Total</th>
                                <th>Promo Code</th>
                                <th>Total Promo Discount</th>
                                <th>Total Default Discount</th>
                                <th>Order Total Price</th>
                                <th>Items (Catalog Products id)</th>
                                <th>Date</th>
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
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }
        div.dataTables_wrapper div.dataTables_filter {
            text-align: right;
            margin-top: -52px;
        }
        .dt-buttons.btn-group {
            text-align: center;
            margin-bottom: 2px;
            /*margin-left: 27%;*/
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>

    <script>
        $(function () {
            $('.datepicker').datetimepicker({
                format : 'YYYY-MM-DD',
                showClose: true,
            });

            $("#transaction_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                lengthMenu: [[30, 50, -1], [30, 50, "All"]],
                pageLength: 30,
                lengthChange: true,
                ajax: {
                    url: '{{ route('mybl.transaction-status.course.list') }}',
                    data: {
                        invoice_id: function () {
                            return $("#invoice_id").val();
                        },
                        from: function () {
                            return $("#from").val();
                        },
                        to: function () {
                            return $("#to").val();
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
                            return row.invoice_id;
                        }
                    },
                    
                    {
                        name: 'contact_no',
                        render: function (data, type, row) {
                            return row.contact_no;
                        }
                    },
                    
                    {
                        name: 'sub_total',
                        render: function (data, type, row) {
                            return row.sub_total;
                        }
                    },
                    
                    {
                        name: 'promo_code',
                        render: function (data, type, row) {
                            return row.promo_code;
                        }
                    },
                    
                    {
                        name: 'total_promo_discount',
                        render: function (data, type, row) {
                            return row.total_promo_discount;
                        }
                    },
                    
                    {
                        name: 'total_default_discount',
                        render: function (data, type, row) {
                            return row.total_default_discount;
                        }
                    },
                    
                    {
                        name: 'order_total_price	',
                        render: function (data, type, row) {
                            return row.order_total_price	;
                        }
                    },
                    
                    {
                        name: 'items	',
                        render: function (data, type, row) {
                            let itemList = '<ol>';
                            row.items.forEach((item, index)=>{
                                itemList += `<li>${item.catalog_product_id}</li>`
                            })
                            itemList += '<ol>';
                            return itemList;
                        }
                    },
                    
                    {
                        name: 'date	',
                        render: function (data, type, row) {
                            return row.date;
                        }
                    }
                ],
                dom: 'Blfrtip',
                buttons:  [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6,7,8,9]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6,7,8,9]
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $( "#submit" ).click(function() {
                $('#transaction_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
