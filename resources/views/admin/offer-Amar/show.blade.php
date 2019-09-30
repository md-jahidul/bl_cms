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
                                <th width="10%">title</th>
                                <td width="40%">{{$amarOffer->title}}</td>
                                <th width="10%">tag</th>
                                <td width="40%">{{$amarOffer->tag}}</td>
                            </tr>
                            <tr>
                                <th width="10%">minutes</th>
                                <td width="40%">{{$amarOffer->minutes}}</td>
                                <th width="10%">sms</th>
                                <td width="40%">{{$amarOffer->sms}}</td>
                            </tr>
                            <tr>
                                <th width="10%">validity</th>
                                <td width="40%">{{$amarOffer->validity}}</td>
                                <th width="10%">price</th>
                                <td width="40%">{{$amarOffer->price}}</td>
                            </tr>
                            <tr>
                                <th width="10%">points</th>
                                <td width="40%">{{$amarOffer->points}}</td>
                                <th width="10%">internet</th>
                                <td width="40%">{{$amarOffer->internet}}</td>
                            </tr>
                            <tr>
                                <th width="10%" style="padding-top:12px">offer_code</th>
                                <td width="90%" colspan="3"> 
                                    <div class="row">
                                        <div class="col-8 text-danger font-weight-bold" style="padding-top:5px">
                                            {{$amarOffer->offer_code}}
                                        </div>
                                        <div class="col-2">
                                            <a  style="width:100%" role="button" href="{{route('amarOffer.edit',$amarOffer->id)}}" class="btn btn-sm btn-success">
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <button  style="width:100%" data-id="{{$amarOffer->id}}" class="btn btn-sm btn-danger delete" onclick=""><i class="la la-trash"></i></button>
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