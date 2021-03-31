@extends('layouts.admin')
@section('title', 'Product Activity')
@section('card_name', "Product Activity List")

@section('action')
@endsection

@section('content')
{{--    <section>--}}
{{--        <div class="card card-info mb-0" style="padding-left:10px">--}}
{{--            <div class="card-content">--}}
{{--                <div class="col-md-12">--}}
{{--                    <table class="table table-striped table-bordered dataTable"--}}
{{--                           id="category_list_table" role="grid">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Sl.</th>--}}
{{--                            <th> Title</th>--}}
{{--                            <th class="filter_data">Actions</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <form id="filter_form" action="{{ route('lead_data.excel_export') }}" method="POST" novalidate>
                        @csrf
                        <div class="row">
{{--                            <div class="form-group col-md-3">--}}
{{--                                <input type="text" name="applicant_name" class="form-control"--}}
{{--                                       autocomplete="off" id="applicant_name" placeholder="Name">--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-3">--}}
{{--                                <input type="text" name="date_range" class="form-control showdropdowns filter"--}}
{{--                                       autocomplete="off" id="date_range" placeholder="Date">--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-3 {{ $errors->has('lead_category') ? ' error' : '' }}">--}}
{{--                                <select class="form-control filter" name="lead_category" id="lead_category" required>--}}
{{--                                    <option value="">---Category---</option>--}}
{{--                                    @foreach($leadCategories as $data)--}}
{{--                                        <option value="{{ $data->id }}">{{ $data->title }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <div class="help-block"></div>--}}
{{--                                @if ($errors->has('lead_category'))--}}
{{--                                    <div class="help-block">{{ $errors->first('lead_category') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-3">--}}
{{--                                <button type="submit" class="btn btn-primary  btn-glow px-2" value="excel_export" name="excel_export" id="excel_export">--}}
{{--                                    <i class="la la-download"></i> Excel Export</button>--}}
{{--                            </div>--}}

                            <table class="table table-striped table-bordered" id="product_activities"> <!--zero-configuration-->
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <th>User</th>
                                    <th>Product Code</th>
                                    <th class="text-center">Activity Type</th>
                                    <th>Date And Time</th>
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

    <div class="modal fade text-left" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal"
         data-backdrop="static" data-keyboard="false"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="update_form">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <label>Title </label>
                        <div class="form-group">
                            <input type="text" id="title_field" class="form-control" name="title">
                            <input type="hidden" class="form-control" name="slug" id="slug_field">
                            <input id="update_category"
                                   class="btn btn-outline-primary btn-sm pull-right mt-2 mb-2" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="add_modal"
         data-backdrop="static" data-keyboard="false"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="add_form">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <label>Title </label>
                        <div class="form-group">
                            <input type="text" id="add_title_field" class="form-control" name="title" required>
                            <input id="add_category"
                                   class="btn btn-outline-primary btn-sm pull-right mt-2 mb-2" value="Add">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
            $("#product_activities").dataTable({
                scrollX: true,
                processing: true,
                searching: true,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: true,
                ajax: {
                    url: '{{ route('product-activities.history') }}',
                },
                columns: [
                    {
                        name: 'sl',
                        width: '5%',
                        render: function (data, type, row) {
                            return null;
                        }
                    },
                    {
                        name: 'user',
                        width: '15%',
                        render: function (data, type, row) {
                            console.log(row)
                            return row.user
                        }
                    },
                    {
                        name: 'product_code',
                        width: '5%',
                        render: function (data, type, row) {
                            return row.product_code
                        }
                    },
                    {
                        name: 'activity_type',
                        width: '5%',
                        className: "text-center",
                        render: function (data, type, row) {
                            let bgColor = '';
                            if (row.activity_type === 'create'){
                                bgColor = 'bg-success'
                            }else if (row.activity_type === 'update'){
                                bgColor = 'bg-primary'
                            }else {
                                bgColor = 'bg-danger'
                            }
                            return '<span class="badge badge-default badge-pill '+bgColor+' float-center">'+ row.activity_type.toUpperCase() + '</span>'
                        }
                    },
                    {
                        name: 'created_at',
                        width: '15%',
                        render: function (data, type, row) {
                            return row.created_at
                        }
                    },

                    {
                        name: 'actions',
                        className: 'text-center',
                        width: '5%',
                        render: function (data, type, row) {
                            let add_question_url = "{{ URL('faq/questions/create/') }}" +"/" + row.id;
                            return `<div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-sm btn-icon btn-outline-primary edit" data-title=" ` + row.title + `" data-slug=" ` + row.slug + `"><i class="la la-eye"></i> Details</button>
                          </div>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }
            });
        })
    </script>
@endpush
