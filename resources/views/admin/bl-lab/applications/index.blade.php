@extends('layouts.admin')
@section('title', 'Application List')
@section('card_name', 'Application List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Application List</li>
@endsection
@section('action')
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    {{--        <form id="filter_form" action="{{ route('lead_data.excel_export') }}" method="POST" novalidate>--}}
                    {{--            @csrf--}}
                    {{--        </form>--}}
                    <div class="row">
                        <div class="form-group col-md-3">
                            <input type="text" name="application_id" class="form-control"
                                   autocomplete="off" id="application_id" placeholder="Application ID">
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

                        <div class="form-group col-md-3">
                            <select class="form-control filter" name="application_status" id="application_status">
                                <option value="">Application All Status</option>
                                <option value="draft">Draft</option>
                                <option value="submit">Submit</option>
                            </select>
                        </div>

                        <table class="table table-striped table-bordered" id="application_list"> <!--zero-configuration-->
                            <thead>
                            <tr>
                                <td>#</td>
                                <th>Application ID</th>
                                <th>Idea Name</th>
                                <th>Program</th>
                                <th>Application Status</th>
                                <th>Submitted At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
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
                        application_id: function () {
                            return $('input[name="application_id"]').val();
                        },
                        submitted_at: function () {
                            return $('input[name="submitted_at"]').val();
                        },
                        program: function () {
                            return $('#program').val();
                        },
                        application_status: function () {
                            return $('#application_status').val();
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
                        name: 'application_id',
                        width: "5%",
                        render: function (data, type, row) {
                            console.log(row)
                            return row.application_id;
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
                        name: 'program',
                        width: "5%",
                        render: function (data, type, row) {
                            return row.summary.apply_for.replace("_", " ").toUpperCase();
                        }
                    },
                    {
                        name: 'application_status',
                        width: "6%",
                        render: function (data, type, row) {
                            let status = "";
                            if (row.application_status === "draft") {
                                status = `<strong><span class="badge badge-secondary badge-pill">Draft</span></strong>`
                            } else {
                                status = `<strong><span class="badge badge-success badge-pill">Submit</span></strong>`
                            }
                            return status;
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
                            let detailsURL = "{{ URL('bl-labs/application-details/') }}" + "/" + row.application_id;
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

            $('input[name="application_id"]').keyup(function() {
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





