@extends('layouts.admin')
@section('title', 'Near by offer')
@section('card_name', "Near by offer")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Edit Near by offer
    </li>
@endsection

@section('content')
    <section>

        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                   <form novalidate class="form" action="{{route('nearByOffer.update',$nearByOffer->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Edit Near By offer.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required">Title:</label>
                                        <input 
                                        required 
                                        data-validation-required-message="Title is required" 
                                        maxlength="200" 
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9/.])*)*"
                                        data-validation-regex-message="Title must start with alphabets"
                                        data-validation-maxlength-message = "Title can not be more then 200 charecters"
                                        type="text" value="{{$nearByOffer->title}}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
                                        <div class="help-block">
                                            <small class="text-info">
                                                Title can not be more then 200 charecters
                                            </small>
                                        </div>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$nearByOffer->id}}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor" class="required">Vendor:</label>
                                        <input 
                                        required 
                                        data-validation-required-message="Vendor is required" 
                                        maxlength="200" 
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9/.])*)*"
                                        data-validation-regex-message="Vendor must start with alphabets"
                                        data-validation-maxlength-message = "Vendor name can not be more then 200 charecters"
                                        type="text" value="{{$nearByOffer->vendor}}" id="vendor" class="form-control @error('vendor') is-invalid @enderror" placeholder="Enter vendor...." name="vendor">
                                        <div class="help-block">
                                            <small class="text-info">
                                                Vendor name can not be more then 200 charecters
                                            </small>
                                        </div>
                                        @error('vendor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="location" class="required">Location:</label>
                                        <input 
                                        required 
                                        data-validation-required-message="Location is required" 
                                        maxlength="200" 
                                        data-validation-maxlength-message = "Location can not be more then 200 charecters"
                                        type="text" value="{{$nearByOffer->location}}" id="location" class="form-control @error('location') is-invalid @enderror" placeholder="Enter location...." name="location">
                                        <div class="help-block">
                                            <small class="text-info">
                                                Location can not be more then 200 charecters
                                            </small>
                                        </div>
                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type" class="required">Type:</label>
                                        <input 
                                        required 
                                        data-validation-required-message="Type is required" 
                                        maxlength="200" 
                                        data-validation-maxlength-message = "Type can not be more then 200 charecters"
                                        type="text" value="{{$nearByOffer->type}}" id="type" class="form-control @error('type') is-invalid @enderror" placeholder="Enter type...." name="type">
                                        <div class="help-block">
                                            <small class="text-info">
                                                Type can not be more then 200 charecters
                                            </small>
                                        </div>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="offer" class="required">Offer:</label>
                                        <input 
                                        required 
                                        data-validation-required-message="Offer is required" 
                                        maxlength="200" 
                                        data-validation-maxlength-message = "Offer can not be more then 200 charecters"
                                        type="text" value="{{$nearByOffer->offer}}" id="offer" class="form-control @error('offer') is-invalid @enderror" placeholder="Enter offer...." name="offer">
                                        <div class="help-block">
                                            <small class="text-info">
                                                Offer can not be more then 200 charecters
                                            </small>
                                        </div>
                                        @error('offer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="offer_code" class="required">Offer Code:</label>
                                        <input 
                                        required 
                                        data-validation-required-message="Offer Code is required" 
                                        maxlength="200" 
                                        data-validation-maxlength-message = "Offer Code can not be more then 200 charecters"
                                        type="text" value="{{$nearByOffer->offer_code}}" id="offer_code" class="form-control @error('offer_code') is-invalid @enderror" placeholder="Enter offer code...." name="offer_code">
                                        <div class="help-block">
                                            <small class="text-info">
                                                offer code can contain *#
                                            </small>
                                        </div>
                                        @error('offer_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="validity" class="required">Validity:</label>
                                        <input 

                                        required
                                        maxlength="50" 
                                        data-validation-maxlength-message = "Validity can never be more then 50 digits"
                                        data-validation-required-message="Validity is required"
                                        placeholder="Enter validity in day"
                                        type="number" min="0" value="{{$nearByOffer->validity}}" id="validity" class="form-control @error('validity') is-invalid @enderror" placeholder="" name="validity">
                                        <div class="help-block">
                                            <small id="validity" class="form-text text-info">Enter Validation on day.</small>
                                        </div>
                                        @error('validity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-1"> 
                                    <img style="height:100px;width:200px" id="imgDisplay" src="{{asset($nearByOffer->image)}}" alt="" srcset="">
                                    <input type="hidden" value="yes" name="value_exist">
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-file">
                                        <input accept="image/*" name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image">
                                        <label class="custom-file-label @error('image') is-invalid @enderror" for="validatedCustomFile">Upload image...</label>
                                        <div class="help-block">
                                            <small class="text-info">
                                                Image fild is required
                                            </small>
                                        </div>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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