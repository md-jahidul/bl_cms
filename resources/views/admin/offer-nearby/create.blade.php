@extends('layouts.admin')
@section('title', 'Near by offer')
@section('card_name', "Near by offer")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Create Near by offer
    </li>
@endsection

@section('content')
    <section>

        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                   <form class="form" action="{{route('nearByOffer.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create Near By offer.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title:<small class="text-danger">*</small></label>
                                        <input required type="text" value="@if(old('title')){{old('title')}}@endif" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title." name="title">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor">Vendor:<small class="text-danger">*</small></label>
                                        <input required type="text" value="@if(old('vendor')){{old('vendor')}}@endif" id="vendor" class="form-control @error('vendor') is-invalid @enderror" placeholder="Enter vendor." name="vendor">
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
                                        <input required type="text" min="0" value="@if(old('location')){{old('location')}}@endif" id="location" class="form-control @error('location') is-invalid @enderror" placeholder="Enter location...." name="location">
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
                                        <input required type="text" min="0" value="@if(old('type')){{old('type')}}@endif" id="type" class="form-control @error('type') is-invalid @enderror" placeholder="Enter type...." name="type">
                                        
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Offer">Offer:<small class="text-danger">*</small></label>
                                        <input required type="text" min="0" value="@if(old('offer')){{old('offer')}}@endif" id="Offer" class="form-control @error('offer') is-invalid @enderror" placeholder="Enter Offer...." name="offer">
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
                                        <input required type="text" min="0" value="@if(old('offer_code')){{old('offer_code')}}@endif" id="offer_code" class="form-control @error('offer_code') is-invalid @enderror" placeholder="Enter offer code...." name="offer_code">
                                        @error('offer_code')
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
                                    <div class="custom-file">
                                        <input accept="image/*" required name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image">
                                        <label class="custom-file-label @error('image') is-invalid @enderror" for="validatedCustomFile">Upload image...</label>
                                        {{-- <div class="invalid-feedback">Example invalid custom file feedback</div> --}}
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