@extends('layouts.admin')
@section('title', 'FAQ Question')
@section('card_name', "FAQ Question List")

@section('action')
    <a href="{{ route('faq.questions.create') }}" class="btn btn-primary round btn-glow px-2" id="add_category_btn"><i
            class="la la-plus"></i>
        Add Question
    </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-3 mt-1 ml-1 ">
                        <select class="form-control pull-right" name="filter_category" id="filter_category">
                            <option value=""> Select Category To Filter</option>
                            @foreach($category as $id => $category)
                                <option value="{{ $id }}"> {{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered dataTable"
                               id="question_list_table" role="grid">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Category</th>
                                <th>Question</th>
                                <th class="filter_data">Actions</th>
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

@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>

    <script>
        $(function () {
            $("#question_list_table").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 6,
                lengthChange: false,
                ajax: {
                    url: '{{ route('faq.questions.index') }}',
                    data: {
                        filter_category: function () {
                            return $("#filter_category").val();
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
                        name: 'category',
                        width: '150px',
                        render: function (data, type, row) {
                            return '<span class="badge badge-default badge-pill bg-primary">' + row.category + '</span>'
                        }
                    },

                    {
                        name: 'question',
                        render: function (data, type, row) {
                            return row.question
                        }
                    },

                    {
                        name: 'actions',
                        className: 'filter_data',
                        width: '150px',
                        render: function (data, type, row) {
                            let detail_question_url = "{{ URL('faq/questions/') }}" +"/" + row.id;
                            return `<div class="btn-group" role="group" aria-label="Basic example">
                            <a href=" ` + detail_question_url + ` "class="btn btn-sm btn-icon btn-outline-success edit"><i class="la la-eye"></i></a>
                            <button type="button" data-id ="` + row.id + ` " class="btn btn-sm btn-icon btn-outline-danger del" ><i class="la la-remove"></i></button>
                          </div>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }
            });

            $(document).on('click', '.del', function (e) {
                e.preventDefault();

                let id = $(this).data('id');

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
                            url: '{{route('faq.questions.delete')}}',
                            method: 'delete',
                            data: {
                                _token: '{{csrf_token()}}',
                                id: id
                            }
                        });

                        call.done(function () {
                            $('#question_list_table').DataTable().ajax.reload();
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

            $(document).on('change', '#filter_category', function (e) {
                console.log('change');
                $('#question_list_table').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
