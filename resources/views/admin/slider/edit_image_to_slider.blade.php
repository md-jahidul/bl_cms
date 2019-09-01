@extends('layouts.admin')
@section('title', 'questions List')
@section('card_name', 'Question List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Edit Slider Image</li>
@endsection

{{-- @section('content_header')
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
@endsection --}}

@section('content')


    <section id="collapsible">
          <div class="row">
            <div class="col-12">
              <h3 class="text-uppercase"></h3>
            </div>
          </div>
          
          <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12">
             
              <div class="card collapse-icon accordion-icon-rotate mb-0" style=" box-shadow: 0px 0px;">
                @foreach ($slider->sliderImages as $image)
                    <div id="headingCollapse{{$image->id}}" class="card-header">
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
                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="About Project">{{$image->description}}</textarea>
                                        </div>
                                        
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="sequence">Sequence:</label>
                                                <input value="{{$image->sequence}}" id="sequence" type="number" class="form-control" name="sequence">
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
                @endforeach
              </div>
            </div>
            
          </div>
          
    </section>
    <!-- Collapse end -->
     <section id="form-control-repeater" >
        <div class="card card-info mb-0" style=" box-shadow: 0px 0px;">
            <div id="headingCollapse2" class="card-header" >
                <a role="button" style="width:100%" data-toggle="collapse" href="#collapse2" id="show_form" aria-expanded="false" aria-controls="collapse2" class="card-title lead collapsed btn btn-info btn-sm">
                    <i class="la la-plus"></i> Add Image
                </a>
            </div>
            <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" id="show_form_extra" class="collapse @if (!$errors->isEmpty()|| isset($single_slider)) show @endif" aria-expanded="false">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form row" action="{{route('sliderImage.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            
                            <div class="form-group col-12 mb-2 file-repeater">
                            
                                <div data-repeater-list="repeater-list">
                                    
                                    {{-- image add --}}
                                    
                                    <div data-repeater-item>
                                        <input type="hidden" hidden value="{{$slider->id}}" name="slider_id">
                                        <div class="row mb-1">
                                            <div class="form-group col-md-6 mb-2">
                                                <label for="title">Title: <small class="text-danger">*</small> </label>
                                                <small class="text-danger"> @error('repeater-list.*.title') {{ $message }} @enderror </small>
                                                <input required id="title" type="text" class="form-control @error('repeater-list.*.title') is-invalid @enderror" placeholder="Title" name="title">
                                            </div>
                                            <div class="form-group col-md-6 mb-2">
                                                <label for="alt_text">Alt Text: </label>
                                                <input id="alt_text" type="text" class="form-control" placeholder="Alt text" name="alt_text">
                                            </div>
                                            <div class="form-group col-md-6 mb-2">
                                                <label for="btn">Button: </label>
                                                <input id="btn" type="text" class="form-control" placeholder="Button Name" name="url_btn_label">
                                            </div>
                                            <div class="form-group col-md-6 mb-2">
                                                <label for="url">URL: </label>
                                                <input id="url" type="text" class="form-control" placeholder="http.." name="url">
                                            </div>
                                        
                                            <div class="form-group col-12 mb-2">
                                                <label for="description">Description: </label>
                                                <textarea id="description" rows="5" class="form-control" name="description" placeholder="About Project"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label for="sliderImage" class="file center-block">Slider Image:<small class="text-danger">*</small></label><br>
                                                <input required id="sliderImage" type="file" class="mb-1 @error('repeater-list.*.image_url') is-invalid @enderror" name="image_url" id="file">
                                                <small class="text-danger"> @error('repeater-list.*.image_url') {{ $message }} @enderror </small>
                                                <span class="file-custom"></span>
                                            </div>
                                            <div class="col-12">
                                                <button type="button" style="width:20%" data-repeater-delete class="btn btn-icon btn-danger">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- image add --}}

                                </div>
                                <button type="button" data-repeater-create class="btn btn-primary">
                                    <i class="ft-plus"></i> Add Image
                                </button>
                                <button type="submit" class="btn btn-success">
                                    Submit
                                </button>
                            </div>
                            
                        </form>
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