@extends('layouts.admin')
@section('title', 'Shortcuts List')
@section('card_name', 'Shortcuts')
@section('breadcrumb')
    <li class="breadcrumb-item active">Shortcuts List</li>
@endsection

@section('content_header')
    <h1 class="content-header-title mb-0 d-inline-block">
        Shortcuts List
    </h1>
@endsection

@section('content')
    <!-- /short cut add form -->
    <section>
        <form action=" @if(isset($short_cut_info)) {{route('short_cuts.update',$short_cut_info->id)}} @else {{route('short_cuts.store')}} @endif " method="post" enctype="multipart/form-data" novalidate>
            
            @csrf
            @if(isset($short_cut_info)) @method('put') @else @method('post') @endif
            <div class="container-fluid">
                <div class="row px-1 pt-1 bg-white">
                <h4 class="form-section col-md-12">
                    @if(isset($short_cut_info))
                        Update Shortcuts
                        @else
                        Create Shortcuts
                    @endif
                </h4>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title" class="required">Title :</label>
                        <input 
                         
                        required 
                        data-validation-required-message="Title is required" 
                        maxlength="50" 
                        data-validation-regex-regex="(([aA-zZ' '])([0-9/.])*)*"
                        data-validation-regex-message="Title must start with alphabets"
                        data-validation-maxlength-message = "Title can not be more then 50 Characters"
                        style="height:100%" value="@if(isset($short_cut_info)){{$short_cut_info->title}} @elseif(old("title")) {{old("title")}} @endif" type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Shorcut Name..">
                        <div class="help-block">
                            <small class="text-info"> Title can not be more then 50 Characters</small>
                        </div>
                        <input type="hidden" value="@if(isset($short_cut_info)) yes @else no @endif" name="value_exist">
                        @if(isset($short_cut_info)) 
                            <input type="hidden" value="{{$short_cut_info->id}}" name="id">
                        @endif
                        <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="default">Default :</label>
                        <select required class="form-control" value="" name="is_default" id="default">
                            <option @if(isset($short_cut_info)) @if($short_cut_info->is_default==0) selected @endif @endif value="0">Not Default</option>
                            <option @if(isset($short_cut_info)) @if($short_cut_info->is_default==1) selected @endif @endif value="1">Default</option>
                        </select>
                    </div>
                </div>
    
                @if(isset($short_cut_info))
                    <div class="col-md-12 mb-1"> 
                        <img style="height:100px;width:200px" id="imgDisplay" src="{{asset($short_cut_info->icon)}}" alt="" srcset="">
                    </div>
                    @else
                    <div class="col-md-12 mb-1"> 
                        <img style="height:100px;width:200px;display:none" id="imgDisplay" src="" alt="" srcset="">
                    </div>
                @endif
                
    
                <div class="col-md-10">
                    
                    <div class="form-group">
                        <label for="image" class="required">Upload Icon :</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input accept="image/*" 
                                @if(!isset($short_cut_info)) data-validation-required-message="Icon is required" @endif
                                onchange="createImageBitmap(this.files[0]).then((bmp) => {
                                                        
                                    if(bmp.width/bmp.height == 1/1){
                                        console.log('yes')
                                        document.getElementById('submitForm').disabled = false;
                                        document.getElementById('massage').innerHTML = '';
                                        this.style.border = 'none';
                                        this.nextElementSibling.innerHTML = '';
                                    }else{ 
                                        console.log('no')
                                        this.style.border = '1px solid red';
                                        document.getElementById('massage').innerHTML = '<b>Image aspact ratio must 1:1(Change the picture to enable button)</b>';
                                        document.getElementById('massage').classList.add('text-danger');
                                        document.getElementById('submitForm').disabled = true;
                                    } 
                                })" 
                                id="image" @if(!isset($short_cut_info)) required @endif  name="icon" type="file" class="custom-file-input @error('icon') is-invalid @enderror" id="icon">
                                <label class="custom-file-label" for="icon">Upload icon...</label>
                            </div>
                        </div>
                        <div class="help-block">
                            <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                            <small class="text-info"> Shortcut icon should be in 1:1 aspect ratio</small>
                        </div>
                        <small id="massage"></small>
                    </div>
    
                </div>
    
                <div class="col-md-2" style="margin-top:26px">
                    @if(isset($short_cut_info))
                            <button type="submit" id="submitForm" style="width:100%" class="btn btn-info">Update Shortcut</button>
                        @else
                            <button type="submit" id="submitForm" style="width:100%" class="btn btn-info">Add Shortcut</button>
                    @endif
                </div>
                
            </div>
        </div>
        </form>
            
    <div class="card card-info mt-0" style="box-shadow: 0px 0px">
        <div class="card-content">
            <div class="card-body card-dashboard">
                <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1" role="grid" aria-describedby="Example1_info" style="">
                    <thead>
                    <tr>
                        <th width="10%">id</th>
                        <th width="35%">Title</th>
                        <th width="5%">Icon</th>
                        <th width="10%">Is Default</th>
                        <th width="30%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($short_cuts as $short_cut)
                            <tr>
                                <td width="10%">{{$short_cut->id}}</td>
                                <td width="35%">{{$short_cut->title}}</td>
                                <td width="5%"><img style="height:20px;width:20px" src="{{asset($short_cut->icon)}}" alt="" srcset=""></td>
                                <td width="10%">
                                    @if($short_cut->is_default==1) Default @else Not Default @endif
                                </td>
                                <td width="30%">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information" data-placement="left" href="{{route('short_cuts.edit',$short_cut->id)}}" class="btn-pancil btn btn-outline-success" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <button data-id="{{$short_cut->id}}" data-toggle="tooltip" data-original-title="Delete Slider" data-placement="right" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('shortcuts/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('shortcuts/') }}"
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
                "pageLength": 10,
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

    </script>
@endpush