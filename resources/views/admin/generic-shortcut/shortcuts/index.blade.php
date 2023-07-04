@extends('layouts.admin')
@section('title', 'Shortcuts List')
@section('card_name', 'Shortcuts')
@section('breadcrumb')
    <li class="breadcrumb-item active">Shortcuts List</li>
@endsection

@section('content_header')
    <h1 class="content-header-title mb-0 d-inline-block">
        Shortcuts List
    </h1>
@endsection

@if(isset($shortcut))
@section('action')
    <a href="{{ route('generic-shortcut.create', $shortcut->id) }}" class="btn btn-info btn-glow px-2">
        Create New
    </a>
@endsection
@endif

@section('content')
    <!-- /short cut add form -->
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width='5%'><i class="icon-cursor-move icons"></i></th>
                            <th>Title EN</th>
                            <th>Title BN</th>
                            <th>Navigate Action</th>
                            <th>Icon</th>
                            <th>Is Default</th>
                            <th>Customer Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @php $shortcuts = isset($shortcut) ? $shortcut->shortcuts->sortBy('sort_order') : [] @endphp
                        @foreach ($shortcuts as $index => $value)
                            <tr data-index="{{ $value->id }}" data-position="{{ $value->sort_order }}">
                                <td width="5%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{$value->title_en}}</td>
                                <td>{{$value->title_bn}}</td>
                                <td>
                                    {{ $actionList[$value->component_identifier] ?? '' }}
                                </td>
                                <td><img style="height:20px;width:20px" src="{{asset($value->icon)}}"
                                         alt="" srcset=""></td>
                                <td width="10%">
                                    @if($value->is_default==1) Not Default @else Default @endif
                                </td>
                                <td width="10%">
                                    {{ $value->customer_type }}
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="btn-group" role="group">
                                            <a type="button"
                                               title="Edit"
                                               href="{{ route('generic-shortcut.edit', $value->id) }}"
                                               class="btn btn-icon btn-outline-primary">
                                                <i class="la la-pencil"></i>
                                            </a>
                                            <button type="button"
                                                    title="Delete"
                                                    data-id="{{$value->id}}"
                                                    class="btn btn-icon btn-outline-danger delete">
                                                <i class="la la-remove"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>


@endsection

@section('content_right_side_bar')
    <h1>
        info
    </h1>

@endsection


@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>

        let auto_save_url = "{{ url('generic-shortcut-update-position') }}";

        $(function () {
           var content = "";
            var url_html;
            var parse_data;
            let dial_html, other_info = '';
            var js_data = `<?php echo isset($shortcut_info) ? $shortcut_info->other_info : null; ?>`;

            //console.log(js_data);

            if (js_data) {
                parse_data = JSON.parse(js_data);
                content = parse_data.content;
            }

            $('.delete').click(function () {
                var id = $(this).attr('data-id');
                var masterId = "{{ isset($shortcut) ? $shortcut->id : 1 }}"

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
                        $.ajax({
                            url: "{{ url('generic-shortcut/delete') }}/" + id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)

                                function redirect() {
                                    window.location.href = "{{ url('generic-shortcut') }}/" + masterId
                                }
                            }
                        })
                    }
                })
            })
            // add dial number
            dial_html = ` <div class="form-group other-info-div">
                                        <label>Dial Number</label>
                                        <input type="text" name="other_info" class="form-control" value="${content}" placeholder="Enter Valid Number" required>
                                        <div class="help-block"></div>
                                    </div>`;

            url_html = ` <div class="form-group other-info-div">
                                        <label>Redirect External URL</label>
                                        <input type="text" name="other_info" class="form-control" value="${content}" placeholder="Enter Valid URL" required>
                                        <div class="help-block"></div>
                                    </div>`;


            $('#navigate_action').on('change', function () {
                let action = $(this).val();
                if (action == 'DIAL') {
                    $("#append_div").html(dial_html);
                } else if (action == 'URL') {
                    $("#append_div").html(url_html);
                } else {
                    $(".other-info-div").remove();
                }
            })
        });


        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                "pageLength": 10,
                paging: true,
                searching: true,
                "bDestroy": true,
            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Icon to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Icon file'
                },
                error: {
                    'imageFormat': 'The image ratio must be 1:1.'
                }
            });
        });

    </script>
@endpush
