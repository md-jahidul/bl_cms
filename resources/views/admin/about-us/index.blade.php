@extends('layouts.admin')
@section('title', 'About Banglalink')
@section('card_name', 'About Banglalink')
@section('breadcrumb')
@endsection
@section('action')
   {{-- @if(count($aboutUs) == 0)--}}
        <a href="{{ url('about-us/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
            Add New
        </a>
  {{--  @endif--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width='10%'>ID</th>
                            <th width='20%'>Title</th>
                          {{--  <th width='30%'>Description</th>--}}
                            <th width='25%'>Content Image</th>
                            <th width='25%'>Banner Image</th>
                            <th width='10%'>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @php $index = 0; @endphp
                        @foreach ($aboutUs as $about)
                            @php $index++; @endphp

                            <tr>
                                <td width='10%'>{{$about->id}}</td>
                                <td width='20%'>{{$about->title}}</td>
                               {{-- <td width='30%'>{{$about->banglalink_info}}</td>--}}
                                <td width='25%'>
                                    <img style="height:100px;width:180px;"
                                         src="{{ config('filesystems.file_base_url') . $about->content_image }}" id="profile_image_Display">
                                </td>
                                <td width='25%'>
                                    <img style="height:100px;width:180px;"
                                         src="{{ config('filesystems.file_base_url') . $about->banner_image }}" id="imgDisplay">
                                </td>
                                <td width='10%'>
                                    <div class="row justify-content-md-center no-gutters">
                                        <div class="col-md-3">
                                            <a role="button" href="{{route('about-us.edit',$about->id)}}" class="btn btn-outline-success">
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            {{--<button data-id="{{$about->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>--}}
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
@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
    </style>
@endpush

@push('page-js')

@endpush

@section('content_right_side_bar')
    <h1>
        List
    </h1>
@endsection


@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style></style>
@endpush


@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script>



        $(function () {
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
                        $.ajax({
                            url: "{{ url('about-us/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('about-us/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })

        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: false,
                searching: false,
                "pageLength": 10,
                "bDestroy": true,
            });
        });

    </script>
@endpush




