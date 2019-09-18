@extends('layouts.admin')
@section('title', 'Mixed Bundle')
@section('card_name', 'Mixed Bundle')
@section('breadcrumb')
    <li class="breadcrumb-item active">Mixed Bundle List</li>
@endsection
@section('action')
    <a href="{{route('mixedBundleOffer.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Mixed Bundle 
    </a>
@endsection
@section('content')
   
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h1 class="card-title pl-1">Mixed Bundle List</h1>
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Internet</th>
                            <th>Minutes</th>
                            <th>SMS</th>
                            <th>Validity</th>
                            <th>Price</th>
                            <th>Points</th>
                            <th>Offer Code</th>
                            {{-- <th>Tag</th> --}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($mixedBundle_offers as $mixedBundle_offer)
                            <tr>
                                <td>{{$mixedBundle_offer->id}}</td>
                                <td>{{$mixedBundle_offer->title}}</td>
                                <td>{{$mixedBundle_offer->internet}}</td>
                                <td>{{$mixedBundle_offer->minutes}}</td>
                                <td>{{$mixedBundle_offer->sms}}</td>
                                <td>{{$mixedBundle_offer->validity}}</td>
                                <td>{{$mixedBundle_offer->price}}</td>
                                <td>{{$mixedBundle_offer->points}}</td>
                                <td>{{$mixedBundle_offer->offer_code}}</td>
                                {{-- <td>{{$mixedBundle_offer->tag}}</td> --}}
                                <td>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <a role="button" href="{{route('mixedBundleOffer.edit',$mixedBundle_offer->id)}}" class="btn btn-outline-success">
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-5">
                                            <button data-id="{{$mixedBundle_offer->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('mixedBundleOffer/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('mixedBundleOffer/') }}"
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
@endpush