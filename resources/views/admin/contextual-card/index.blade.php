@extends('layouts.admin')
@section('title', 'Contextual Card')
@section('card_name', 'Contextual Card')
@section('breadcrumb')
    <li class="breadcrumb-item active">Contextual Card  list</li>
@endsection
@section('action')
    <a href="{{route('contextualcard.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Contextual Card 
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h1 class="card-title pl-1">Contextual Card List</h1>
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width='10%'>ID</th>
                            <th width='20%'>Title</th>
                            <th width='30%'>Description</th>
                            <th width='10%'>Image</th>
                            <th width='30%'>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($contextualCards as $contextualCard)
                            <tr>
                                <td width='10%' >{{$contextualCard->id}}</td>
                                <td width='20%' >{{$contextualCard->title}}</td>
                                <td width='30%' >{{$contextualCard->description}}</td>
                                <td width='10%' ><img style="height:50px;width:100px" src="{{asset($contextualCard->image_url)}}" alt="" srcset=""></td>
                                <td width='30%' >
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a role="button" href="{{route('contextualcard.show',$contextualCard->id)}}" class="btn btn-outline-info"><i class="la la-info"></i></a>
                                        </div>
                                        <div class="col-md-2">
                                            <a role="button" href="{{route('contextualcard.edit',$contextualCard->id)}}" class="btn btn-outline-success">
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <button  data-id="{{$contextualCard->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('card/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('contextualcard') }}"
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