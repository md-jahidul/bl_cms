@extends('layouts.admin')
@section('title', 'questions List')
@section('card_name', 'Question List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Short-Cuts List</li>
@endsection

@section('content_header')
    <h1 class="content-header-title mb-0 d-inline-block">
        Short-Cuts List
    </h1>
    <p class="rounded">
       @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('danger') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </p>
@endsection

@section('main-content')
    <!-- /short cut add form -->
    <form action=" @if(isset($short_cut_info)) {{route('short_cuts.update',$short_cut_info->id)}} @else {{route('short_cuts.store')}} @endif " method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($short_cut_info)) @method('put') @else @method('post') @endif
        <div class="row pl-1">
            <div class="col-md-4">

                <div class="form-group">
                    <div class="row">
                        {{-- <label for="title">Title:</label> --}}
                        <input value="@if(isset($short_cut_info)) {{$short_cut_info->tittle}} @endif" type="text" name="tittle" class="form-control @error('tittle') is-invalid @enderror" id="tittle" placeholder="Enter Shor Cuts Name..">
                        <small class="text-danger"> @error('tittle') {{ $message }} @enderror </small>
                    </div>
                </div>

            </div>

            <div class="col-md-5">

                <div class="form-group">
                    {{-- <label for="logo">Logo :</label> --}}
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="icon" type="file" class="custom-file-input @error('icon') is-invalid @enderror" id="icon">
                            <label class="custom-file-label" for="icon">Upload icon...</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                    <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                </div>

            </div>
            <div class="col-md-3" >
                <button type="submit" style="width:100%" class="btn btn-info">Add Short Cut</button>
            </div>
            
        </div>
    </form>
    <!-- /short cut add form -->
    <div class="card card-info">
        <div class="card-header">
            
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
            

            <table id="" class="table table-striped table-flushed dom-jQuery-events">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Tittle</th>
                    <th>icon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($short_cuts as $short_cut)
                    <tr>
                        <td>{{$short_cut->id}}</td>
                        <td>{{$short_cut->tittle}}</td>
                        <td><img style="height:20px;width:20px" src="{{asset($short_cut->icon)}}" alt="" srcset=""></td>
                        <td>
                            <div class="row">
                                
                                <div class="col-md-2">
                                    <a role="button" href="{{route('short_cuts.edit',$short_cut->id)}}" class="btn btn-outline-success">
                                        <i class="la la-pencil"></i>
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <button data-id="{{$short_cut->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
                                </div>

                            </div>
                        </td>

                    </tr>

                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>id</th>
                    <th>Tittle</th>
                    <th>icon</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->



@endsection

@section('content_right_side_bar')
    <h1>
        info
    </h1>
@endsection


@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style></style>
@endpush
@push('script')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script>
        
        // $(function () {
        //     $("#example1").DataTable();
        //     $('#example2').DataTable({
        //     "paging": true,
        //     "lengthChange": true,
        //     "lengthMenu": [[5,10, 25, 50], [5,10, 25, 50]],
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     });
        // });

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
                            url: "{{ url('short_cuts/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('short_cuts') }}"
                                }
                            }
                        })
                    }
                })
            })
        })

    </script>
@endpush