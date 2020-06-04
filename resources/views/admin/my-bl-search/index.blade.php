@extends('layouts.admin')
@section('title', 'Search Content')
@section('card_name', 'Search Content| List')

@section('action')
    <a href="{{ route('mybl-search-content.create') }}" class="btn btn-info btn-sm btn-glow px-2">
        Add New
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <div class="row">
                            <div class="col-md-6 mb-2 pull-right">
                                <div class="project-search">
                                    <div class="project-search-content">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" name="seach" id="search_input"
                                                   placeholder="Search contents by title,search content and action ">
                                            <div class="form-control-position">
                                                    <i class="la la-search text-size-base text-muted mb-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered" id="search_content_table">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Display Title</th>
                                        <th>Search Contents</th>
                                        <th>Navigation Action</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                                <form method="post" id="del_search_content_form">
                                    {{csrf_field()}}
                                    {{ method_field('delete') }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
@endpush

@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function () {
            $("#search_content_table").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ route('mybl-search-content.list') }}',
                    data: {
                        terms: function () {
                            return $("#search_input").val();
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
                        name: 'display_title',
                        render: function (data, type, row) {
                            return row.display_title;
                        }
                    },

                    {
                        name: 'search_contents',
                        render: function (data, type, row) {
                            return row.search_contents;
                        }
                    },

                    {
                        name: 'navigation_action',
                        render: function (data, type, row) {
                            return row.navigation_action;
                        }
                    },
                    {
                        name: 'actions',
                        className: 'filter_data',
                        render: function (data, type, row) {
                            let details_url = "{{ URL('mybl-search/') }}" + "/" + row.id;
                            return `<div class="btn-group" role="group" aria-label="Basic example">
                            <a href="#" class="btn btn-sm btn-icon btn-outline-danger delete" data-id="` + row.id + `"><i class="la la-remove"></i></a>
                            <a href=" ` + details_url + ` "class="btn btn-sm btn-icon btn-outline-success edit"><i class="la la-eye"></i></a>
                          </div>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('input', '#search_input', function (e) {
                e.preventDefault();
                $('#search_content_table').DataTable().ajax.reload();
/*                let search_item = $("#search_input").val();
                if(search_item !=""){
                    $('#search_content_table').DataTable().ajax.reload();
                }*/
            });

            $(document).on('click', '.delete', function (e) {
                var action_url;
                var id;
                e.preventDefault();
                id = $(this).attr('data-id');
                action_url = "{{ URL('mybl-search/') }}" + "/" + id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $('#del_search_content_form').attr('action', action_url).submit();
                    }
                })
            })

        });
    </script>
@endpush







