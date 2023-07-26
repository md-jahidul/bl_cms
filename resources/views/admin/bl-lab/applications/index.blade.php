@extends('layouts.admin')
@section('title', 'Application List List')
@section('card_name', 'Application List List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Application List List</li>
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
                                <input type="text" name="id_number" class="form-control"
                                       autocomplete="off" id="id_number" placeholder="Application ID">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="submitted_at" class="form-control showdropdowns filter"
                                       autocomplete="off" placeholder="Filter Submitted At By Date Range">
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control filter" name="program" id="program">
                                    <option value="">All Programs</option>
                                    @foreach($programs as $data)
                                        <option value="{{ $data->slug }}">{{ $data->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>

{{--                            <div class="form-group col-md-3">--}}
{{--                                <a href="{{ route('feedback.page-groping') }}" class="btn btn-outline-info  btn-glow px-2" id="page_group">--}}
{{--                                    <i class="la la-pagelines"></i> Page Group</a>--}}
{{--                            </div>--}}

                            <table class="table table-striped table-bordered" id="application_list"> <!--zero-configuration-->
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <th>Application ID</th>
                                    <th>Idea Name</th>
                                    <th>Application Status</th>
                                    <th>Submitted At</th>
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
            $('input[name="submitted_at"]').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY/MM/DD'
                },
            });

            $('input[name="submitted_at"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + '-' + picker.endDate.format('YYYY/MM/DD'));
            });

            $('input[name="submitted_at"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });


            $("#application_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: ['star'],
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ route('application.list') }}',
                    data: {
                        id_number: function () {
                            return $('input[name="id_number"]').val();
                        },
                        submitted_at: function () {
                            return $('input[name="submitted_at"]').val();
                        },
                        program: function () {
                            return $('#program').val();
                        },
                    }
                },
                columns: [
                    {
                        name: '',
                        width: "2%",
                        render: function () {
                            return null;
                        }
                    },

                    {
                        name: 'id_number',
                        width: "5%",
                        render: function (data, type, row) {
                            console.log(row)
                            return row.id_number;
                        }
                    },

                    {
                        name: 'idea_title',
                        width: "45%",
                        render: function (data, type, row) {
                            return row.summary.idea_title;
                        }
                    },

                    {
                        name: 'application_status',
                        width: "6%",
                        render: function (data, type, row) {
                            return row.application_status;
                        }
                    },

                    {
                        name: 'submitted_at',
                        width: "5%",
                        render: function (data, type, row) {
                            return row.submitted_at;
                        }
                    },
                    {
                        name: 'actions',
                        width: "8%",
                        className: 'filter_data',
                        render: function (data, type, row) {
                            let detailsURL = "{{ URL('#') }}" + "/" + row.id;
                            return  `<td class="text-center">
                                        <a href="`+detailsURL+`" role="button" class="btn-sm btn-outline-warning"><i class="la la-feed" aria-hidden="true"></i> View Details</a>
                                    </td>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('change', '.filter', function (e) {
                $('#application_list').DataTable().ajax.reload();
            });

            $('input[name="id_number"]').keyup(function() {
                $('#application_list').DataTable().ajax.reload();
            });

            $('input[name="submitted_at"]').on('apply.daterangepicker', function(ev, picker) {
                $('#application_list').DataTable().ajax.reload();
            });

            $('input[name="submitted_at"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#application_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush





