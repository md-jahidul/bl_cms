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
                            <input type="text" name="title" class="form-control"
                                   autocomplete="off" id="applicant_name" placeholder="Name">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="date" class="form-control showdropdowns filter datetime"
                                   autocomplete="off" id="date_picker" placeholder="Feed Seen Date">
                        </div>
                        <div class="form-group col-md-3 {{ $errors->has('lead_category') ? ' error' : '' }}">
                            <select class="form-control filter" name="type" id="lead_category" required>
                                <option value="">---Type---</option>
                                <option value="general">General</option>
                                <option value="youtube">Youtube</option>
                                <option value="facebook">Facebook</option>
                            </select>
                            <div class="help-block"></div>
                            @if ($errors->has('lead_category'))
                                <div class="help-block">{{ $errors->first('lead_category') }}</div>
                            @endif
                        </div>

                        <div class="form-group col-md-3 {{ $errors->has('lead_category') ? ' error' : '' }}">
                            <select class="form-control filter" name="category" id="lead_category" required>
                                <option value="">---Category---</option>
                                @foreach($categories as $data)
                                    <option value="{{ $data->id }}">{{ $data->title }}</option>
                                @endforeach
                            </select>
                            <div class="help-block"></div>
                            @if ($errors->has('lead_category'))
                                <div class="help-block">{{ $errors->first('lead_category') }}</div>
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
                                <th>Feed Seen</th>
                                <th width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
{{--                            @foreach ($feeds as $feed)--}}
{{--                            <tr>--}}
{{--                                <td>{{$loop->iteration}}</td>--}}
{{--                                <td>{{$feed->type}}</td>--}}
{{--                                <td>{{(isset($feed->category->title)?$feed->category->title:'')}}</td>--}}
{{--                                <td>{{(isset($feed->title)?$feed->title:'')}} {!! $feed->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>--}}
{{--                                <td>{{$feed->start_date}}</td>--}}
{{--                                <td>{{$feed->end_date}}</td>--}}
{{--                                <td>{{$feed->view_count}}</td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{ route('feeds.edit',$feed->id) }}" role="button" class="btn-sm btn-outline-cyan border-0"><i class="la la-pencil" aria-hidden="true"></i></a>--}}

{{--                                    <button data-id="{{$feed->id}}" title="Delete Feed" class="btn-sm btn-outline-danger border-0 delete" onclick="">--}}
{{--                                        <i class="la la-trash"></i>--}}
{{--                                    </button>--}}
{{--                                    <form id="delete-form-{{$feed->id}}"--}}
{{--                                          action="{{route('feeds.destroy',$feed->id)}}"--}}
{{--                                          method="POST" style="display: none;">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                    </form>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                        </tbody>
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
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
{{--    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"--}}
{{--            type="text/javascript"></script>--}}
    <script src="{{ asset('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            var date = new Date();
            date.setDate(date.getDate());

            $('input[name="date_picker"]').datetimepicker({
                format : 'YYYY-MM-DD',
                showClear: true,
                showClose: true,
                maxDate: date
            });

            $('input[name="date_picker"]').val('')

            $("#feeds").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ route('feed.ajax.request') }}',
                    {{--url: '{{ route('lead-list.ajex') }}',--}}
                    data: {
                        title: function () {
                            return $('input[name="title"]').val();
                        },
                        date: function () {
                            return $('input[name="date"]').val();
                        },
                        category: function () {
                            return $('#category').val();
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
                        width: "15%",
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
                            return row.title;
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
                        width: "8%",
                        render: function (data, type, row) {
                            return row.end_date;
                        }
                    },
                    {
                        name: 'view_count',
                        width: "8%",
                        render: function (data, type, row) {
                            return row.view_count;
                        }
                    },

                    {
                        name: 'actions',
                        width: "5%",
                        className: 'filter_data',
                        render: function (data, type, row) {
                            let edit = "{{ URL('feed/edit') }}" + "/" + row.id;
                            let deleteFeed = "{{ URL('feed') }}" + "/" + row.id;
                            let csrf = {{ csrf_token() }};
                            let method = {{ method_field('DELETE') }};
                            return `<td class="text-center">
                                       <a href="`+edit+`" role="button" class="btn-sm btn-outline-cyan border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <button data-id="`+row.id+`" title="Delete Feed" class="btn-sm btn-outline-danger border-0 delete" onclick="">
                                            <i class="la la-trash"></i>
                                        </button>
                                        <form id="delete-form-`+row.id+`"
                                              action="`+deleteFeed+`"
                                              method="POST" style="display: none;">
                                            `+csrf+`
                                            `+method+`
                                        </form>
                                    </td>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $('.delete').click(function () {
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
            })
        });
    </script>
@endpush
