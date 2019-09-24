@extends('layouts.admin')
@section('title', 'Welcome Information')
@section('card_name', 'Welcome-Information')
@section('breadcrumb')
    <li class="breadcrumb-item active">Welcome-Information</li>
@endsection
@section('action')
    @if(isset($wellcomeInfo))
        <a href="{{route('welcomeInfo',$wellcomeInfo->id)}}" class="btn btn-primary round btn-glow px-2 mb-1"><i class="la la-plus"></i>
            Edit/Create Welcome Info
        </a>
    @else
        <a href="{{route('welcomeInfo')}}" class="btn btn-primary round btn-glow px-2 mb-1"><i class="la la-plus"></i>
            Edit/Create Welcome Info
        </a>
    @endif
    
@endsection

@section('content')
    <section>
        <div class="card">
            
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="row">
                        {{-- ----------------------------- --}}
                        <div class="col-6">
                            <h4 class="card-title text-dark">Guest:</h4>
                            <p class="text-dark">
                                @if(isset($wellcomeInfo))
                                    {{$wellcomeInfo->guest_salutation}}
                                @endif
                            </p>
                        </div>
                        <div class="col-6">
                            <h4 class="card-title text-dark">User:</h4>
                            <p class="text-dark">
                                @if(isset($wellcomeInfo))
                                    {{$wellcomeInfo->user_salutation}}
                                @endif
                            </p>
                        </div>
                        {{-- ----------------------------- --}}
                        <div class="col-6">
                            <p class="text-dark" style="text-align: justify;text-justify: inter-word;">
                                <small class="">
                                    @if(isset($wellcomeInfo))
                                        {{$wellcomeInfo->guest_message}}
                                    @endif
                                </small>
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="text-dark" style="text-align: justify;text-justify: inter-word;">
                                <small class="">
                                    @if(isset($wellcomeInfo))
                                        {{$wellcomeInfo->user_message}}
                                    @endif
                                </small>
                            </p>
                        </div>
                        {{-- ----------------------------- --}}
                        <div class="col-6">
                            <p class="text-dark">
                                <small class="">
                                    @if(isset($wellcomeInfo))
                                        <img style="height:100px;width:200px" src="{{ asset($wellcomeInfo->icon)}}" alt="" srcset="">
                                    @endif
                                </small>
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="text-dark">
                                <small class="">
                                    @if(isset($wellcomeInfo))
                                        <img style="height:100px;width:200px" src="{{ asset($wellcomeInfo->icon)}}" alt="" srcset="">
                                    @endif
                                </small>
                            </p>
                        </div>
                        {{-- ----------------------------- --}}
                    </div>
                    
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
                            url: "{{ url('banner/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('banner/') }}"
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