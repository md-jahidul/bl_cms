@extends('layouts.admin')
@section('title', 'FAQ Category')
@section('card_name', "FAQ Category List")

@section('action')
    <a href="#" class="btn btn-primary round btn-glow px-2" id="add_category_btn"><i class="la la-plus"></i>
        Add Category
    </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered dataTable"
                           id="category_list_table" role="grid">
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th> Title</th>
                            <th class="filter_data">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

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

        let category_slug;
        let category_title;
        $(function () {

            $("#category_list_table").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 6,
                lengthChange:false,
                ajax: {
                    url: '{{ route('faq.category.index') }}',
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
                        name: 'title',
                        render: function (data, type, row) {
                            return row.title + '<span class="badge badge-default badge-pill bg-primary float-right">'+ row.questions_count+ '</span>'
                        }
                    },

                    {
                        name: 'actions',
                        className: 'filter_data',
                        width: '150px',
                        render: function (data, type, row) {
                            return `<div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-sm btn-icon btn-outline-success edit" data-title=" ` + row.title + `" data-slug=" ` + row.slug + `"><i class="la la-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger del" data-total="` + row.questions_count + `"  data-slug="` + row.slug + `"><i class="la la-remove"></i></button>
                          </div>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }
            });

            $(document).on('click', '.edit', function (e) {
                e.preventDefault();

                category_slug = $(this).data('slug');
                category_title = $(this).data('title');

                $("#title_field").val(category_title);
                $("#slug_field").val(category_slug);
                $('#edit_modal').modal('toggle');

            })

            $(document).on('click', '#update_category', function (e) {
                e.preventDefault();
                if ($("#title_field").val() == '') {
                    swal.fire({
                        title: 'Title cannot be empty',
                        type: 'error',
                    });
                    return;
                }

                $('#edit_modal').modal('toggle');

                swal.fire({
                    title: 'Data Uploading.Please Wait ...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });


                $.ajax({
                    url: '{{ route('faq.category.update')}}',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData($('#update_form')[0]),
                    success: function (result) {
                        swal.close();

                        if (result.status == 'SUCCESS') {
                            swal.fire({
                                title: 'Category Updated Successfully!',
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            $('#update_form')[0].reset();

                            $('#category_list_table').DataTable().ajax.reload();
                        } else {
                            swal.fire({
                                title: result.message,
                                type: 'error',
                            });
                        }

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Data Update Failed',
                            type: 'error',
                        });
                    }
                });

                swal.close();
            })

            $(document).on('click', '#add_category_btn', function (e) {
                e.preventDefault();
                $('#add_modal').modal('toggle');

            })

            $(document).on('click', '#add_category', function (e) {
                e.preventDefault();
                if ($("#add_title_field").val() == '') {
                    swal.fire({
                        title: 'Title cannot be empty',
                        type: 'error',
                    });
                    return;
                }

                $('#add_modal').modal('toggle');

                swal.fire({
                    title: 'Data Saving.Please Wait ...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });


                $.ajax({
                    url: '{{ route('faq.category.store')}}',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData($('#add_form')[0]),
                    success: function (result) {
                        swal.close();

                        if (result.status == 'SUCCESS') {
                            swal.fire({
                                title: 'Category Successfully added!',
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            $('#category_list_table').DataTable().ajax.reload();
                        } else {
                            swal.fire({
                                title: result.message,
                                type: 'error',
                            });
                        }
                        $('#add_form')[0].reset();

                    },
                    error: function (data) {
                        $('#add_form')[0].reset();
                        swal.fire({
                            title: 'Update Failed. Please, Try again later',
                            type: 'error',
                        });
                    }
                });

                swal.close();
            })

            $(document).on('click', '.del', function (e) {
                e.preventDefault();

                let total = $(this).data('total');
                category_slug = $(this).data('slug');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Related Questions will also be deleted",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        let call = $.ajax({
                            url: '{{route('faq.category.delete')}}',
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                slug: category_slug
                            }
                        });

                        call.done(function () {
                            $('#category_list_table').DataTable().ajax.reload();
                            Swal.fire(
                                'Success!',
                                'Successfully Deleted',
                                'success',
                            );
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            let errorResponse = jqXHR.responseJSON;
                            Swal.fire(
                                'Error!',
                                errorResponse.errors,
                                'error',
                            );
                        });
                    }
                });
            })
        })
    </script>
@endpush
