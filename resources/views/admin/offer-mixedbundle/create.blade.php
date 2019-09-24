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
                   <form class="form" action="{{route('mixedBundleOffer.store')}}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create SMS offer.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title:<small class="text-danger">*</small></label>
                                        <input required type="text" value="@if(old('title')){{old('title')}}@endif" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
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
                                        <input required type="number" min="0" value="@if(old('internet')){{old('internet')}}@endif" id="internet" class="form-control @error('internet') is-invalid @enderror" placeholder="Enter volume...." name="internet">
                                        <small id="internet" class="form-text text-muted">Enter volume in MB.</small>
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
                                        <input required type="number" min="0" value="@if(old('minutes')){{old('minutes')}}@endif" id="minutes" class="form-control @error('minutes') is-invalid @enderror" placeholder="Enter volume...." name="minutes">
                                        <small id="minutes" class="form-text text-muted">Enter volume in minutes.</small>
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
                                        <input required type="number" min="0" value="@if(old('sms')){{old('sms')}}@endif" id="sms" class="form-control @error('sms') is-invalid @enderror" placeholder="Enter volume...." name="sms">
                                        <small id="sms" class="form-text text-muted">Enter volume in amount of sms.</small>
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
                                        <input required type="number" min="0" value="@if(old('price')){{old('price')}}@endif" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price.." name="price">
                                        <small id="price" class="form-text text-muted">Enter price in BDT.</small>
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
                                        <input required type="number" min="0" value="@if(old('points')){{old('points')}}@endif" id="points" class="form-control @error('points') is-invalid @enderror" placeholder="Points.." name="points">
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
                                        <input required type="text" value="@if(old('offer_code')){{old('offer_code')}}@endif" id="offer_code" class="form-control @error('offer_code') is-invalid @enderror" placeholder="Offer code.." name="offer_code">
                                        <small id="validity" class="form-text text-muted">Offer Code must have *,# and number in it.</small>
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
                                        <input required type="text" value="@if(old('tag')){{old('tag')}}@endif" id="tag" class="form-control @error('tag') is-invalid @enderror" placeholder="Offer code.." name="tag">
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
                                        <input required type="number" min="0" value="@if(old('validity')){{old('validity')}}@endif" id="validity" class="form-control @error('validity') is-invalid @enderror" placeholder="" name="validity">
                                        <small id="validity" class="form-text text-muted">Enter Validation on day.</small>
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