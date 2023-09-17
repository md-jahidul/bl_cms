@extends('layouts.admin')
@section('title', 'Gamification')
@section('card_name', 'Gamification')
@section('breadcrumb')
    <li class="breadcrumb-item active">Gamification List</li>
@endsection

@section('action')
    <a href="{{route('gamification.create')}}" class="btn btn-primary round btn-glow px-2"><i
            class="la la-plus"></i>
        Create Gamification
    </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body card-dashboard">

                    <div class="row">
                        <div class="form-group col-md-3 {{ $errors->has('type') ? ' error' : '' }}">
                            <select class="form-control" name="type" id="type" required>
                                <option value="">All</option>
                                <option value="trivia">Trivia</option>
                                <option value="spin_wheel">Spin Wheel</option>
                            </select>
                            <div class="help-block"></div>
                            @if ($errors->has('type'))
                                <div class="help-block">{{ $errors->first('type') }}</div>
                            @endif
                        </div>
                    </div>

                    <table class="table table-striped table-bordered"
                           role="grid" style="" id="gamification">
                        <thead>
                            <tr>
                                <th width="3%">#</th>
                                <th>Type</th>
                                <th>Rule Name</th>
                                <th>Pending bottom label</th>
                                <th>Completed bottom label</th>
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
    <script src="{{ asset('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <script>
        $(document).ready(function () {

            var gamificationContainer = $("#gamification");

            gamificationContainer.dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: true,
                ajax: {
                    url: '{{ route('gamification.ajax.request') }}',
                    data: {
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
                        name: 'rule_name',
                        width: "5%",
                        render: function (data, type, row) {
                            return row.rule_name;
                        }
                    },
                    {
                        name: 'pending_bottom_label_en',
                        width: "10%",
                        render: function (data, type, row) {
                            return row.pending_bottom_label_en;
                        }
                    },
                    {
                        name: 'completed_bottom_label_en',
                        width: "10%",
                        render: function (data, type, row) {
                            return row.completed_bottom_label_en;
                        }
                    },

                    {
                        name: 'actions',
                        width: "7%",
                        // className: 'filter_data',
                        render: function (data, type, row) {
                            let edit = "{{ URL('gamification') }}" + "/" + row.id + "/edit";
                            let deleteGamification = "{{ URL('gamification') }}" + "/" + row.id;
                            let csrf = `@csrf`;
                            let method = `{{ method_field('DELETE') }}`;
                            return `
                                    <a href="`+edit+`" role="button" class="btn-sm btn-outline-cyan border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <button data-id="`+row.id+`" title="Delete Gamification" class="btn-sm btn-outline-danger border-0 delete" onclick="">
                                        <i class="la la-trash"></i>
                                    </button>
                                    <form id="delete-form-`+row.id+`"
                                          action="`+deleteGamification+`"
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

            gamificationContainer.on("click", '.delete', function(){
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
                gamificationContainer.DataTable().ajax.reload();
            });

            $('input[name="type"]').change(function() {
                gamificationContainer.DataTable().ajax.reload();
            });

            $('#type').change(function() {
                gamificationContainer.DataTable().ajax.reload();
            });
        });
    </script>
@endpush
