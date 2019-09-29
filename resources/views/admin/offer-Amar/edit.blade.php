@extends('layouts.admin')
@section('title', 'Amar offer')
@section('card_name', "Amar offer offer")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Edit Amar offer
    </li>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                   <form novalidate class="form" action="{{route('amarOffer.update',$amarOffer->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$amarOffer->id}}">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Edit Amar offer.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required">Title:</label>
                                        <input 

                                        required 
                                        data-validation-required-message="Title is required" 
                                        maxlength="200" 
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9/\.,])*)*"
                                        data-validation-regex-message="Title must start with alphabets"
                                        data-validation-maxlength-message = "Title name can not be more then 200 charecters"

                                        type="text" value="{{$amarOffer->title}}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
                                        <div class="help-block">
                                            <small class="text-info">
                                                Title name can not be more then 200 charecters
                                            </small>
                                        </div>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$amarOffer->id}}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="internet" class="required">Internet:</label>
                                        <input 

                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "Internet Volume can never be more then 50000 digits"
                                        data-validation-required-message="Internet Volume is required"

                                        type="number" min="0" value="{{$amarOffer->internet}}" id="internet" class="form-control @error('internet') is-invalid @enderror" placeholder="Enter volume...." name="internet">
                                        <div class="help-block">
                                            <small id="internet" class="form-text text-info">Enter volume in MB.</small>
                                        </div>
                                        @error('internet')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="minutes" class="required">Minutes:</label>
                                        <input 

                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "Minutes Volume can never be more then 50000 digits"
                                        data-validation-required-message="Minutes Volume is required"

                                        type="number" min="0" value="{{$amarOffer->minutes}}" id="minutes" class="form-control @error('minutes') is-invalid @enderror" placeholder="Enter volume...." name="minutes">
                                        <div class="help-block">
                                            <small id="minutes" class="form-text text-info">Enter volume in minutes.</small>
                                        </div>
                                        @error('minutes')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sms" class="required">SMS:</label>
                                        <input
                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "SMS Volume can never be more then 50000 digits"
                                        data-validation-required-message="SMS Volume is required"
                                        type="number" min="0" value="{{$amarOffer->sms}}" id="sms" class="form-control @error('sms') is-invalid @enderror" placeholder="Enter volume...." name="sms">
                                        <div class="help-block">
                                            <small id="sms" class="form-text text-info">Enter volume in amount of sms.</small>
                                        </div>
                                        @error('sms')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price" class="required">Price:</label>
                                        <input 
                                        required
                                        maxlength="50" 
                                        data-validation-maxlength-message = "Price can never be more then 50 digits"
                                        data-validation-required-message="Price is required"
                                        type="number" min="0" value="{{$amarOffer->price}}" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price.." name="price">
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
                                        <label for="points" class="required">Points:</label>
                                        <input 
                                        required
                                        maxlength="50000" 
                                        data-validation-maxlength-message = "Points can never be more then 50000 digits"
                                        data-validation-required-message="Points is required"
                                        type="number" min="0" value="{{$amarOffer->points}}" id="points" class="form-control @error('points') is-invalid @enderror" placeholder="Points.." name="points">
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
                                        <label for="offer_code" class="required">Offer Code:</label>
                                        <input
                                        required 
                                        data-validation-required-message="Offer Code is required" 
                                        maxlength="200" 
                                        data-validation-maxlength-message = "Offer Code can not be more then 200 charecters"
                                        type="text" value="{{$amarOffer->offer_code}}" id="offer_code" class="form-control @error('offer_code') is-invalid @enderror" placeholder="Offer code.." name="offer_code">
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
                                        <label for="tag" class="required">Tag:</label>
                                        <input 
                                        required 
                                        data-validation-required-message="Tag is required" 
                                        maxlength="200" 
                                        data-validation-maxlength-message = "Tag can not be more then 200 charecters"
                                        type="text" value="{{$amarOffer->tag}}" id="tag" class="form-control @error('tag') is-invalid @enderror" placeholder="Offer code.." name="tag">
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
                                        <label for="validity" class="required">Validity:</label>
                                        <input 
                                        required
                                        maxlength="50" 
                                        data-validation-maxlength-message = "Validity can never be more then 50 digits"
                                        data-validation-required-message="Validity is required"
                                        type="number" min="0" value="{{$amarOffer->validity}}" id="validity" class="form-control @error('validity') is-invalid @enderror" placeholder="" name="validity">
                                        <div class="help-block">
                                            <small id="validity" class="form-text text-muted">Enter Validation on day.</small>
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