@extends('layouts.admin')
@section('title', 'Internet Offer')
@section('card_name', "Internet Offer")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Edit Internet Offer
    </li>
@endsection

@section('action')
    <a href="{{route('internetOffer.index')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-arrow-left"></i>
        Back to List
    </a>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title:<small class="text-danger">*</small></label>
                                        <input
                                        required
                                        data-validation-required-message="title is required"
                                        maxlength="40"
                                        data-validation-maxlength-message = "Title can not be more then 200 characters"
                                        type="text" value="{{$internet_offer->title}}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
                                        <div class="help-block">
                                            <small class="text-info">Title can not be more then 40 characters</small>
                                        </div>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category" class="required">Category:</label>
                                        <select  class="form-control" name="category_id" required id="category" >
                                            <option value="">Select category</option>
                                            @foreach($offer_category as $category)
                                                <option value="{{ $category->id }}" @if($category->id == $internet_offer->id)selected @endif > {{$category->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block">
                                            <small id="category" class="form-text text-info">Select Category Type</small>
                                        </div>
                                        @error('category')
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
                                            <small id="volume" class="form-text text-info">Enter Volume in MB.</small>
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
                                        type="number" min="0" step="0.5" value="{{$internet_offer->price}}" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price.." name="price">
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
                                        data-validation-maxlength-message = "Offer Code can not be more then 200 characters"

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
                                        <label for="validity">Validity:<small class="text-danger">*</small></label>
                                        <input
                                        required
                                        maxlength="5"
                                        data-validation-required-message="Validity is required"
                                        type="number" min="0" value="{{$internet_offer->validity}}" id="validity" class="form-control @error('validity') is-invalid @enderror" placeholder="" name="validity">
                                        <div class="help-block">
                                            <small id="validity" class="form-text text-info">Enter Validity on day.</small>
                                        </div>
                                        @error('validity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tag">Tag:</label>
                                        <input
                                            type="text" value="{{$internet_offer->tag}}" id="tag" class="form-control @error('tag') is-invalid @enderror" placeholder="" name="tag">
                                        <div class="help-block">
                                            <small id="tag" class="form-text text-info">Enter Product tag</small>
                                        </div>
                                        @error('tag')
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
                            <i class="la la-check-square-o"></i> Update
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
