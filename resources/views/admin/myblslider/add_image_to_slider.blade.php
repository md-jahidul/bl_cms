@extends('layouts.admin')
@section('title', 'Add Image')
@section('card_name',"Image" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Add Image</li>
@endsection
@section('action')
    <a href="{{route('myblsliderImage.edit',$slider_information->id)}}" class="btn btn-info btn-glow px-2">
        Image list
    </a>
    <a href="{{route('myblslider.index')}}" class="btn btn-primary btn-glow px-2">
        Slider list 
    </a>
@endsection

@section('content')
    

    <section id="form-control-repeater">
        <div class="card">
            <div class="card-header">
                <h4 class="form-section"><i class="la la-paperclip"></i>Add Image to "{{$slider_information->title}}" Slider</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements"></div>
            </div>
            
            <div class="card-content collapse show">
            <div class="card-body">
            
                <div class="card-body">
                        <form novalidate class="form row" action="{{route('myblsliderImage.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('post')
                        <input type="hidden" hidden value="{{$slider_information->id}}" name="slider_id">
                        <div class="form-group col-12 mb-2 file-repeater">
                        
                            <div class="row mb-1">
                                <div class="form-group col-md-6 mb-2">
                                    <label for="title" class="required">Title:</label>
                                    <input 
                                    required
                                    maxlength="200" 
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><-])*)*"
                                    data-validation-required-message="Title is required" 
                                    data-validation-regex-message="Title must start with alphabets"
                                    data-validation-maxlength-message = "Title can not be more then 200 Characters" 
                                    value="@if(old('title')) {{old('title')}} @endif" required id="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title">
                                    <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label for="alt_text" class="required">Alt Text: </label>
                                    <input 
                                    required
                                    maxlength="200" 
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><-])*)*"
                                    data-validation-required-message="Alt Text is required" 
                                    data-validation-regex-message="Alt Text must start with alphabets"
                                    data-validation-maxlength-message = "Alt Text can not be more then 200 Characters"
                                    value="@if(old('alt_text')) {{old('alt_text')}} @endif" id="alt_text" type="text" class="form-control @error('alt_text') is-invalid @enderror" placeholder="Alt text" name="alt_text">
                                    <small class="text-danger"> @error('alt_text') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>
                                {{-- <div class="form-group col-md-6 mb-2">
                                    <label for="btn">Button URL: </label>
                                    <input id="btn" 
                                    data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*"
                                    data-validation-regex-message="Button URL must be a valid link"
                                    value="@if(old('url_btn_label')) {{old('url_btn_label')}} @endif"
                                    type="url" class="form-control" placeholder="Button Name" name="url_btn_label">
                                    <small class="text-danger"> @error('btn') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label for="url">URL: </label>
                                    <input 
                                    data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*"
                                    data-validation-regex-message="URL must be a valid link"
                                    value="@if(old('url')) {{old('url')}} @endif" id="url" type="url" class="form-control" placeholder="http.." name="url">
                                    <small class="text-danger"> @error('url') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>
                            
                                <div class="form-group col-12 mb-2">
                                    <label for="description">Description: </label>
                                    <textarea id="description" rows="5" class="form-control" name="description" placeholder="About Slider..">@if(old('description')) {{old('description')}} @endif</textarea>
                                </div> --}}
                                <div class="col-md-12 mb-1"> 
                                    <img style="height:100px;width:200px;display:none" id="imgDisplay" src="" alt="" srcset="">
                                </div>
                                <div class="col-md-12">
                                        
                                        <div class="form-group">
                                            <label for="image" class="required">Upload Image :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                <input accept="image/*" 
                                                required
                                                data-validation-required-message="Image is required" 
                                                onchange="createImageBitmap(this.files[0]).then((bmp) => {
                                                                        
                                                    if(bmp.width/bmp.height == 16/9){
                                                        console.log('yes')
                                                        document.getElementById('submitForm').disabled = false;
                                                        document.getElementById('massage').innerHTML = '';
                                                        this.style.border = 'none';
                                                        // this.nextElementSibling.innerHTML = '';
                                                    }else{ 
                                                        console.log('no')
                                                        this.style.border = '1px solid red';
                                                        document.getElementById('massage').innerHTML = '<b>image aspact ratio must 16:9(change the picture to enable button)</b>';
                                                        document.getElementById('massage').classList.add('text-danger');
                                                        document.getElementById('submitForm').disabled = true;
                                                    } 
                                                })" 
                                                id="image"  name="image_url" type="file" class="custom-file-input" >
                                                <label class="custom-file-label" for="image_url">Upload Image...</label>
                                            </div>
                                        </div>
                                        <div class="help-block">
                                            <small class="text-info"> Shortcut icon should be in 16:9 aspect ratio</small><br>
                                        </div>
                                        <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                        <small id="massage"></small>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" id="submitForm" class="btn btn-success round px-2">
                                        <i class="la la-check-square-o"></i> Submit
                                    </button>
                                </div>
                                </form>
                            
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection




@push('style')
   
@endpush
@push('page-js')

@endpush