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
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create SMS offer.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">title:<small class="text-danger">*</small></label>
                                        <input type="text" value="" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
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
                                        <input type="text" value="" id="vendor" class="form-control @error('vendor') is-invalid @enderror" placeholder="Enter vendor...." name="vendor">
                                        <small id="vendor" class="form-text text-muted">Enter vendor...</small>
                                        @error('vendor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="volume">location:<small class="text-danger">*</small></label>
                                        <input type="text" min="0" value="" id="volume" class="form-control @error('location') is-invalid @enderror" placeholder="Enter volume...." name="location">
                                        <small id="volume" class="form-text text-muted">Enter volume in minute.</small>
                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="volume">type:<small class="text-danger">*</small></label>
                                        <input type="text" min="0" value="" id="volume" class="form-control @error('type') is-invalid @enderror" placeholder="Enter volume...." name="type">
                                        <small id="volume" class="form-text text-muted">Enter volume in minute.</small>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="volume">offer:<small class="text-danger">*</small></label>
                                        <input type="text" min="0" value="" id="volume" class="form-control @error('offer') is-invalid @enderror" placeholder="Enter volume...." name="offer">
                                        <small id="volume" class="form-text text-muted">Enter volume in minute.</small>
                                        @error('offer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="volume">offer_code:<small class="text-danger">*</small></label>
                                        <input type="text" min="0" value="" id="volume" class="form-control @error('offer_code') is-invalid @enderror" placeholder="Enter volume...." name="offer_code">
                                        <small id="volume" class="form-text text-muted">Enter volume in minute.</small>
                                        @error('offer_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12"> 
                                    <img style="height:100px;width:200px;display:none" id="imgDisplay" src="" alt="" srcset="">
                                    <input type="hidden" value="no" name="value_exist">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="volume">image:<small class="text-danger">*</small></label><br>
                                        <input type="file" style="border:none" value="" id="image" class="p-0 form-control @error('image') is-invalid @enderror" placeholder="Enter volume...." name="image">
                                        <small class="form-text text-muted">Enter volume in minute.</small>
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