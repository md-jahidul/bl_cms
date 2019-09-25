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
                    
                    <form class="form row" action="{{route('myblsliderImage.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('post')
                        
                        <div class="form-group col-12 mb-2 file-repeater">
                        
                            <div data-repeater-list="repeater-list">

                                {{-- image add --}}
                                <div data-repeater-item>
                                    <input type="hidden" hidden value="{{$sliderId}}" name="slider_id">
                                    <div class="row mb-1">
                                        <div class="form-group col-md-6 mb-2">
                                            <label for="title">Title: <small class="text-danger">*</small> </label>
                                            <small class="text-danger"> @error('repeater-list.*.title') {{ $message }} @enderror </small>
                                            <input required id="title" type="text" class="form-control @error('repeater-list.*.title') is-invalid @enderror" placeholder="Title" name="title">
                                        </div>
                                        <div class="form-group col-md-6 mb-2">
                                            <label for="alt_text">Alt Text: </label>
                                            <input id="alt_text" required type="text" class="form-control" placeholder="Alt text" name="alt_text">
                                        </div>
                                        <div class="form-group col-md-6 mb-2">
                                            <label for="btn">Button URL: </label>
                                            <input id="btn" type="url" class="form-control" placeholder="Button url.." name="url_btn_label">
                                        </div>
                                        <div class="form-group col-md-6 mb-2">
                                            <label for="redirect_url">URL: </label>
                                            <input id="redirect_url" type="url" class="form-control" placeholder="http.." name="redirect_url">
                                        </div>
                                       
                                        <div class="form-group col-12 mb-2">
                                            <label for="description">Description: </label>
                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="About Slider.."></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label for="sliderImage" class="file center-block">Slider Image:<small class="text-danger">*</small></label><br>
                                            <input accept="image/*" onchange="
                                                    createImageBitmap(this.files[0]).then((bmp) => {
                                                        
                                                        //console.log(this.files[0].name.split('.').pop())
                                                        if(bmp.width/bmp.height == 16/9){
                                                            console.log('yes')
                                                            document.getElementById('addMore').disabled = false;
                                                            document.getElementById('submitForm').disabled = false;
                                                            this.style.border = 'none';
                                                            this.nextElementSibling.innerHTML = '';
                                                        }else{ 
                                                            console.log('no')
                                                            this.style.border = '1px solid red';
                                                            this.nextElementSibling.innerHTML = '<br><b>image aspact ratio must 16:9(change the picture to enable button)</b>';
                                                            document.getElementById('addMore').disabled = true;
                                                            document.getElementById('submitForm').disabled = true;
                                                        } 
                                                    })" 

                                                    required id="sliderImage" 
                                                    type="file" 
                                                    class="@error('repeater-list.*.image_url') is-invalid @enderror" 
                                                    name="image_url"
                                                    style="margin-bottom:10px" 
                                                    id="file">

                                                    <small class="text-danger"> @error('repeater-list.*.image_url') {{ $message }} @enderror </small>
                                                    <span class="file-custom"></span>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" style="width:11%" data-repeater-delete class="btn btn-icon btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- image add --}}

                            </div>
                            <button type="button" id="addMore" data-repeater-create class="btn btn-primary">
                                <i class="ft-plus"></i> Add Image
                            </button>
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
@push('script')
    
@endpush