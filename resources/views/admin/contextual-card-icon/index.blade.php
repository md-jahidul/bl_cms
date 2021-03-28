@extends('layouts.admin')
@section('title', 'Contextual Card Icons')
@section('card_name', 'Contextual Card Icons')
@section('breadcrumb')
    <li class="breadcrumb-item active">Contextual Card Icon list</li>
@endsection
@section('action')
    @if(count($contextualCards)<1)
    <a href="{{route('contextual.card.icons.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Contextual Card Icon
    </a>
    @endif
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
{{-- <h1 class="card-title pl-1">Contextual Card Icon List</h1>--}}
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard table-responsive">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width='10%'>ID</th>
                            <th width='20%'>Card number</th>
                            <th width='10%'>Category</th>
                            <th width='10%'>Icon</th>
                            <th width='10%'>Remark</th>
                            <th width='10%'>Create Date</th>
                            <th width='10%'>Update Date</th>
                            <th width='30%'>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($contextualCards as $contextualCard)
                            <tr>
                                <td width='10%' >{{$contextualCard->id}}</td>
                                <td width='20%' >{{$contextualCard->card_number}}</td>
                                <td width='10%' >{{$contextualCard->category}}</td>
                                <td width='10%' >
                                    <img style="height:50px;width:100px" src="{{asset($contextualCard->icon)}}" alt="" srcset="">
                                 </td>
                                <td width='10%' >{{$contextualCard->remark}}</td>
                                <td width='10%' >{{$contextualCard->created_at}}</td>
                                <td width='10%' >{{$contextualCard->updated_at}}</td>
{{--                                <td width='10%' ><img style="height:50px;width:100px" src="{{asset($contextualCard->image_url)}}" alt="" srcset=""></td>--}}
                                <td width='20%' >
                                    <div class="row justify-content-md-center no-gutters">
{{--                                        <div class="col-md-6">--}}
{{--                                            <a role="button" href="{{route('contextualcard.icons.show',$contextualCard->id)}}" class="btn btn-outline-info mr-1"><i class="la la-info"></i></a>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
                                            <a role="button" href="{{route('contextualcardicon.edit',$contextualCard->id)}}" class="btn btn-outline-success">
                                                <i class="la la-pencil"></i>
                                            </a>
{{--                                        </div>--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <button  data-id="{{$contextualCard->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>--}}
{{--                                        </div>--}}
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
                // dom: 'Blfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "pageLength": 10,
                "bDestroy": true,
            });
        });

    </script>
@endpush
