@extends('layouts.admin')
@section('title', 'Internet Offer')
@section('card_name', "Internet Offer")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Edit Internet Offer
    </li>
@endsection

@section('content')
    <section>

        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form novalidate class="form" action="{{route('internetOffer.update',$internet_offer->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Edit Internet offer.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title:<small class="text-danger">*</small></label>
                                        <input 
                                        required 
                                        data-validation-required-message="title is required" 
                                        maxlength="200" 
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9/.])*)*"
                                        data-validation-regex-message="Title must start with alphabets"
                                        data-validation-maxlength-message = "Title canot be more then 200 charecters"
                                        type="text" value="{{$internet_offer->title}}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
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
                                <input type="hidden" name="id" value="{{$internet_offer->id}}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="volume">Volume:<small class="text-danger">*</small></label>
                                        <input 
                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "Volume can never be more then 50000 digits"
                                        data-validation-required-message="Volume is required" 
 
                                        type="number" min="0" value="{{$internet_offer->volume}}" id="volume" class="form-control @error('volume') is-invalid @enderror" placeholder="Enter volume...." name="volume">
                                        <div class="help-block">
                                            <small id="volume" class="form-text text-info">Enter volue in MB.</small>
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
                                        <label for="price">Price:<small class="text-danger">*</small></label>
                                        <input 
                                        
                                        required
                                        maxlength="50" 
                                        data-validation-maxlength-message = "Price can never be more then 50 digits"
                                        data-validation-required-message="Price is required"

                                        type="number" min="0" value="{{$internet_offer->price}}" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price.." name="price">
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
                                        <label for="offer_code">Offer Code:<small class="text-danger">*</small></label>
                                        <input 
                                        
                                        required 
                                        data-validation-required-message="Offer Code is required" 
                                        maxlength="200" 
                                        data-validation-maxlength-message = "Offer Code canot be more then 200 charecters"

                                        type="text" value="{{$internet_offer->offer_code}}" id="offer_code" class="form-control @error('offer_code') is-invalid @enderror" placeholder="Offer code.." name="offer_code">
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
                                        <label for="points">Points:<small class="text-danger">*</small></label>
                                        <input 
                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "Points can never be more then 50000 digits"
                                        data-validation-required-message="Points is required" 
                                        type="number" min="0" value="{{$internet_offer->points}}" id="points" class="form-control @error('points') is-invalid @enderror" placeholder="Points.." name="points">
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
                                        <label for="validity">Validity:<small class="text-danger">*</small></label>
                                        <input 
                                        required
                                        maxlength="5" 
                                        data-validation-maxlength-message = "Validity can never be more then 5 digits"
                                        data-validation-required-message="Validity is required" 
                                        type="number" min="0" value="{{$internet_offer->validity}}" id="validity" class="form-control @error('validity') is-invalid @enderror" placeholder="" name="validity">
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