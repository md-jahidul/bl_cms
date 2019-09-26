@extends('layouts.admin')
@section('title', 'Help Center')
@section('card_name', "Help Center")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Create Help Center
    </li>
@endsection

@section('content')
    <section>

        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" action="{{route('helpCenter.store')}}" enctype="multipart/form-data" method="POST" novalidate>
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create Help Center.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('title') ? ' error' : '' }}">
                                        <label for="title">Title:<small class="text-danger">*</small></label>
                                        <input
                                        required 
                                        data-validation-required-message="title is required" 
                                        maxlength="200" 
                                        value="{{ old("title") ? old("title") : '' }}" 
                                        type="text" value="" id="title" 
                                        class="form-control @error('title') is-invalid @enderror" 
                                        placeholder="Enter title...." 
                                        name="title">
                                        <small class="text-info">
                                            Title length can never be more then 200
                                        </small>
                                        <div class="help-block"></div>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sequence">Sequence:<small class="text-danger">*</small></label>
                                        <input maxlength="50000"
                                         type="number"
                                         data-validation-required-message="sequence is required" 
                                         value="{{ old("sequence") ? old("sequence") : '' }}" 
                                         value="" id="sequence" 
                                         class="form-control @error('sequence') is-invalid @enderror" 
                                         placeholder="sequence.." 
                                         name="sequence"
                                         >
                                        <small class="text-info">
                                            Sequence can never be more then 50000
                                        </small>
                                        <div class="help-block"></div>
                                        @error('sequence')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="redirect_link">Redirect link:<small class="text-danger">*</small></label>
                                        <input 
                                        required type="url" 
                                        value="{{ old("redirect_link") ? old("redirect_link") : '' }}" 
                                        value="" id="redirect_link" 
                                        class="form-control @error('redirect_link') is-invalid @enderror" 
                                        placeholder="Http.." 
                                        name="redirect_link"
                                        >
                                        <small id="redirect_link" class="form-text text-info">Enter Link here.</small>
                                        <div class="help-block"></div>
                                        @error('redirect_link')
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
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input accept="image/*" 
                                                onchange="createImageBitmap(this.files[0]).then((bmp) => {
                                                        
                                                        if(bmp.width/bmp.height == 1/1){
                                                            console.log('yes')
                                                            document.getElementById('submitForm').disabled = false;
                                                            document.getElementById('massage').innerHTML = '';
                                                            this.style.border = 'none';
                                                            this.nextElementSibling.innerHTML = '';
                                                        }else{ 
                                                            console.log('no')
                                                            this.style.border = '1px solid red';
                                                            document.getElementById('massage').innerHTML = '<b>image aspact ratio must 1:1(change the picture to enable button)</b>';
                                                            document.getElementById('massage').classList.add('text-danger');
                                                            document.getElementById('submitForm').disabled = true;
                                                        } 
                                                    })" 
                                                
                                                value="{{ old("icon") ? old("icon") : '' }}" 
                                                required
                                                data-validation-required-message="image is required" 
                                                name="icon" 
                                                id="image" 
                                                type="file" 
                                                class="custom-file-input @error('icon') is-invalid @enderror" 
                                                id="icon">
                                                <label class="custom-file-label" for="icon">Upload icon...</label>
                                            </div>
                                            
                                        </div>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                        <small class="text-info" id="massage">
                                            Image aspect ratio should be 1:1
                                        </small>
                                    </div>
                                </div>
                                
                        </div>
                        <div class="form-actions">
                            <button id="submitForm" type="submit" class="btn btn-success round px-2">
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