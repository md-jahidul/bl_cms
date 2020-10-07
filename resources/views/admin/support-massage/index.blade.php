@extends('layouts.admin')
@section('title', 'Support Massage')
@section('card_name', 'Support Massage List')

@section('action')
    {{-- <a href="{{ route('faq.questions.create') }}" class="btn btn-primary round btn-glow px-2" id="add_category_btn"><i
            class="la la-plus"></i>
        Add Question
    </a> --}}
@endsection
<style>
  div.dt-buttons {
    float: left;
    margin-top: 15px;

}
</style>
@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12" style="padding-bottom: 20px; margin-top: 10px;">
                        <div class="row">
                            <div class="col-md-8 form-inline col-md-offset-2" style="margin:0px auto">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Date :  &nbsp;</label>
                                    <input type="text" class="form-control"name="date_range" id="date_range" autocomplete="off" placeholder="Select date">
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Ratings :  &nbsp;</label>
                                    <input type="text" class="form-control" id="ratings" placeholder="Enter Rating">
                                  </div>
                            </div>
                            </div>
                          </div>
                        <table class="table table-striped table-bordered dataTable"
                               id="support_message_list_table" role="grid">
                            <thead>
                            <tr class="bg-warning text-dark">
                                <th>Sl.</th>
                                <th>Msisdn</th>
                                <th>Ticket Id</th>
                                <th>Ratings</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th class="filter_data">Status</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade text-left" id="show_modal" tabindex="-1" role="dialog" aria-labelledby="show_modal"
                 data-backdrop="static" data-keyboard="false"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">FAQ Question</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5><i class="la la-question"></i><span id="faq_question"></span></h5>
                            <p id="faq_answer"></p>
                        </div>
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
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush
@push('page-js')
<script src="{{ asset('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/pickers/daterange/daterangepicker.js"></script>
    <script>
        $(function () {
            $('input[name="date_range"]').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY-MM-DD'
                },
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + '=' + picker.endDate.format('YYYY-MM-DD'));
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $("#support_message_list_table").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                bPaginate:true,
                ordering: true,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'excelHtml5', className: 'btn-primary pull-right btn-sm' },
                    { extend: 'csvHtml5', className: 'btn-primary btn-sm' },
                ],
                ajax: {
                    url: '{{ route('support.message.list') }}',
                    data: {
                        date: function () {
                            return $('input[name="date_range"]').val();
                        },
                        ratings: function () {
                            return $("#ratings").val();
                        }
                    }
                },
                columns: [
                    {
                        name: 'sl',
                        width: '30px',
                        render: function (data, type, row) {
                            return null;
                        }
                    },
                    {
                        name: 'msisdn',
                        width: '150px',
                        render: function (data, type, row) {
                            return '<span class="badge badge-default badge-pill bg-primary">' + row.msisdn + '</span>'
                        }
                    },
                    {
                        name: 'ticketId',
                        render: function (data, type, row) {
                            return row.ticketId;
                        }
                    },
                    {
                        name: 'ratings',
                        render: function (data, type, row) {
                            return row.ratings;
                        }
                    },
                    {
                        name: 'category_name',
                        width: '150px',
                        render: function (data, type, row) {
                           return row.category_name;
                        }
                    },
                    {
                        name: 'complaint_location',
                        width: '150px',
                        render: function (data, type, row) {
                           return row.complaint_location;
                        }
                    },
                    {
                        name: 'status',
                        width: '150px',
                        render: function (data, type, row) {
                           return '<span class="badge badge-default badge-pill bg-primary">' + row.status + '</span>';
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }
            });
            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $('#support_message_list_table').DataTable().ajax.reload();
            });
            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#support_message_list_table').DataTable().ajax.reload();
            });
            $(document).on('change', '#ratings', function (e) {
                $('#support_message_list_table').DataTable().ajax.reload();
            });

        });
    </script>
@endpush
