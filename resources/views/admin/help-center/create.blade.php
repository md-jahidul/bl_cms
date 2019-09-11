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
                    <form class="form" action="{{route('helpCenter.store')}}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create SMS offer.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title:<small class="text-danger">*</small></label>
                                        <input type="text" value="" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="volume">Volume:<small class="text-danger">*</small></label>
                                        <input type="number" min="0" value="" id="volume" class="form-control @error('volume') is-invalid @enderror" placeholder="Enter volume...." name="volume">
                                        <small id="volume" class="form-text text-muted">Enter volume in minute.</small>
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
                                        <input type="number" min="0" value="" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price.." name="price">
                                        <small id="price" class="form-text text-muted">Enter price in BDT.</small>
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
                                        <input type="text" value="" id="offer_code" class="form-control @error('offer_code') is-invalid @enderror" placeholder="Offer code.." name="offer_code">
                                        <small id="validity" class="form-text text-muted">Offer Code must have *,# and number in it.</small>
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
                                        <input type="number" min="0" value="" id="points" class="form-control @error('points') is-invalid @enderror" placeholder="Points.." name="points">
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
                                        <input type="number" min="0" value="" id="validity" class="form-control @error('validity') is-invalid @enderror" placeholder="" name="validity">
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