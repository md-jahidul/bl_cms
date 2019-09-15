@extends('layouts.admin')
@section('title', 'Wellcome Information')
@section('card_name', 'Wellcome-Information')
@section('breadcrumb')
    <li class="breadcrumb-item active">Wellcome-Information</li>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
           
            
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="@if(isset($wellcomeInfo)) {{route('wellcomeInfo.update',$wellcomeInfo->id)}} @else {{route('wellcomeInfo.store')}} @endif" enctype="multipart/form-data" method="POST">
                        @csrf
                        @if(isset($wellcomeInfo)) @method('put') @else @method('post') @endif
                        <input type="hidden" value="@if(isset($wellcomeInfo)) yes @else no @endif" name="value_exist">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Slider Information</h4>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                    <label for="guest_salutation">guest_salutation:<small class="text-danger">*</small></label>
                                    <input type="text" @if(isset($wellcomeInfo)) value="{{$wellcomeInfo->guest_salutation}}"  @else value=""  @endif  id="guest_salutation" class="form-control @error('title') is-invalid @enderror" placeholder="Slider Name" name="guest_salutation">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_salutation">user_salutation:<small class="text-danger">*</small></label>
                                    <input type="text" @if(isset($wellcomeInfo))  value="{{$wellcomeInfo->user_salutation}}"  @else value=""  @endif id="user_salutation" class="form-control @error('title') is-invalid @enderror" placeholder="Slider Name" name="user_salutation">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="guest_message">Guest Message :<small class="text-danger">*</small></label>
                                    <textarea name="guest_message" class="form-control" id="guest_message" rows="3">@if(isset($wellcomeInfo))  {{$wellcomeInfo->guest_message}} @endif </textarea>
                                    @error('guest_message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_message">User Message :<small class="text-danger">*</small></label>
                                    <textarea name="user_message" class="form-control" id="user_message" rows="3">@if(isset($wellcomeInfo))  {{$wellcomeInfo->user_message}} @endif</textarea>
                                    @error('user_message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="custom-file">
                                    <input name="icon" type="file" class="custom-file-input @error('title') is-invalid @enderror" id="validatedCustomFile">
                                    <label class="custom-file-label @error('title') is-invalid @enderror" for="validatedCustomFile">Choose Icon...</label>
                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    @error('icon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                           
                            
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success round px-2">
                            <i class="la la-check-square-o"></i> Save
                            </button>
                        </div>
                        </form>
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
                            url: "{{ url('slider/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('slider/') }}"
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