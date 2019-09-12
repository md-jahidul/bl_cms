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
                <h4 class="card-title" id="file-repeater">Project Info</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements">
                
                </div>
            </div>
            
            <div class="card-content collapse show">
                <div class="card-body">
                    <form class="form row" action="{{route('sliderImage.store')}}" enctype="multipart/form-data" method="POST">
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
                                            <input id="alt_text" type="text" class="form-control" placeholder="Alt text" name="alt_text">
                                        </div>
                                        <div class="form-group col-md-6 mb-2">
                                            <label for="btn">Button URL: </label>
                                            <input id="btn" type="text" class="form-control" placeholder="Button Name" name="url_btn_label">
                                        </div>
                                        <div class="form-group col-md-6 mb-2">
                                            <label for="redirect_url">URL: </label>
                                            <input id="redirect_url" type="text" class="form-control" placeholder="http.." name="redirect_url">
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
    </section>

@endsection




@push('style')
   
@endpush
@push('script')
    
@endpush