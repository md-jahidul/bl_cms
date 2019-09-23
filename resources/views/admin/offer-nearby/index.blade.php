@extends('layouts.admin')
@section('title', 'Neare By Offer')
@section('card_name', 'Neare By Offer')
@section('breadcrumb')
    <li class="breadcrumb-item active">Neare By Offer list</li>
@endsection
@section('action')
    <a href="{{route('nearByOffer.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
       Create Near by offer 
    </a>
@endsection
@section('content')
   
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h1 class="card-title pl-1">Neare By Offer list</h1>
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width=''>ID</th>
                            <th width=''>Title</th>
                            <th width=''>Vendor</th>
                            <th width=''>Location</th>
                            <th width=''>Type</th>
                            <th width=''>Offer</th>
                            <th width=''>Offer Code</th>
                            <th width=''>Image</th>
                            <th width='100'>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($nearByOffers as $nearByOffer)
                                <tr>
                                    <td>{{$nearByOffer->id}}</td>
                                    <td>{{$nearByOffer->title}}</td>
                                    <td>{{$nearByOffer->vendor}}</td>
                                    <td>{{$nearByOffer->location}}</td>
                                    <td>{{$nearByOffer->type}}</td>
                                    <td>{{$nearByOffer->offer}}</td>
                                    <td>{{$nearByOffer->offer_code}}</td>
                                    
                                    <td><img style="height:50px;width:100px" src="{{asset($nearByOffer->image)}}" alt="" srcset=""> </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-4 mr-1">
                                                <a role="button" href="{{route('nearByOffer.edit',$nearByOffer->id)}}" class="btn btn-outline-success">
                                                    <i class="la la-pencil"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <button data-id="{{$nearByOffer->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('nearByOffer/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('nearByOffer/') }}"
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
                "pageLength": 5,
                "bDestroy": true,
            });
        });

    </script>
@endpush