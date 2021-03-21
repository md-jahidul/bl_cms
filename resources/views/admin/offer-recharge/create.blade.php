@extends('layouts.admin')
@section('title', 'Internet Offer')
@section('card_name', "Internet Offer")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Create Internet Offer
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
                    <form novalidate class="form" action="{{route('internetOffer.store')}}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create Internet Offer.</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="required">Title:</label>
                                        <input
                                        required
                                        data-validation-required-message="Title is required"
                                        maxlength="200"
                                        data-validation-maxlength-message = "Title can not be more then 200 characters"
                                        type="text" value="@if(old('title')){{old('title')}}@endif" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
                                        <div class="help-block">
                                            <small class="text-info">Title can not be more then 200 characters</small>
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
                                                <option value="{{ $category->id }}"> {{$category->name }}</option>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="required" for="volume">Volume:</label>
                                        <input
                                        required
                                        type="number" min="1" max="5120" value="@if(old('volume')){{old('volume')}}@endif" id="volume" class="form-control @error('volume') is-invalid @enderror" placeholder="Enter volume...." name="volume">
                                        <div class="help-block">
                                            <small id="volume" class="form-text text-info">Enter volume in MB.(max 5GB)</small>
                                        </div>
                                        @error('volume')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="required" for="price">Price:</label>
                                        <input
                                        required
                                        type="number" min="0" step="0.5" value="@if(old('price')){{old('price')}}@endif" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price.." name="price">
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
                                        <label class="required" for="offer_code">Product Code:</label>
                                        <input
                                        required
                                        type="text" value="@if(old('offer_code')){{old('offer_code')}}@endif" id="offer_code" class="form-control @error('offer_code') is-invalid @enderror" placeholder="Offer code.." name="offer_code">
                                        <div class="help-block">
                                            <small id="validity" class="form-text text-info">Must enter a valid product Code</small>
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
                                        <label for="ussd_code">USSD Code:</label>
                                        <input
                                            type="text" value="@if(old('ussd_code')){{old('ussd_code')}}@endif" id="ussd_code" class="form-control @error('ussd_code') is-invalid @enderror" placeholder="USSD Code.." name="ussd_code">
                                        <div class="help-block">
                                            <small id="validity" class="form-text text-info">Enter Product USSD Code</small>
                                        </div>
                                        @error('ussd_code')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="validity">Validity:</label>
                                        <input
                                            required
                                            type="number" min="1"  value="@if(old('validity')){{old('price')}}@endif" id="validity" class="form-control @error('validity') is-invalid @enderror" placeholder="Validity.." name="validity">
                                        <div class="help-block">
                                            <small id="validity" class="form-text text-info">validity in days.</small>
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
                                        <label for="validity">Tag:</label>
                                        <input
                                            type="text"  value="@if(old('validity')){{old('validity')}}@endif" id="tag" class="form-control @error('tag') is-invalid @enderror" placeholder="" name="tag">
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
