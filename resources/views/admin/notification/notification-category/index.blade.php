@extends('layouts.admin')
@section('title', 'Notification Category')
@section('card_name', 'Notification Category')
@section('breadcrumb')
    <li class="breadcrumb-item active">Notification Category List</li>
@endsection

@section('content')
<div class="card mb-0 px-1" style="box-shadow:none;">        
    <div class="card-content">
        <div class="card-body">
            <form class="form" method="POST" action="@if(isset($notificationCategory)) {{route('notificationCategory.update',$notificationCategory->id)}} @else {{route('notificationCategory.store')}} @endif" novalidate >
                @csrf
                @if(isset($notificationCategory)) 
                    @method('put')
                @else
                    @method('post')
                @endif
                <div class="form-body">
                    <h4 class="form-section"><i class="la la-key"></i>
                        @if(isset($notificationCategory))
                            Edit "{{$notificationCategory->name}}" Category
                        @else
                            Create Notification Category 
                        @endif
                    </h4>
                    <div class="row">
                        <div class="col-md-10">
                           <label for="name" class="required">Notification Category :</label>
                            <input type="text" 
                            required
                            maxlength="200" 
                            data-validation-regex-regex="(([aA-zZ' '])([0-9/.])*)*"
                            data-validation-required-message="Name is required" 
                            data-validation-regex-message="Name must start with alphabets"
                            data-validation-maxlength-message = "Name can not be more then 200 Characters" 
                             
                            value="@if(isset($notificationCategory)) {{$notificationCategory->name}} @elseif(old("name")) {{old("name")}} @endif" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Notification Category..">  
                            @if(isset($notificationCategory))
                                <input type="hidden" name="id" value="{{$notificationCategory->id}}">
                            @endif
                            <div class="help-block">
                                <small class="text-info"> Notification category can not be more then 200 characters</small><br>
                            </div>
                            <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group" style="margin-top:26px">
                                <button class="btn btn-outline-success" style="width:100%;padding:7.5px 12px" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

<section>
    <div class="card card-info mt-0" style="box-shadow: 0px 0px">
        <div class="card-content">
            <div class="card-body card-dashboard">
                <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1" role="grid" aria-describedby="Example1_info" style="">
                    <thead>
                    <tr>
                        <th width="100">ID</th>
                        <th>Tittle</th>
                        <th width="210">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($notificationCategories as $notificationCategory)
                            <tr>
                                <td>{{$notificationCategory->id}}</td>
                                <td>{{$notificationCategory->name}}<span class="badge badge-default badge-pill bg-primary float-right">{{$notificationCategory->notifications->count()}}</span></td>
                                <td>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information" data-placement="left" href="{{route('notificationCategory.edit',$notificationCategory->id)}}" class="btn-pancil btn btn-outline-success" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <button data-id="{{$notificationCategory->id}}" data-toggle="tooltip" data-original-title="Delete Slider" data-placement="right" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('notificationCategory/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('notificationCategory') }}"
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
                "bDestroy": true,
                "pageLength": 10
            });
        });

    </script>
@endpush