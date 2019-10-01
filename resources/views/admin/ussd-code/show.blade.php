@extends('layouts.admin')
@section('title', 'Amar Offer')
@section('card_name', 'Amar Offer')
@section('breadcrumb')
    <li class="breadcrumb-item active">Ussd Code Details</li>
@endsection
@section('action')
    <a href="{{route('ussd.index')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        USSD Code Details
    </a>
@endsection
@section('content')
   
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h1 class="card-title pl-1">USSD Code "{{$ussd_code->title}}"</h1>
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
                                <th colspan="1">Title</th>
                                <td colspan="3">{{$ussd_code->title}}</td>
                            </tr>
                            <tr>
                                <th colspan="1">Provider</th>
                                <td colspan="3">{{$ussd_code->provider}}</td>
                            </tr>
                            
                            <tr>
                                <th colspan="1">Purpose</th>
                                <td colspan="3">{{$ussd_code->purpose}}</td>
                            </tr>

                            <tr>
                                <th colspan="1">Code</th>
                                <td colspan="3">{{$ussd_code->code}}</td>
                            </tr>
                            
                            <tr>
                                <td colspan="4"> 
                                    <div class="row">
                                        <div class="col-8 text-danger font-weight-bold" style="padding-top:5px">
                                            {{$ussd_code->offer_code}}
                                        </div>
                                        <div class="col-2">
                                            <a  style="width:100%" role="button" href="{{route('ussd.edit',$ussd_code->id)}}" class="btn btn-sm btn-success">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <button style="width:100%" data-id="{{$ussd_code->id}}" class="btn btn-sm btn-danger delete" onclick="">Delete</button>
                                        </div>
                                    </div>
                                    
                                </td>
                                
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
                            url: "{{ url('ussd/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('ussd/') }}"
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