@extends('layouts.admin')
@section('title', 'Notification')
@section('card_name', 'Notification')
@section('breadcrumb')
    <li class="breadcrumb-item active">Notification List</li>
@endsection

@section('content')
<div class="card mb-0 px-1" style="box-shadow:none;">        
    <div class="card-content">
        <div class="card-body">
            <form class="form" method="POST" action="{{route('notification.store')}}">
                @csrf
                @method('post')
                
                <div class="form-body">
                    <h4 class="form-section"><i class="la la-key"></i>
                        Create Notification 
                    </h4>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title :</label>
                                <input name="title" maxlength="200" style="height:100%" type="text" value="@if(old('title')) {{old('title')}} @endif" max="200" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title..">
                                <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id">category :</label>
                                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{ (old("category_id") == $category->id ? "selected":"") }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger"> @error('category_id') {{ $message }} @enderror </small>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="body">Body :</label>
                                <textarea class="form-control @error('body') is-invalid @enderror" placeholder="Enter body description....." id="body" name="body" rows="10">@if(old('body')){{old('body')}}@endif</textarea>
                                <small class="text-danger"> @error('body') {{ $message }} @enderror </small>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" style="">
                                <button class="btn btn-outline-success" placeholder="Enter body description.." style="width:100%;padding:7.5px 12px" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>



   


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
                            url: "{{ url('setting/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('setting/') }}"
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
            });
        });

    </script>
@endpush