@extends('layouts.admin')
@section('title', 'Feed')
@section('card_name', 'Feed')
@section('breadcrumb')
    <li class="breadcrumb-item active">Feed List</li>
@endsection

@section('action')
    <a href="{{route('feeds.create')}}" class="btn btn-primary round btn-glow px-2"><i
            class="la la-plus"></i>
        Create Feed
    </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body card-dashboard">

                    <div class="row">
                        <div class="form-group col-md-3">
                            <select class="form-control" id="title" name="title">
                                <option value=""></option>
                                @foreach($feeds as $data)
                                    <option value="{{ $data->title }}">{{ $data->title }}</option>
                                @endforeach
                            </select>
{{--                            <input type="text" name="title" class="form-control feed-title"--}}
{{--                                   autocomplete="off" placeholder="Title">--}}
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="date_range" class="form-control showdropdowns filter datetime"
                                   autocomplete="off" id="date_picker" placeholder="Feed Seen Date">
                        </div>
                        <div class="form-group col-md-3 {{ $errors->has('type') ? ' error' : '' }}">
                            <select class="form-control" name="type" id="type" required>
                                <option value="">---Type---</option>
                                <option value="general">General</option>
                                <option value="youtube">Youtube</option>
                                <option value="facebook">Facebook</option>
                            </select>
                            <div class="help-block"></div>
                            @if ($errors->has('type'))
                                <div class="help-block">{{ $errors->first('type') }}</div>
                            @endif
                        </div>

                        <div class="form-group col-md-3 {{ $errors->has('category') ? ' error' : '' }}">
                            <select class="form-control" name="category" id="category" required>
                                <option value="">---Category---</option>
                                @foreach($categories as $data)
                                    <option value="{{ $data->slug }}">{{ $data->title }}</option>
                                @endforeach
                            </select>
                            <div class="help-block"></div>
                            @if ($errors->has('category'))
                                <div class="help-block">{{ $errors->first('category') }}</div>
                            @endif
                        </div>
                    </div>

                    <table class="table table-striped table-bordered"
                           role="grid" style="" id="feeds">
                        <thead>
                            <tr>
                                <th width="3%">#</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th class="text-center">Feed Seen</th>
                                <th width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

@endsection




@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
{{--    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"--}}
{{--            type="text/javascript"></script>--}}
    <script src="{{ asset('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#title').select2({
                placeholder: 'Please Select Title',
                allowClear: true
            });

            var feedContainer = $("#feeds");

            $('input[name="date_range"]').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY/MM/DD'
                },
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + '--' + picker.endDate.format('YYYY/MM/DD'));
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            feedContainer.dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: true,
                ajax: {
                    url: '{{ route('feed.ajax.request') }}',
                    {{--url: '{{ route('lead-list.ajex') }}',--}}
                    data: {
                        title: function () {
                            return $('#title').val();
                        },
                        date_range: function () {
                            return $('input[name="date_range"]').val();
                        },
                        category: function () {
                            return $('#category').val();
                        },
                        type: function () {
                            return $('#type').val();
                        },
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
                        name: 'type',
                        width: "5%",
                        render: function (data, type, row) {
                            return row.type;
                        }
                    },
                    {
                        name: 'category',
                        width: "6%",
                        render: function (data, type, row) {
                            return row.category.title;
                        }
                    },
                    {
                        name: 'title',
                        width: "10%",
                        render: function (data, type, row) {
                            let status =  (row.status === 0) ? '<span class="text-danger"> (Inactive)</span>' : '';
                            let showInHome =  (row.show_in_home === 1) ? '<span class="text-success"> (Showing In Home)</span>' : '';
                            return  row.title + `<br>` + showInHome + ` ` + status;
                        }
                    },
                    {
                        name: 'start_date',
                        width: "10%",
                        render: function (data, type, row) {
                            return row.start_date;
                        }
                    },
                    {
                        name: 'end_date',
                        width: "10%",
                        render: function (data, type, row) {
                            return row.end_date;
                        }
                    },
                    {
                        name: 'feed_hit_counts_count',
                        width: "3%",
                        className: 'text-center',
                        render: function (data, type, row) {
                            return row.feed_hit_counts_count ? row.feed_hit_counts_count : 0;
                        }
                    },

                    {
                        name: 'actions',
                        width: "7%",
                        // className: 'filter_data',
                        render: function (data, type, row) {
                            let edit = "{{ URL('feeds') }}" + "/" + row.id + "/edit";
                            let deleteFeed = "{{ URL('feeds') }}" + "/" + row.id;
                            let csrf = `@csrf`;
                            let method = `{{ method_field('DELETE') }}`;
                            return `
                                    <a href="`+edit+`" role="button" class="btn-sm btn-outline-cyan border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <button data-id="`+row.id+`" title="Delete Feed" class="btn-sm btn-outline-danger border-0 delete" onclick="">
                                        <i class="la la-trash"></i>
                                    </button>
                                    <form id="delete-form-`+row.id+`"
                                          action="`+deleteFeed+`"
                                          method="POST" style="display: none;">
                                        `+csrf+`
                                        `+method+`
                                    </form>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            feedContainer.on("click", '.delete', function(){
                var id = $(this).attr('data-id');

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
                        event.preventDefault();
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                })
            });

            $(document).on('change', '.filter', function (e) {
                feedContainer.DataTable().ajax.reload();
            });

            $('#title').change(function() {
                feedContainer.DataTable().ajax.reload();
            });

            $('input[name="type"]').change(function() {
                feedContainer.DataTable().ajax.reload();
            });

            $('#category').change(function() {
                feedContainer.DataTable().ajax.reload();
            });

            $('#type').change(function() {
                feedContainer.DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                feedContainer.DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                feedContainer.DataTable().ajax.reload();
            });
        });
    </script>
@endpush
