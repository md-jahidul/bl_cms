@extends('layouts.admin')
@section('title', 'Slider')
@section('card_name', $slider_information->title." Slider")
@section('breadcrumb')
    <li class="breadcrumb-item active">Edit-image</li>
@endsection

@section('content')

    @if($slider->sliderImages->count() == 0)
        <h1>
            No Image Added to "{{$slider_information->title}}" Slider
        </h1>
        @else
        <section id="collapsible">
            <div class="row">
                <div class="col-12">
                <h3 class="text-uppercase"></h3>
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
                                        <form class="form row" action="{{route('sliderImage.update',$image->id)}}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" hidden value="{{$slider->id}}" name="slider_id">
                                        <div class="form-group col-12 mb-2 file-repeater">
                                        
                                            <div class="row mb-1">
                                                <div class="form-group col-md-6 mb-2">
                                                    <label for="title">Title: <small class="text-danger">*</small> </label>
                                                    <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                                    <input value="{{$image->title}}" required id="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title">
                                                </div>
                                                <div class="form-group col-md-6 mb-2">
                                                    <label for="alt_text">Alt Text: </label>
                                                    <input value="{{$image->alt_text}}" id="alt_text" type="text" class="form-control" placeholder="Alt text" name="alt_text">
                                                </div>
                                                <div class="form-group col-md-6 mb-2">
                                                    <label for="btn">Button: </label>
                                                    <input id="btn" type="text" class="form-control" placeholder="Button Name" name="url_btn_label">
                                                </div>
                                                <div class="form-group col-md-6 mb-2">
                                                    <label for="url">URL: </label>
                                                    <input value="{{$image->url}}" id="url" type="text" class="form-control" placeholder="http.." name="url">
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
                                                
                                                <div class="col-12">
                                                    <img style="height:50px;width:100px" class="" src="{{asset($image->image_url)}}" alt="" srcset=""><br>
                                                </div>
                                                <div class="col-12">
                                                    <label for="sliderImage" class="file center-block">Slider Image:<small class="text-danger">*</small></label><br>
                                                    <input id="sliderImage" type="file" class="mb-1 @error('image_url') is-invalid @enderror" name="image_url" id="file">
                                                    <small class="text-danger"> @error('image_url') {{ $message }} @enderror </small>
                                                    <span class="file-custom"></span>
                                                </div>
                                                
                                                <div class="col-2">
                                                    <button type="submit" style="width:100%" class=" btn btn-success">Save Info</button>
                                                </div>
                                            </form>
                                                <div class="col-2 ml-0 pl-0">
                                                    <form action="{{route('sliderImage.destroy',$image->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" style="width:100%" class="btn btn-icon btn-danger">Delete Image</button>
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
                    url:"{{url("sliderImage/addImage/update-position")}}",
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
@endpush