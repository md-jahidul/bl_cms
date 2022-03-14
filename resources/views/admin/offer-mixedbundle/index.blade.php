@extends('layouts.admin')
@section('title', 'Mixed Bundle')
@section('card_name', 'Mixed Bundle')
@section('breadcrumb')
    <li class="breadcrumb-item active">Mixed Bundle List</li>
@endsection
@section('action')
    <a href="{{route('mixedBundleOffer.create')}}" class="btn btn-primary  round btn-glow px-2"><i
            class="la la-plus"></i>
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
                            <th width="2%">ID</th>
                            <th width="40%">Title</th>
                            <th width="2%">Internet</th>
                            <th width="2%">Minutes</th>
                            <th width="2%">SMS</th>
                            <th width="2%">Validity</th>
                            <th width="2%">Price</th>
                            <th width="2%">Points</th>
                            <th width="20%">Offer Code</th>
                            <th width="30%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($mixedBundle_offers as $sl => $mixedBundle_offer)
                            <tr>
                                <td width="2%">{{ ++$sl }}</td>
                                <td width="40%">{{$mixedBundle_offer->title}}</td>
                                <td width="2%">{{$mixedBundle_offer->internet}}</td>
                                <td width="2%">{{$mixedBundle_offer->minutes}}</td>
                                <td width="2%">{{$mixedBundle_offer->sms}}</td>
                                <td width="2%">{{$mixedBundle_offer->validity}}</td>
                                <td width="2%">{{$mixedBundle_offer->price}}</td>
                                <td width="2%">{{$mixedBundle_offer->points}}</td>
                                <td width="20%">{{$mixedBundle_offer->offer_code}}</td>
                                {{-- <td>{{$mixedBundle_offer->tag}}</td> --}}
                                <td width="30%">
                                    <div class="btn-group" role="group">
                                        <a role="button"
                                           href="{{route('mixedBundleOffer.edit',$mixedBundle_offer->id)}}"
                                           class="btn btn-outline-success">
                                            <i class="la la-pencil"></i>
                                        </a>
                                        <a role="button" href="#" data-id="{{$mixedBundle_offer->id}}" class="btn btn-outline-danger delete">
                                            <i class="la la-trash"></i>
                                        </a>
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
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style></style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script>


        $(function () {
            $('.delete').click(function (e) {
                e.preventDefault();
                let id = $(this).attr('data-id');

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
                            url: "{{ url('mixedBundleOffer/destroy') }}/" + id,
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
                //dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "pageLength": 10,
                "bDestroy": true,
                "order": [[ 0, "desc" ]]
            });
        });

    </script>
@endpush
