@extends('layouts.admin')
@section('title', 'SMS offer')
@section('card_name', "SMS offer")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Create SMS offer
    </li>
@endsection

@section('content')
    <section>

        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" action="{{route('smsOffer.store')}}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create SMS offer.</h4>
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
                                        data-validation-maxlength-message = "Title canot be more then 200 charecters" 
                                        type="text" value="@if(old('title')){{old('title')}}@endif" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
                                        <div class="help-block">
                                            <small class="text-info">Title canot be more then 200 charecters</small>
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
                                        <label for="volume" class="required">Volume:</label>
                                        <input 
                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "Volume can never be more then 50000 digits"
                                        data-validation-required-message="Volume is required" 
                                        type="number" min="0" value="@if(old('volume')){{old('volume')}}@endif" id="volume" class="form-control @error('volume') is-invalid @enderror" placeholder="Enter volume...." name="volume">
                                        <div class="help-block">
                                            <small id="volume" class="form-text text-info">Enter volue in Number of SMS.</small>
                                        </div>
                                        @error('volume')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price" class="required">Price:</label>
                                        <input 
                                        required
                                        maxlength="50" 
                                        data-validation-maxlength-message = "Price can never be more then 50 digits"
                                        data-validation-required-message="Price is required"  
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

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="offer_code" class="required">Offer Code:</label>
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="points" class="required">Points:</label>
                                        <input 
                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "Points can never be more then 50000 digits"
                                        data-validation-required-message="Points is required"
                                        type="number" min="0" value="@if(old('points')){{old('points')}}@endif" id="points" class="form-control @error('points') is-invalid @enderror" placeholder="Points.." name="points">
                                        <div class="help-block"></div>
                                        @error('points')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validity" class="required">Validity:</label>
                                        <input 
                                        required
                                        maxlength="5" 
                                        data-validation-maxlength-message = "Validity can never be more then 5 digits"
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