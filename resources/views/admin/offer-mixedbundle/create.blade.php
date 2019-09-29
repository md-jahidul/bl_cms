@extends('layouts.admin')
@section('title', 'Mixed Bundle offer')
@section('card_name', "Mixed Bundle offer")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Create Mixed Bundle offer
    </li>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                   <form novalidate class="form" action="{{route('mixedBundleOffer.store')}}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create SMS offer.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title:<small class="text-danger">*</small></label>
                                        <input 

                                        required 
                                        data-validation-required-message="Title is required" 
                                        maxlength="200" 
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9/.])*)*"
                                        data-validation-regex-message="Title must start with alphabets"
                                        data-validation-maxlength-message = "Title can not be more then 200 charecters"

                                        type="text" value="@if(old('title')){{old('title')}}@endif" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
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
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="internet">Internet:<small class="text-danger">*</small></label>
                                        <input 

                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "Internet Volume can never be more then 50000 digits"
                                        data-validation-required-message="Internet Volume is required"

                                        type="number" min="0" value="@if(old('internet')){{old('internet')}}@endif" id="internet" class="form-control @error('internet') is-invalid @enderror" placeholder="Enter volume...." name="internet">
                                        <small id="internet" class="form-text text-info">Enter volume in MB.</small>
                                        @error('internet')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="minutes">Minutes:<small class="text-danger">*</small></label>
                                        <input

                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "Minutes Volume can never be more then 50000 digits"
                                        data-validation-required-message="Minutes Volume is required"

                                        type="number" min="0" value="@if(old('minutes')){{old('minutes')}}@endif" id="minutes" class="form-control @error('minutes') is-invalid @enderror" placeholder="Enter volume...." name="minutes">
                                        <small id="minutes" class="form-text text-info">Enter volume in minutes.</small>
                                        <div class="help-block"></div>
                                        @error('minutes')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sms">SMS:<small class="text-danger">*</small></label>
                                        <input 
                                        
                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "SMS Volume can never be more then 50000 digits"
                                        data-validation-required-message="SMS Volume is required"

                                        type="number" min="0" value="@if(old('sms')){{old('sms')}}@endif" id="sms" class="form-control @error('sms') is-invalid @enderror" placeholder="Enter volume...." name="sms">
                                        <small id="sms" class="form-text text-info">Enter volume in amount of sms.</small>
                                        <div class="help-block"></div>
                                        @error('sms')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price">Price:<small class="text-danger">*</small></label>
                                        <input 

                                        required
                                        maxlength="50" 
                                        data-validation-maxlength-message = "Price can never be more then 50 digits"
                                        data-validation-required-message="Price fild is required"

                                        type="number" min="0" value="@if(old('price')){{old('price')}}@endif" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price.." name="price">
                                        <div class="help-block">
                                            <small id="price" class="form-text text-info">Enter price in BDT.</small>
                                        </div>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="points">Points:<small class="text-danger">*</small></label>
                                        <input 

                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "Points can never be more then 50000 digits"
                                        data-validation-required-message="Points fild is required"

                                        type="number" min="0" value="@if(old('points')){{old('points')}}@endif" id="points" class="form-control @error('points') is-invalid @enderror" placeholder="Points.." name="points">
                                        <div class="help-block"></div>
                                        @error('points')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="offer_code">Offer Code:<small class="text-danger">*</small></label>
                                        <input 

                                        required 
                                        data-validation-required-message="Offer Code is required" 
                                        maxlength="200" 
                                        data-validation-maxlength-message = "Offer Code canot be more then 200 charecters"

                                        type="text" value="@if(old('offer_code')){{old('offer_code')}}@endif" id="offer_code" class="form-control @error('offer_code') is-invalid @enderror" placeholder="Offer code.." name="offer_code">
                                        <div class="help-block">
                                            <small id="validity" class="form-text text-info">Offer Code must have *,# and number in it.</small>
                                        </div>
                                        @error('offer_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tag">Tag:<small class="text-danger">*</small></label>
                                        <input
                                        required 
                                        data-validation-required-message="Tag is required" 
                                        maxlength="200" 
                                        data-validation-maxlength-message = "Tag can not be more then 200 charecters"

                                        type="text" value="@if(old('tag')){{old('tag')}}@endif" id="tag" class="form-control @error('tag') is-invalid @enderror" placeholder="Offer code.." name="tag">
                                        <div class="help-block"></div>
                                        @error('tag')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="validity">Validity:<small class="text-danger">*</small></label>
                                        <input 

                                        required
                                        maxlength="50" 
                                        data-validation-maxlength-message = "Validity can never be more then 50 digits"
                                        data-validation-required-message="Validity is required"

                                        type="number" min="0" value="@if(old('validity')){{old('validity')}}@endif" id="validity" class="form-control @error('validity') is-invalid @enderror" placeholder="" name="validity">
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