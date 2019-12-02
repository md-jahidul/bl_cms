@extends('layouts.admin')
@php $cardname = isset($banner_info)? 'Edit-Banner':'Create-Banner' @endphp
@section('title', "Banner")
@section('card_name', "Banner-edit")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        @if(isset($banner_info))
            Edit-Banner
            @else
            Create-Banner
        @endif
    </li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">
                @if(isset($banner_info))
                    Edit-Banner
                    @else
                    Create-Banner
                @endif
            </h1>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">

            <!-- /short cut add form -->
            @if(isset($banner_info))             
                <form novalidate action="{{ route('banner.update',$banner_info->id) }}" method="post" enctype="multipart/form-data">
                @else
                <form novalidate action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
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
                            <label for="name" class="required">Banner Name:</label>
                            <input 
                            required
                            maxlength="200" 
                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                            data-validation-required-message="Banner Name is required" 
                            data-validation-regex-message="Banner Name must start with alphabets"
                            data-validation-maxlength-message = "Banner Name can not be more then 200 Characters"
                            id="name" value="@if(isset($banner_info)){{$banner_info->name}} @elseif(old("name")) {{old("name")}} @endif" type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="title" placeholder="Enter Banner Name..">
                            <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                            <div class="help-block">
                                <small class="text-info">Banner Name can not be more then 200 Characters</small>
                            </div>
                        </div>
                        @if(isset($banner_info)) <input type="hidden" name="id" value="{{$banner_info->id}}"> @endif
                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <label for="image_name" class="required">Image Name:</label>
                            <input
                            required
                            maxlength="200" 
                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                            data-validation-required-message="Image Name is required" 
                            data-validation-regex-message="Image Name must start with alphabets"
                            data-validation-maxlength-message = "Image Name can not be more then 200 Characters"
                            id="image_name" value="@if(isset($banner_info)){{$banner_info->image_name}} @elseif(old("image_name")) {{old("image_name")}} @endif" type="text" name="image_name" class="form-control @error('image_name') is-invalid @enderror" placeholder="Enter Image Name..">
                            <small class="text-danger"> @error('image_name') {{ $message }} @enderror </small>
                            <div class="help-block">
                                <small class="text-info">Image Name can not be more then 200 Characters</small>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <label for="code" class="required">Code:</label>
                            <input required data-validation-required-message="Code is required" id="code" value="@if(isset($banner_info)){{$banner_info->code}} @elseif(old("code")) {{old("code")}} @endif" type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Banner code..">
                            <small class="text-danger"> @error('code') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <label for="url" class="required">URL:</label>
                            <input 
                            required
                            data-validation-required-message="URL is required"
                            data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*"
                            data-validation-regex-message="URL must be a valid link"
                            id="url" value="@if(isset($banner_info)){{$banner_info->redirect_url}}@elseif(old("redirect_url")) {{old("redirect_url")}} @endif" type="url" name="redirect_url" class="form-control @error('redirect_url') is-invalid @enderror" placeholder="URL..">
                            <small class="text-danger"> @error('redirect_url') {{ $message }} @enderror </small>
                            <div class="help-block">
                                <small class="text-info">Enter valid link..</small>
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-12">
                        @if(isset($banner_info)) 
                            <img style="height:100px;width:200pxl" id="imgDisplay" src="{{asset($banner_info->image_path)}}"/>
                            @else 
                            <img src="" style="height:100px;width:200px;display:none" id="imgDisplay"/>
                        @endif
                    </div>

                    <div class="col-12">
                        
                        <div class="form-group">
                            <label for="banner" id="bor" class="required">Banner :</label>
                            <div id="banner" class="input-group">
                                <div class="custom-file">
                                    <input 
                                    accept="image/*" 
                                    @if(!isset($banner_info))  
                                        required 
                                        data-validation-required-message="Image is required"
                                    @endif 
                                    accept="image/*" 
                                    onchange="
                                    createImageBitmap(this.files[0]).then((bmp) => {
                                                                                                
                                        if(bmp.width/bmp.height == 16/9){
                                            console.log('yes')
                                            document.getElementById('submitForm').disabled = false;
                                            document.getElementById('massage').innerHTML = '';
                                            this.style.border = 'none';
                                        }else{ 
                                            console.log('no')
                                            this.style.border = '1px solid red';
                                            document.getElementById('massage').innerHTML = '<b>image aspact ratio must 16:9(change the picture to enable button)</b>';
                                            document.getElementById('massage').classList.add('text-danger');
                                            document.getElementById('submitForm').disabled = true;
                                        } 
                                    })" 
                                    
                                    name="image_path" 
                                    type="file" 
                                    id="image"
                                    class="custom-file-input @error('image_path') is-invalid @enderror">
                                    <label class="custom-file-label" for="imgInp">Upload Banner...</label>
                                </div>
                            </div>
                            <div class="help-block">
                                <small class="text-danger" id="msg"> @error('image_path') {{ $message }} @enderror </small>
                                <small class="text-info">image aspact ratio must be in 16:9</small>
                            </div>
                            <div id="massage"></div>
                        </div>

                    </div>
                    <div class="col-2 mb-2" >
                        
                        <button type="submit" id="submitForm" style="width:100%" class="btn @if(isset($banner_info)) btn-success @else btn-info @endif ">
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

    
@endpush