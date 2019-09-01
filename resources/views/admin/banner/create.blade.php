@extends('layouts.admin')
@section('title', 'Create Banner')
@section('card_name', 'Create Banner')
@section('breadcrumb')
    <li class="breadcrumb-item active">Banner</li>
@endsection

{{-- @section('content_header')
    <h1 class="content-header-title">
        Banner
    </h1>
@endsection --}}

@section('content')

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Create Banner</h1>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">

            <!-- /short cut add form -->
             @if(isset($banner_info))             
                <form action="{{ route('banner.update',$banner_info->id) }}" method="post" enctype="multipart/form-data">
                @else
                <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
            @endif 

            @csrf
            @if(isset($banner_info))             
                @method('put')
                @else
                @method('post')
            @endif 
           
            <div class="row">

                    <div class="col-6">

                        <div class="form-group">
                            <label for="name">Banner Name: <span class="text-danger">*</span> </label>
                            <input id="name" value="@if(isset($banner_info)) {{$banner_info->name}} @endif" type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="title" placeholder="Enter Banner Name..">
                            <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                        </div>

                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <label for="image_name">Image Name: <span class="text-danger">*</span> </label>
                            <input id="image_name" value="@if(isset($banner_info)) {{$banner_info->image_name}} @endif" type="text" name="image_name" class="form-control @error('image_name') is-invalid @enderror" placeholder="Enter Image Name..">
                            <small class="text-danger"> @error('image_name') {{ $message }} @enderror </small>
                        </div>

                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <label for="code">Code: <span class="text-danger">*</span> </label>
                            <input id="code" value="@if(isset($banner_info)) {{$banner_info->code}} @endif" type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Banner code..">
                            <small class="text-danger"> @error('code') {{ $message }} @enderror </small>
                        </div>

                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <label for="url">URL: <span class="text-danger">*</span> </label>
                            <input id="url" value="@if(isset($banner_info)) {{$banner_info->redirect_url}} @endif" type="text" name="redirect_url" class="form-control @error('redirect_url') is-invalid @enderror" placeholder="URL..">
                            <small class="text-danger"> @error('redirect_url') {{ $message }} @enderror </small>
                        </div>

                    </div>
                    

                    <div class="col-12">
                        @if(isset($banner_info)) 
                                <img id="output" src="{{asset($banner_info->image_path)}}" width="500px" height="200px" style="display:block"/>
                            @else 
                                <img id="output" width="500px" height="250px" style="display:none"/>
                        @endif
                        <div class="form-group">
                            <label for="banner">Banner : <span class="text-danger">*</span> </label>
                            <div id="banner" class="input-group">
                                <div class="custom-file">
                                    <input accept="image/*" onchange="loadFile(event)" name="image_path" type="file" class="custom-file-input @error('image_path') is-invalid @enderror">
                                    <label class="custom-file-label" for="imgInp">Upload Banner...</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <small class="text-danger"> @error('image_path') {{ $message }} @enderror </small>
                        </div>

                    </div>
                    <div class="col-2 mb-2" >
                        
                        <button type="submit" style="width:100%" class="btn @if(isset($banner_info)) btn-success @else btn-info @endif ">
                            @if(isset($banner_info)) Update Banner @else Create Banner @endif 
                        </button>
                    </div>
                
                </div>
            </form>
            <!-- /short cut add form -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->



@endsection

@section('content_right_side_bar')
    <h1>
        List
    </h1>
@endsection


@push('style')
   
@endpush
@push('page-js')

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.style.display = "block"
        };
    </script>
@endpush