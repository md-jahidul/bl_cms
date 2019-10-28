@extends('layouts.admin')
@section('title', 'App Version')
@section('card_name', 'App Version')
@section('breadcrumb')
    <li class="breadcrumb-item active">App Version</li>
@endsection
@section('action')
    <a href="{{route('app-version.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create App Version
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width='5%'>Serial</th>
                            <th width='10%'>Platform</th>
                            <th width='10%'>Version</th>
                            <th width='10%'>Force Update</th>
                            <th width='30%'>Message</th>
                            <th width='20%'>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $index = 0; @endphp
                        @foreach ($versions as $version)
                            @php $index++; @endphp
                            @if($version->force_update == 1)
                                @php $force_update = "Yes"; @endphp
                            @else
                                @php $force_update = "No"; @endphp
                            @endif
                            <tr>
                                <td width='5%'>{{$index}}</td>
                                <td width='10%'>{{$version->platform}}</td>
                                <td width='10%'>{{$version->current_version}}</td>
                                <td width='10%'>{{$force_update}}</td>
                                <td width='30%'>{{$version->message}}</td>
                                <td width='20%'>
                                    <div class="row justify-content-md-center no-gutters">
                                        <div class="col-md-3">
                                            <a role="button" href="{{route('app-version.edit',$version->id)}}" class="btn btn-outline-success">
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <button data-id="{{$version->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
   
    <!-- /.card -->



@endsection

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
                            url: "{{ url('app-version/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('app-version/') }}"
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
                paging: true,
                searching: true,
                "pageLength": 10,
                "bDestroy": true,
            });
        });

    </script>
@endpush