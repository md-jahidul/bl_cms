@extends('layouts.admin')
@section('title', 'Internet Offer Categories')
@section('card_name', 'Internet Offer Categories')
@section('breadcrumb')
    <li class="breadcrumb-item active">Internet Offer Category List</li>
@endsection
@section('action')
    <a href="{{ route('mybl.internetOffer.category.create')}}" id="add_category_btn" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Internet Offer Category
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
                            <th width='5%'>SL</th>
                            <th width='15%'>Name</th>
                            <th width='20%'>Slug</th>
                            <th width='10%'>sort</th>
                            <th width='20%'>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($offerCategory as $key=>$internet_offer)
                            <tr>
                                <td width='5%'>{{++$key}}</td>
                                <td width='35%'>{{$internet_offer->name}}</td>
                                <td width='35%'>{{$internet_offer->slug}}</td>
                                <td width='10%'>{{$internet_offer->sort}} </td>
                                <td width='10%'>
                                    <div class="btn-group" role="group">
                                        <a role="button" href="{{route('mybl.internetOffer.category.edit',$internet_offer->id)}}" class="btn btn-outline-success">
                                            <i class="la la-pencil"></i>
                                        </a>
                                        {{-- <button data-id="{{$internet_offer->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button> --}}
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
    <style>
        div#Example1_length {
    margin-bottom: -42px;
}
    </style>
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
                            url: "{{ url('mybl-internet-offer-category/delete') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('mybl-internet-offer-category/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })

        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Blfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "pageLength": 10,
                "bDestroy": true,
            });
        });
    </script>
@endpush
