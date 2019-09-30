@extends('layouts.admin')
@section('title', 'Contextual Card')
@section('card_name', "Contextual Card")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Edit Contextual Card
    </li>
@endsection

@section('content')
    <section>

        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" action="{{route('contextualcard.update',$contextualCard->id)}}" enctype="multipart/form-data" method="POST" novalidate>
                        @csrf
                        @method('put')
                        <input type="hidden" value="yes" name="value_exist">
                        <input type="hidden" value="{{$contextualCard->id}}" name="id">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Edit Contextual Card.</h4>
                            
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('title') ? ' error' : '' }}">
                                        <label for="title" class="required">Title:</label>
                                        <input required value="{{ old("title") ? old("title") : $contextualCard->title }}" 
                                            required
                                            maxlength="200" 
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><-])*)*"
                                            data-validation-required-message="Title is required" 
                                            data-validation-regex-message="Title must start with alphabets"
                                            data-validation-maxlength-message = "Title can not be more then 200 Characters"
                                            type="text"
                                            id="title" class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Enter title...." 
                                            name="title">

                                        <div class="help-block">
                                            <small class="text-info">
                                                Title can not be more then 200 Characters
                                            </small>
                                        </div>
                                        @if ($errors->has('title'))
                                            <div class="help-block">  {{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('description') ? ' error' : '' }}">
                                        <label for="description" class="required">Description:</label>
                                        <textarea 
                                        required
                                        data-validation-required-message="Description is required"  class="form-control" name="description" placeholder="Enter description..." id="description" rows="8">{{ old("description") ? old("description") : $contextualCard->description }}</textarea>
                                        <small id="description" class="form-text text-muted">Enter description...</small>
                                        <div class="help-block"></div>
                                        @error('description')
                                            <span class="help-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> 

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('first_action_text') ? ' error' : '' }}">
                                        <label for="first_action_text" class="required">First Action Text:</label>
                                        <input
                                        required
                                        maxlength="200" 
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><-])*)*"
                                        data-validation-required-message="First Action Text is required" 
                                        data-validation-regex-message="First Action Text must start with alphabets"
                                        data-validation-maxlength-message = "First Action Text can not be more then 200 Characters" 
                                        
                                        type="text" value="{{ old("first_action_text") ? old("first_action_text") : $contextualCard->first_action_text }}" value="" id="first_action_text" class="form-control @error('first_action_text') is-invalid @enderror" placeholder="first action text.." name="first_action_text">
                                        <div class="help-block">
                                            <small class="text-info">
                                                First Action Text can not be more then 200 Characters
                                            </small>
                                        </div>
                                        @error('first_action_text')
                                            <span class="help-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('second_action_text') ? ' error' : '' }}">
                                        <label for="second_action_text" class="required">Second Action Text:</label>
                                        <input 
                                        required
                                        maxlength="200" 
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><-])*)*"
                                        data-validation-required-message="Second Action Text is required" 
                                        data-validation-regex-message="Second Action Text must start with alphabets"
                                        data-validation-maxlength-message = "Second Action Text can not be more then 200 Characters"  
                                        type="text" value="{{ old("second_action_text") ? old("second_action_text") : $contextualCard->second_action_text }}" value="" id="second_action_text" class="form-control @error('second_action_text') is-invalid @enderror" placeholder="second action text.." name="second_action_text">
                                        <div class="help-block">
                                            <small class="text-info">
                                                Second Action Text can not be more then 200 Characters
                                            </small>
                                        </div>
                                        @error('second_action_text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('first_action') ? ' error' : '' }}">
                                        <label for="first_action" class="required">First Action:</label>
                                        <input 
                                        required
                                        maxlength="200" 
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><-])*)*"
                                        data-validation-required-message="First Action is required" 
                                        data-validation-regex-message="First Action must start with alphabets"
                                        data-validation-maxlength-message = "First Action can not be more then 200 Characters"   
                                        type="text" value="{{ old("first_action") ? old("first_action") : $contextualCard->first_action }}" value="" id="first_action" class="form-control @error('first_action') is-invalid @enderror" placeholder="first action.." name="first_action">
                                        <div class="help-block">
                                            <small class="text-info">
                                                First Action can not be more then 200 Characters
                                            </small>
                                        </div>
                                        @error('first_action')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('second_action') ? ' error' : '' }}">
                                        <label for="second_action" class="required">Second Action:</label>
                                        <input
                                        required
                                        maxlength="200" 
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><-])*)*"
                                        data-validation-required-message="Second Action is required" 
                                        data-validation-regex-message="Second Action must start with alphabets"
                                        data-validation-maxlength-message = "Second Action can not be more then 200 Characters"
                                        type="text" value="{{ old("second_action") ? old("second_action") : $contextualCard->second_action }}" value="" id="second_action" class="form-control @error('second_action') is-invalid @enderror" placeholder="second action.." name="second_action">
                                        <div class="help-block">
                                            <small class="text-info">
                                                Title can not be more then 200 Characters
                                            </small>
                                        </div>
                                        @error('second_action')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-1"> 
                                    <img style="height:100px;width:200px" id="imgDisplay" src="{{asset($contextualCard->image_url)}}" alt="" srcset="">
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="image" >Upload contextual Card Image:</label>
                                        <div class="input-group ">
                                            <div class="custom-file">
                                                <input accept="image/*"
                                                onchange="
                                                    createImageBitmap(this.files[0]).then((bmp) => {
                                                        
                                                        //console.log(this.files[0].name.split('.').pop())
                                                        if(bmp.width/bmp.height == 1/1){
                                                            console.log('yes')
                                                            // document.getElementById('addMore').disabled = false;
                                                            document.getElementById('submitForm').disabled = false;
                                                            this.style.border = 'none';
                                                            document.getElementById('massage').innerHTML = '';
                                                        }else{ 
                                                            console.log('no')
                                                            this.style.border = '1px solid red';
                                                            document.getElementById('massage').classList.add('text-danger');
                                                            document.getElementById('massage').innerHTML = '<b>Card Image aspact ratio must be in 1:1(change the picture to enable button)</b>';
                                                            // document.getElementById('addMore').disabled = true;
                                                            document.getElementById('submitForm').disabled = true;
                                                        } 
                                                    })" 
                                                
                                                
                                                value="{{ old("image_url") ? old("image_url") : '' }}" name="image_url" id="image" type="file" class="custom-file-input @error('image_url') is-invalid @enderror" id="image_url">
                                                <label class="custom-file-label" for="image_url">Upload image...</label>
                                            </div>
                                        </div>
                                        <div class="help-block">
                                            <small class="text-info">
                                                Card Image aspact ratio must be in 1:1
                                            </small>
                                        </div>
                                        <div id="massage"></div>
                                        <small class="text-danger"> @error('image_url') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                
                        </div>
                        <div class="form-actions">
                            <button id="submitForm" type="submit" class="btn btn-success round px-2">
                            <i class="la la-check-square-o"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        
    </section>
@endsection


@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush


@push('style')
    
@endpush
@push('page-js')
    <script>
        
        
    </script>
@endpush