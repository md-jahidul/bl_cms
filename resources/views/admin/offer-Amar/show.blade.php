@extends('layouts.admin')
@section('title', 'Amar Offer')
@section('card_name', 'Amar Offer')
@section('breadcrumb')
    <li class="breadcrumb-item active">Amar Offer details</li>
@endsection
@section('action')
    <a href="{{route('amarOffer.index')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Amar Offer List
    </a>
@endsection
@section('content')
   
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h1 class="card-title pl-1">Amar Offer "{{$amarOffer->title}}"</h1>
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>title</th>
                                <td>{{$amarOffer->title}}</td>
                                <th>internet</th>
                                <td>{{$amarOffer->internet}}</td>
                            </tr>
                            <tr>
                                <th>minutes</th>
                                <td>{{$amarOffer->minutes}}</td>
                                <th>sms</th>
                                <td>{{$amarOffer->sms}}</td>
                            </tr>
                            <tr>
                                <th>validity</th>
                                <td>{{$amarOffer->validity}}</td>
                                <th>price</th>
                                <td>{{$amarOffer->price}}</td>
                            </tr>
                            <tr>
                                <th>points</th>
                                <td>{{$amarOffer->points}}</td>
                                <th>tag</th>
                                <td>{{$amarOffer->tag}}</td>
                            </tr>
                            <tr>
                                <th colspan="2">offer_code</th>
                                <td colspan="2">{{$amarOffer->offer_code}}</td>
                            </tr>
                                
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
                            url: "{{ url('amarOffer/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('amarOffer/') }}"
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