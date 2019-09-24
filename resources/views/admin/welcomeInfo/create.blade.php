@extends('layouts.admin')
@section('title', 'Welcome Information')
@section('card_name', 'Welcome-Information')
@section('breadcrumb')
    <li class="breadcrumb-item active">Welcome-Information</li>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
           
            
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="@if(isset($welcomeInfo)) {{route('welcomeInfo',$welcomeInfo->id)}} @else {{route('welcomeInfo')}} @endif" enctype="multipart/form-data" method="POST">
                        @csrf
                        @if(isset($welcomeInfo)) @method('put') @else @method('post') @endif
                        <input type="hidden" value="@if(isset($welcomeInfo)) yes @else no @endif" name="value_exist">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Wellcome Information</h4>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                    <label for="guest_salutation">Guest Salutation:<small class="text-danger">*</small></label>
                                    <input required type="text" @if(isset($welcomeInfo)) value="{{$welcomeInfo->guest_salutation}}" @elseif(old('guest_salutation')) value="{{old('guest_salutation')}}"  @else value=""  @endif  id="guest_salutation" class="form-control @error('title') is-invalid @enderror" placeholder="Enter guest salutation." name="guest_salutation">
                                    @error('guest_salutation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_salutation">User Salutation:<small class="text-danger">*</small></label>
                                    <input required type="text" @if(isset($welcomeInfo))  value="{{$welcomeInfo->user_salutation}}"  @elseif(old("user_salutation")) value="{{old("user_salutation")}}"  @endif id="user_salutation" class="form-control @error('title') is-invalid @enderror" placeholder="Enter user salutation." name="user_salutation">
                                    @error('user_salutation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="guest_message">Guest Message :<small class="text-danger">*</small></label>
                                    <textarea required name="guest_message" class="form-control" id="guest_message" rows="3">@if(isset($welcomeInfo)){{$welcomeInfo->guest_message}}@elseif(old("guest_message")){{old("guest_message")}}@endif</textarea>
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
                                    <textarea required name="user_message" class="form-control" id="user_message" rows="3">@if(isset($welcomeInfo)){{$welcomeInfo->user_message}}@elseif(old("user_message")){{old("user_message")}} @endif</textarea>
                                    @error('user_message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @if(isset($welcomeInfo))
                                <div class="col-6">
                                    <p class="text-dark">
                                        <small class="">
                                            <img style="height:100px;width:200px" id="imgDisplay" src="{{ asset($welcomeInfo->icon)}}" alt="" srcset="">
                                        </small>
                                    </p>
                                </div>
                                @else
                                <div class="col-6">
                                    <p class="text-dark">
                                        <small class="">
                                            <img style="height:100px;width:200px;display:none" id="imgDisplay" src="" alt="" srcset="">
                                        </small>
                                    </p>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="custom-file">
                                    <input accept="image/*" @if(!isset($welcomeInfo)) required @endif @if(!isset($welcomeInfo)) @endif name="icon" type="file" class="custom-file-input @error('icon') is-invalid @enderror" id="image">
                                    <label class="custom-file-label @error('title') is-invalid @enderror" for="validatedCustomFile">Upload Icon...</label>
                                    <input type="hidden" name="update" value="@if(!isset($welcomeInfo)) yes @else no  @endif">
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