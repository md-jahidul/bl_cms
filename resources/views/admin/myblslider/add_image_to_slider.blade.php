@extends('layouts.admin')
@section('title', 'Add Image')
@section('card_name', $slider_information->title." Slider")
@section('breadcrumb')
    <li class="breadcrumb-item active">Add Image</li>
@endsection

@section('content')
    

    <section id="form-control-repeater">
        <div class="card">
            <div class="card-header">
                <h4 class="form-section"><i class="la la-paperclip"></i>Add Image to "{{$slider_information->title}}" Slider</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements">
                
                </div>
            </div>
            
            <div class="card-content collapse show">
                <div class="card-body">
                    
                    <form novalidate class="form row" action="{{route('myblsliderImage.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('post')
                        
                        <div class="form-group col-12 mb-2 file-repeater">
                        
                            <div data-repeater-list="repeater-list">

                                {{-- image add --}}
                                <div data-repeater-item>
                                    <input type="hidden" hidden value="{{$sliderId}}" name="slider_id">
                                    <div class="row mb-1">
                                        <div class="form-group col-md-6 mb-2">
                                            <label for="title" class="required">Title: </label>
                                            <input 
                                            required
                                            maxlength="200" 
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><])*)*"
                                            data-validation-required-message="Title fild is required" 
                                            data-validation-regex-message="Title must start with alphabets"
                                            data-validation-maxlength-message = "Title canot be more then 200 Characters" 

                                                id="title" 
                                                type="text" 
                                                class="form-control @error('title') is-invalid @enderror" 
                                                placeholder="Title" 
                                                name="title">
                                                <div class="help-block"></div>
                                                
                                            <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
    
                                        </div>
                                        <div class="form-group col-md-6 mb-2">
                                            <label for="alt_text" class="required">Alt Text: </label>
                                            <input 
                                            required
                                            maxlength="200" 
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><])*)*"
                                            data-validation-required-message="Alt Text fild is required" 
                                            data-validation-regex-message="Alt Text must start with alphabets"
                                            data-validation-maxlength-message = "Alt Text canot be more then 200 Characters"  
                                            id="alt_text"
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Alt text" 
                                            name="alt_text">
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="form-group col-md-6 mb-2">
                                            <label for="btn">Button URL: </label>
                                            <input id="btn" 
                                            data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*"
                                            data-validation-regex-message="Button URL must be a valid link"
                                            type="url" 
                                            class="form-control" 
                                            placeholder="Button url.." 
                                            name="url_btn_label">
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="form-group col-md-6 mb-2">
                                            <label for="redirect_url">URL: </label>
                                            <input
                                            data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*"
                                            data-validation-regex-message="URL must be a valid link"
                                            id="redirect_url" type="url" class="form-control" placeholder="http.." name="redirect_url">
                                            <div class="help-block"></div>
                                        </div>
                                       
                                        <div class="form-group col-12 mb-2">
                                            <label for="description">Description: </label>
                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="About Slider.."></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <img style="height:100px;width:200px;diplay:none" id="imgDisplay" src="" alt="" srcset="">
                                        </div>
                                        <div class="col-md-12">
                                                                
                                                <div class="form-group">
                                                    <label for="image">Upload Image :</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                        <input 
                                                        accept="image/*" 
                                                        required
                                                        data-validation-required-message="Alt Text fild is required" 
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
                                                        id="image"  
                                                        name="image_url" 
                                                        type="file" 
                                                        class="custom-file-input" 
                                                        id="icon">
                                                        <label class="custom-file-label" for="icon">Upload Image...</label>
                                                    </div>
                                                </div>
                                                <div class="help-block">
                                                    <small class="text-info"> Shortcut icon should be in 16:9 aspect ratio</small><br>
                                                </div>
                                                <small id="massage"></small>
                                                <small class="text-danger"> @error('image_url') {{ $message }} @enderror </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- image add --}}

                            </div>
                            <button type="submit" id="submitForm" class="btn btn-success">
                                Submit
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection




@push('style')
   
@endpush
@push('page-js')

@endpush