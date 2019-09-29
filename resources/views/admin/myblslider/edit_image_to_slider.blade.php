@extends('layouts.admin')
@section('title', 'Slider')
@section('card_name', $slider_information->title." Slider")
@section('breadcrumb')
    <li class="breadcrumb-item active">Edit-image</li>
@endsection

@section('content')

    <section id="form-control-repeater">

       

        
        
    </section>

    @if($slider->sliderImages->count() == 0)
        <h1>
            No Image Added to "{{$slider_information->title}}" Slider
        </h1>
        @else
        <section id="collapsible">
            <div class="row">
                <div class="col-12">
                <h3 class="text-uppercase">
                    <small class="text-success"><b>Drag the list to change the sequence</b></small>
                </h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12">
                
                    <div id="list" class="card collapse-icon accordion-icon-rotate mb-0 sortable" style=" box-shadow: 0px 0px;">
                        
                        @foreach ($slider->sliderImages as $image)
                            
                            <div data-position = "{{$image->sequence}}" data-index="{{$image->id}}" class="list-item">
                                    <div style="cursor:all-scroll" id="headingCollapse{{$image->id}}" class="card-header">
                                        <i class="icon-cursor-move icons"></i>
                                        <a data-toggle="collapse" href="#collapse11{{$image->id}}" aria-expanded="false" aria-controls="collapse11{{$image->id}}" class="card-title">
                                            <img style="height:50px;width:100px" class="" src="{{asset($image->image_url)}}" alt="" srcset=""><br>
                                        </a>
                                    </div>
                                    <div id="collapse11{{$image->id}}" role="tabpanel" aria-expanded="false" aria-labelledby="headingCollapse{{$image->id}}" class="collapse">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form novalidate class="form row" action="{{route('myblsliderImage.update',$image->id)}}" enctype="multipart/form-data" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" hidden value="{{$slider_information->id}}" name="slider_id">
                                                <div class="form-group col-12 mb-2 file-repeater">
                                                
                                                    <div class="row mb-1">
                                                        <div class="form-group col-md-6 mb-2">
                                                            <label for="title">Title: <small class="text-danger">*</small> </label>
                                                            <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                                            <input 
                                                            required
                                                            maxlength="200" 
                                                            data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><])*)*"
                                                            data-validation-required-message="Title fild is required" 
                                                            data-validation-regex-message="Title must start with alphabets"
                                                            data-validation-maxlength-message = "Title canot be more then 200 Characters" 
                                                            value="{{$image->title}}" required id="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title">
                                                            <div class="help-block"></div>
                                                        </div>
                                                        <div class="form-group col-md-6 mb-2">
                                                            <label for="alt_text">Alt Text: </label>
                                                            <input 
                                                            required
                                                            maxlength="200" 
                                                            data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><])*)*"
                                                            data-validation-required-message="Alt Text fild is required" 
                                                            data-validation-regex-message="Alt Text must start with alphabets"
                                                            data-validation-maxlength-message = "Alt Text canot be more then 200 Characters"
                                                            value="{{$image->alt_text}}" id="alt_text" type="text" class="form-control" placeholder="Alt text" name="alt_text">
                                                            <div class="help-block"></div>
                                                        </div>
                                                        <div class="form-group col-md-6 mb-2">
                                                            <label for="btn">Button URL: </label>
                                                            <input id="btn" 
                                                            data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*"
                                                            data-validation-regex-message="Button URL must be a valid link"
                                                            value="{{$image->url_btn_label}}"
                                                            type="url" class="form-control" placeholder="Button Name" name="url_btn_label">
                                                            <div class="help-block"></div>
                                                        </div>
                                                        <div class="form-group col-md-6 mb-2">
                                                            <label for="url">URL: </label>
                                                            <input 
                                                            data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*"
                                                            data-validation-regex-message="URL must be a valid link"
                                                            value="{{$image->redirect_url}}" id="url" type="url" class="form-control" placeholder="http.." name="url">
                                                            <div class="help-block"></div>
                                                        </div>
                                                    
                                                        <div class="form-group col-12 mb-2">
                                                            <label for="description">Description: </label>
                                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="About Slider..">{{$image->description}}</textarea>
                                                        </div>
                                                        
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="sequence">Sequence:</label>
                                                                <input disabled value="{{$image->sequence}}" id="sequence" type="number" class="form-control " name="sequence">
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="is_active">Active Status:</label>
                                                                <select value="{{$image->is_active}}" class="form-control" id="is_active" name="is_active">
                                                                    <option value="1" @if($image->is_active == "1") selected @endif>Active</option>
                                                                    <option value="0" @if($image->is_active == "0") selected @endif>De-Active</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12 mb-1"> 
                                                            <img style="height:100px;width:200px" id="imgDisplay" src="{{asset($image->image_url)}}" alt="" srcset="">
                                                        </div>
                                                        <div class="col-md-12">
                                                                
                                                                <div class="form-group">
                                                                    <label for="image">Upload Image :</label>
                                                                    <div class="input-group">
                                                                        <div class="custom-file">
                                                                        <input accept="image/*" 
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
                                                                        id="image"  name="image_url" type="file" class="custom-file-input" id="image_url">
                                                                        <label class="custom-file-label" for="image_url">Upload Image...</label>
                                                                    </div>
                                                                </div>
                                                                <small class="text-info"> Shortcut icon should be in 16:9 aspect ratio</small><br>
                                                                <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                                                <small id="massage"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <button type="submit" style="width:100%" id="submitForm" class=" btn btn-success">Save Info</button>
                                                        </div>
                                                        </form>
                                                        <div class="col-2">
                                                            <form action="{{route('myblsliderImage.destroy',$image->id)}}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" style="width:100%"  class="btn btn-icon btn-danger">Delete Image</button>
                                                            </form>
                                                        </div>
                                                    
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                            </div>

                        @endforeach
                    </div>
                </div>
                
            </div>
            
        </section>
    @endif
    
@endsection




@push('style')
    
@endpush
@push('page-js')
    
    <script>
        $(document).ready( function() {
            $( "#list" ).sortable({
                update:function(event,ui){
                   $(this).children().each(function(index){
                       if($(this).attr('data-position')!=(index+1)){
                        $(this).attr('data-position',index+1).addClass('update');
                        console.log(index)
                       }
                   });
                   saveNewPosition();
                }
            });

           function saveNewPosition(){
               var position = [];
               $('.update').each(
                   function(){
                        position.push([$(this).attr('data-index'),$(this).attr('data-position')]);
                        //$this.removeClass('update');
                })
               console.log(position)

                $.ajax({
                    url:"{{url('myblsliderImage/addImage/update-position')}}",
                    methoder:'get',
                    dataType:'text',
                    data:{
                        update:1,
                        positions:position
                    },
                    success:function (data){
                        console.log(data)
                    }
                })
           }
           
        } );
         
    </script>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            var msg = document.getElementById('msg');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.style.display = "block"
            createImageBitmap(event.target.files[0]).then((bmp) => { 
                    if(bmp.width/bmp.height == 16/9){
                        console.log('yes');
                        msg.innerHTML = ""
                        document.getElementById("addImagesubmit").disabled = false;
                        }else{ 
                        console.log('no');
                        msg.innerHTML = "<b> Image aspect ratio must be in 16:9(change the image to enable the submit button) </b>";
                        document.getElementById("addImagesubmit").disabled = true;

                } } );
        };
    </script>
@endpush