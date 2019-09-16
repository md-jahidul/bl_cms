{{--@extends('layouts.master-layout')--}}

{{--@section('main-content')--}}
{{--    <section class="content">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card mt-3">--}}
{{--                    <div class="card-header">--}}
{{--                        --}}{{--<div class="col-md-12">--}}
{{--                        <h3 class="card-title float-left">Slider Image List</h3>--}}
{{--                        <a href="{{ url('slider_image/create') }}" class="btn btn-success float-right" >Add Slider</a>--}}
{{--                        --}}{{--</div>--}}

{{--                    </div>--}}
{{--                    <!-- /.card-header -->--}}
{{--                    <div class="card-body">--}}
{{--                        <table id="example1" class="table table-bordered table-hover">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th># S.L</th>--}}
{{--                                <th>Slider Name</th>--}}
{{--                                <th>Title</th>--}}
{{--                                <th>Image</th>--}}
{{--                                <th>Description</th>--}}
{{--                                <th>Button Label</th>--}}
{{--                                <th>URL</th>--}}
{{--                                <th>Action</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @php($i = 0)--}}
{{--                                @foreach($slider_images as $slider_image)--}}
{{--                                    @php($i++)--}}
{{--                                    <tr>--}}
{{--                                        <td class="pt-4">{{ $i }}</td>--}}
{{--                                        <td class="pt-4">{{ $slider_image->slider['title'] }}</td>--}}
{{--                                        <td class="pt-4">{{ $slider_image->title }}</td>--}}
{{--                                        <td><img class="img-thumbnail" src="{{ asset($slider_image->image_url) }}" alt="Slider Image" height="100" width="120" /></td>--}}
{{--                                        <td class="pt-4">{{ $slider_image->description }}</td>--}}
{{--                                        <td class="pt-4">{{ $slider_image->url_btn_label }}</td>--}}
{{--                                        <td class="pt-4">{{ $slider_image->url }}</td>--}}
{{--                                        <td class="pt-4">--}}
{{--                                            <a href="{{ url("slider_image/$slider_image->id/edit") }}" class="btn btn-outline-info border-0"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>--}}
{{--                                            <button href="#" data-toggle="#danger" role="button" data-placement="right" data-id="{{ $slider_image->id }}" title="Delete" class="border-0 btn btn-outline-danger delete_btn"><i class="fas fa-trash" aria-hidden="true"></i></button>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                    <!-- /.card-body -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- /.col -->--}}
{{--        </div>--}}
{{--        <!-- /.row -->--}}
{{--    </section>--}}

{{--    --}}{{--User Create Modal--}}
{{--    <div class="modal fade" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}

{{--                <div class="modal-header bg-danger text-light">--}}
{{--                    <h1><i class="glyphicon glyphicon-thumbs-up"></i>Delete</h1>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
{{--                </div>--}}

{{--                <form id="deleteForm" action="" method="post">--}}
{{--                    @csrf--}}
{{--                    @method('delete')--}}
{{--                    <div class="modal-body">--}}
{{--                        <p id="modal-text" class="text-center font-weight-bold "></p>--}}
{{--                        <input name="id" id="deleteID" type="hidden" value="">--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-outline-info pull-left" data-dismiss="modal">Close</button>--}}
{{--                        <button type="Submit" class="btn btn-outline-danger pull-left">Delete</button>--}}
{{--                    </div>--}}
{{--                </form>--}}

{{--            </div><!-- /.modal-content -->--}}
{{--        </div><!-- /.modal-dialog -->--}}
{{--    </div><!-- /.modal -->--}}
{{--    <!-- Modal -->--}}
{{--@stop--}}

{{--@push('scripts')--}}
{{--<script>--}}

{{--    $(function () {--}}
{{--        $('.delete_btn').click(function () {--}}
{{--            var id = $(this).attr('data-id');--}}

{{--            Swal.fire({--}}
{{--                title: 'Are you sure?',--}}
{{--                text: "You won't be able to revert this!",--}}
{{--                type: 'warning',--}}
{{--                html: jQuery('.delete_btn').html(),--}}
{{--                showCancelButton: true,--}}
{{--                confirmButtonColor: '#f51c31',--}}
{{--                cancelButtonColor: '#1fdd4b',--}}
{{--                confirmButtonText: 'Yes, delete it!'--}}
{{--            }).then((result) => {--}}
{{--                if (result.value) {--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ url('slider_image/destroy') }}/"+id,--}}
{{--                        methods: "get",--}}
{{--                        success: function (res) {--}}
{{--                            Swal.fire(--}}
{{--                                'Deleted!',--}}
{{--                                'Your file has been deleted.',--}}
{{--                                'success',--}}
{{--                            );--}}
{{--                            setTimeout(redirect, 2000)--}}
{{--                            function redirect() {--}}
{{--                                window.location.href = "{{ url('slider_image') }}"--}}
{{--                            }--}}
{{--                        }--}}
{{--                    })--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    })--}}

{{--</script>--}}
{{--@endpush--}}



{{--@extends('layouts.admin')--}}
{{--@section('title', 'Slider List')--}}
{{--@section('card_name', 'Slider List')--}}
{{--@section('breadcrumb')--}}
{{--    <li class="breadcrumb-item active">Slider List</li>--}}
{{--@endsection--}}
{{--@section('action')--}}
{{--    <a href="{{ url('sliders/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Slider--}}
{{--    </a>--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--    <section>--}}
{{--        <div class="card">--}}
{{--            <div class="card-content collapse show">--}}
{{--                <div class="card-body card-dashboard">--}}

{{--                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"--}}
{{--                           id="Example1" role="grid" aria-describedby="Example1_info" style="">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th># S.L</th>--}}
{{--                            <th>Slider Name</th>--}}
{{--                            <th>Title</th>--}}
{{--                            <th>Image</th>--}}
{{--                            <th>Description</th>--}}
{{--                            <th>Alt Text</th>--}}
{{--                            <th>Button Label</th>--}}
{{--                            <th>Action</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($slider_images as $index=>$slider_image)--}}
{{--                            <tr>--}}
{{--                                <td class="pt-4">{{ ++$index }}</td>--}}
{{--                                <td class="pt-4">{{ $slider_image->slider['title'] }}</td>--}}
{{--                                <td class="pt-4">{{ $slider_image->title }}</td>--}}
{{--                                <td><img class="img-thumbnail" src="{{ asset("slider-images/".$slider_image->image_url) }}" alt="Slider Image" height="100" width="120" /></td>--}}
{{--                                <td class="pt-4">{{ $slider_image->description }}</td>--}}
{{--                                <td class="pt-4">{{ $slider_image->alt_text }}</td>--}}
{{--                                <td class="pt-4">{{ $slider_image->url_btn_label }}</td>--}}
{{--                                <td class="pt-4">--}}
{{--                                    <a href="{{ url("slider_image/$slider_image->id/edit") }}" class="btn btn-outline-info border-0"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>--}}
{{--                                    <button href="#" data-toggle="#danger" role="button" data-placement="right" data-id="{{ $slider_image->id }}" title="Delete" class="border-0 btn btn-outline-danger delete_btn"><i class="fas fa-trash" aria-hidden="true"></i></button>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}


{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </section>--}}

{{--@stop--}}

{{--@push('page-js')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#Example1').DataTable({--}}
{{--                dom: 'Bfrtip',--}}
{{--                buttons: [--}}
{{--                    {--}}
{{--                        extend: 'copy', className: 'copyButton',--}}
{{--                        exportOptions: {--}}
{{--                            columns: [0, 1, 2, 3]--}}
{{--                        }--}}
{{--                    },--}}
{{--                    {--}}
{{--                        extend: 'excel', className: 'excel',--}}
{{--                        exportOptions: {--}}
{{--                            columns: [0, 1, 2, 3]--}}
{{--                        }--}}
{{--                    },--}}
{{--                    {--}}
{{--                        extend: 'pdf', className: 'pdf', "charset": "utf-8",--}}
{{--                        exportOptions: {--}}
{{--                            columns: [0, 1, 2, 3]--}}
{{--                        }--}}
{{--                    },--}}
{{--                    {--}}
{{--                        extend: 'print', className: 'print',--}}
{{--                        exportOptions: {--}}
{{--                            columns: [0, 1, 2, 3]--}}
{{--                        }--}}
{{--                    },--}}
{{--                ],--}}
{{--                paging: true,--}}
{{--                searching: true,--}}
{{--                "bDestroy": true,--}}

{{--            });--}}
{{--        });--}}

{{--    </script>--}}
{{--@endpush--}}


@extends('layouts.admin')
@section('title', 'Quick Launch List')
@section('card_name', 'Quick Launch List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><strong>Quick Launch List</strong></li>
@endsection
@section('action')
    <a href="{{ url('quick-launch/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Quick Launch
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th>Slider Name</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Alt Text</th>
                            <th>Button Label</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($slider_images as $index=>$slider_image)
                            <tr>
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $slider_image->slider['title'] }}</td>
                                <td>{{ $slider_image->title }}</td>
                                <td><img class="" src="{{ asset("slider-images/".$slider_image->image_url) }}" alt="Slider Image" height="50" width="50" /></td>
                                <td>{{ $slider_image->description }}</td>
                                <td>{{ $slider_image->alt_text }}</td>
                                <td>{{ $slider_image->url_btn_label }}</td>
                                <td class="action" width="8%">
                                    <a href="{{ route('slider_image_edit', [ $slider_image->slider_id, $type, $slider_image->id ] ) }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("slider-image/destroy/$slider_image->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $slider_image->id }}" title="Delete the user">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf', "charset": "utf-8",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

    </script>

    <script>
        var auto_save_url = "{{ url('quick-launch-sortable') }}";
    </script>
@endpush





