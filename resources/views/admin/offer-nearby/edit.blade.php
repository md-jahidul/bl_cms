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
                   <form class="form" action="{{route('nearByOffer.update',$nearByOffer->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Edit Near By offer.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{$nearByOffer->title}}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor">vendor:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{$nearByOffer->vendor}}" id="vendor" class="form-control @error('vendor') is-invalid @enderror" placeholder="Enter vendor...." name="vendor">
                                        @error('vendor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Location:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{$nearByOffer->location}}" id="location" class="form-control @error('location') is-invalid @enderror" placeholder="Enter location...." name="location">
                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type">Type:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{$nearByOffer->type}}" id="type" class="form-control @error('type') is-invalid @enderror" placeholder="Enter type...." name="type">
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="offer">Offer:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{$nearByOffer->offer}}" id="offer" class="form-control @error('offer') is-invalid @enderror" placeholder="Enter offer...." name="offer">
                                        @error('offer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="offer_code">Offer Code:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{$nearByOffer->offer_code}}" id="offer_code" class="form-control @error('offer_code') is-invalid @enderror" placeholder="Enter offer code...." name="offer_code">
                                        @error('offer_code')
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
                                        <input accept="image/*" required name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image">
                                        <label class="custom-file-label @error('image') is-invalid @enderror" for="validatedCustomFile">Upload image...</label>
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