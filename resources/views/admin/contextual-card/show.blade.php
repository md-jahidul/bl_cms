@extends('layouts.admin')
@section('title', 'Contextual Card')
@section('card_name', 'Contextual Card')
@section('breadcrumb')
    <li class="breadcrumb-item active">{{$contextualCard->title}} Card details</li>
@endsection
@section('action')
    <a href="{{route('contextualcard.index')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Contextual Card List
    </a>
@endsection
@section('content')
   
    <section>
        <div class="card">
            {{-- <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h1 class="card-title pl-1">Card "{{$contextualCard->title}}"</h1>
                    </div>
                </div>
            </div> --}}
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
                                <td colspan="4"><img style="height:150px;width:250px" src="{{asset($contextualCard->image_url)}}" alt="" srcset=""></td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td colspan="3">{{$contextualCard->title}}</td>
                            </tr>
                            <tr>
                                <th class="text-center" colspan="4">Description</th>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="4">{{$contextualCard->description}}</td>
                            </tr>
                            <tr>
                                <th>Minutes</th>
                                <td>{{$contextualCard->first_action_text}}</td>
                                <th>sms</th>
                                <td>{{$contextualCard->second_action_text}}</td>
                            </tr>
                            <tr>
                                <th>Validity</th>
                                <td>{{$contextualCard->first_action}}</td>
                                <th>Price</th>
                                <td>{{$contextualCard->second_action}}</td>
                            </tr>
                            <tr>
                                <td colspan="4"> 

                                    <div class="row justify-content-end">
                                        <div class="col-2">
                                            <a  style="width:100%" role="button" href="{{route('contextualcard.edit',$contextualCard->id)}}" class="btn btn-sm btn-success">
                                                {{-- <i class="la la-pencil"></i> --}}
                                                Edit
                                            </a>
                                        </div>
                                        <div class="col-2 pl-0">
                                            <button  style="width:100%" data-id="{{$contextualCard->id}}" class="btn btn-sm btn-danger delete" onclick="">
                                                {{-- <i class="la la-trash"></i> --}}
                                                Delete
                                            </button>
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
                                    window.location.href = "{{ url('contextualcard/') }}"
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