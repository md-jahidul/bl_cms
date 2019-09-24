@extends('layouts.admin')
@section('title', 'Contextual Card')
@section('card_name', "Contextual Card")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Create Contextual Card
    </li>
@endsection

@section('content')
    <section>

        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" action="{{route('contextualcard.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create Contextual Card.</h4>
                            
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title:<small class="text-danger">*</small></label>
                                        <input value="{{ old("title") ? old("title") : '' }}" type="text" value="" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description:<small class="text-danger">*</small></label>
                                        <textarea class="form-control" name="description" placeholder="Enter description..." id="description" rows="8">{{ old("description") ? old("description") : '' }}</textarea>
                                        <small id="description" class="form-text text-muted">Enter description...</small>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> 

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_action_text">First Action Text:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{ old("first_action_text") ? old("first_action_text") : '' }}" value="" id="first_action_text" class="form-control @error('first_action_text') is-invalid @enderror" placeholder="first action text.." name="first_action_text">
                                        
                                        @error('first_action_text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="second_action_text">Second Action Text:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{ old("second_action_text") ? old("second_action_text") : '' }}" value="" id="second_action_text" class="form-control @error('second_action_text') is-invalid @enderror" placeholder="second action text.." name="second_action_text">
                                        
                                        @error('second_action_text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_action">First Action:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{ old("first_action") ? old("first_action") : '' }}" value="" id="first_action" class="form-control @error('first_action') is-invalid @enderror" placeholder="first action.." name="first_action">
                                        @error('first_action')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="second_action">Second Action:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{ old("second_action") ? old("second_action") : '' }}" value="" id="second_action" class="form-control @error('second_action') is-invalid @enderror" placeholder="second action.." name="second_action">
                                        @error('second_action')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-1"> 
                                    <img style="height:100px;width:200px;display:none" id="imgDisplay" src="" alt="" srcset="">
                                    <input type="hidden" value="no" name="value_exist">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">Upload contextual Card Image:<small class="text-danger">*</small></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input accept="image/*" value="{{ old("image_url") ? old("image_url") : '' }}" name="image_url" id="image" type="file" class="custom-file-input @error('image_url') is-invalid @enderror" id="image_url">
                                                <label class="custom-file-label" for="image_url">Upload image...</label>
                                            </div>
                                        </div>
                                        <small class="text-danger"> @error('image_url') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success round px-2">
                            <i class="la la-check-square-o"></i> Save
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