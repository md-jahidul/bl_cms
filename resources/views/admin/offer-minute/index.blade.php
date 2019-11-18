@extends('layouts.admin')
@section('title', 'Minutes Offer')
@section('card_name', 'Minutes Offer')
@section('breadcrumb')
    <li class="breadcrumb-item active">Minutes Offer List</li>
@endsection
@section('action')
    <a href="{{route('minuteOffer.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Minutes Offer
    </a>
@endsection
@section('content')

    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h1 class="card-title pl-1">Minutes Offer List</h1>
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width='5%'>ID</th>
                            <th width='20%'>Title</th>
                            <th width='10%'>Volume</th>
                            <th width='10%'>Validity</th>
                            <th width='10%'>Price</th>
                            <th width='15%'>Offer Code</th>
                            <th width='10%'>Points</th>
                            <th width='20%'>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($minute_offers as $minute_offer)
                            <tr>
                                <td width='5%'>{{$minute_offer->id}}</td>
                                <td width='20%'>{{$minute_offer->title}}</td>
                                <td width='10%'>{{$minute_offer->volume}}</td>
                                <td width='10%'>{{$minute_offer->validity}}</td>
                                <td width='10%'>{{$minute_offer->price}}</td>
                                <td width='15%'>{{$minute_offer->offer_code}}</td>
                                <td width='10%'>{{$minute_offer->points}}</td>
                                <td width='20%'>
                                    <div class="btn-group" role="group">
                                        <a role="button" href="{{route('minuteOffer.edit',$minute_offer->id)}}" class="btn btn-outline-success">
                                            <i class="la la-pencil"></i>
                                        </a>
                                        <button data-id="{{$minute_offer->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('minuteOffer/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('minuteOffer/') }}"
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
