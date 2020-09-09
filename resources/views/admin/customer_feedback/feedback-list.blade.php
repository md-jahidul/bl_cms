@extends('layouts.admin')
@section('title', 'Customer Feedback List')
@section('card_name', 'Customer Feedback List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Customer Feedback List</li>
@endsection
@section('action')

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <form id="filter_form" action="{{ route('lead_data.excel_export') }}" method="POST" novalidate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="text" name="page_name" class="form-control"
                                       autocomplete="off" id="page_name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="date_range" class="form-control showdropdowns filter"
                                       autocomplete="off" placeholder="Date">
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control filter" name="star_count" id="star_count">
                                    <option value="">All Star</option>
                                    <option value="1">1 Star</option>
                                    <option value="2">2 Star</option>
                                    <option value="3">3 Star</option>
                                    <option value="4">4 Star</option>
                                    <option value="5">5 Star</option>
                                </select>
                            </div>

{{--                            <div class="form-group col-md-3">--}}
{{--                                <button type="submit" class="btn btn-primary  btn-glow px-2" value="excel_export" name="excel_export" id="excel_export">--}}
{{--                                    <i class="la la-download"></i> Excel Export</button>--}}
{{--                            </div>--}}

                        <table class="table table-striped table-bordered" id="feedback_list"> <!--zero-configuration-->
                            <thead>
                            <tr>
                                <td>#</td>
                                <th>Page Name</th>
                                <th>Star</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('input[name="date_range"]').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY/MM/DD'
                },
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + '-' + picker.endDate.format('YYYY/MM/DD'));
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });


            $("#feedback_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ route('feedback.list') }}',
                    data: {
                        page_name: function () {
                            return $('input[name="page_name"]').val();
                        },
                        date_range: function () {
                            return $('input[name="date_range"]').val();
                        },
                        star_count: function () {
                            return $('#star_count').val();
                        },
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
                        name: 'page_name',
                        width: "15%",
                        render: function (data, type, row) {
                            // console.log(row)
                            return row.page.page_name;
                        }
                    },

                    {
                        name: 'rating',
                        width: "6%",
                        render: function (data, type, row) {
                            var star = '';
                            for (var i = 0; i < row.rating; i++){
                                star += '<i class="la la-star text-warning"></i> '
                            }
                            return star;
                        }
                    },

                    {
                        name: 'created_at',
                        width: "10%",
                        render: function (data, type, row) {
                            return row.created_at.split(" ")[0];
                        }
                    },
                    {
                        name: 'actions',
                        width: "5%",
                        className: 'filter_data',
                        render: function (data, type, row) {
                            let downloadPDFurl = "{{ URL('download-pdf') }}" + "/" + row.id;
                            let detailsURL = "{{ URL('lead-requested/details') }}" + "/" + row.id;
                            return `<td class="text-center">
                                        <a href="`+downloadPDFurl+`" role="button" class="btn-sm btn-info border-0"><i class="la la-download" aria-hidden="true"></i></a>
                                        <a href="`+detailsURL+`" role="button" class="btn-sm btn-success border-0"><i class="la la-eye" aria-hidden="true"></i></a>
                                    </td>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('change', '.filter', function (e) {
                $('#feedback_list').DataTable().ajax.reload();
            });

            $('input[name="page_name"]').keyup(function() {
                $('#feedback_list').DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $('#feedback_list').DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#lead_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush





