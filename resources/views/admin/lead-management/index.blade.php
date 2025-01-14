@extends('layouts.admin')
@section('title', 'Lead Request List')
@section('card_name', 'Lead Request List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Lead Request List</li>
@endsection
@section('action')

@endsection
@section('content')

    <div class="alert bg-danger alert-dismissible mb-2" id="permission_error" role="alert" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        Permission denied!
    </div>

    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <form id="filter_form" action="{{ route('lead_data.excel_export') }}" method="POST" novalidate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="text" name="applicant_name" class="form-control"
                                       autocomplete="off" id="applicant_name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="date_range" class="form-control showdropdowns filter"
                                       autocomplete="off" id="date_range" placeholder="Date">
                            </div>
                            <div class="form-group col-md-3 {{ $errors->has('lead_category') ? ' error' : '' }}">
                                <select class="form-control filter" name="lead_category" id="lead_category" required>
                                    <option value="">---Category---</option>
                                    @foreach($leadCategories as $data)
                                        <option value="{{ $data->id }}">{{ $data->title }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block"></div>
                                @if ($errors->has('lead_category'))
                                    <div class="help-block">{{ $errors->first('lead_category') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary  btn-glow px-2" value="excel_export" name="excel_export" id="excel_export">
                                    <i class="la la-download"></i> Excel Export</button>
                            </div>

                        <table class="table table-striped table-bordered" id="lead_list"> <!--zero-configuration-->
                            <thead>
                            <tr>
                                <td>#</td>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Product</th>
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


            $("#lead_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ url('lead-requested-list') }}',
                    {{--url: '{{ route('lead-list.ajex') }}',--}}
                    data: {
                        applicant_name: function () {
                            return $('input[name="applicant_name"]').val();
                        },
                        date_range: function () {
                            return $('input[name="date_range"]').val();
                        },
                        lead_category: function () {
                            return $('#lead_category').val();
                        },

                        // excel_export: function () {
                        //     return $('#excel_export').val();
                        // },
                    }
                },

                "drawCallback": function (settings) {
                    // Here the response
                    var response = settings.json;
                    if (response.permission == false){
                        $('#permission_error').show()
                    }else {
                        $('#permission_error').hide()
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
                        name: 'name',
                        width: "15%",
                        render: function (data, type, row) {
                            if (row.form_data.name){
                                return row.form_data.name;
                            }
                            return row.form_data.basic.company_name;
                        }
                    },
                    {
                        name: 'created_at',
                        width: "6%",
                        render: function (data, type, row) {
                            return row.created_at;
                        }
                    },
                    {
                        name: 'lead_category',
                        width: "10%",
                        render: function (data, type, row) {
                            return row.lead_category;
                        }
                    },
                    {
                        name: 'lead_product',
                        width: "8%",
                        render: function (data, type, row) {
                            return row.lead_product;
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
                $('#lead_list').DataTable().ajax.reload();
            });

            $('input[name="applicant_name"]').keyup(function() {
                $('#lead_list').DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $('#lead_list').DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#lead_list').DataTable().ajax.reload();
            });

            $('#excel_export').click(function() {
                $("#filter_form").submit();
            });
        });
    </script>
@endpush





