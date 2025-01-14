@extends('layouts.admin')
@section('title', 'Mixed Bundle offer')
@section('card_name', "Mixed Bundle offer")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Edit Mixed Bundle offer
    </li>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                   <form novalidate class="form" action="{{route('mixedBundleOffer.update',$mixedBundle_offer->id)}}" method="POST">
                        @csrf
                        @method('put')

                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Edit Mixed Bundle offer.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title:<small class="text-danger">*</small></label>
                                        <input

                                        required
                                        data-validation-required-message="Title is required"
                                        maxlength="200"
                                        data-validation-maxlength-message = "Title can not be more then 200 characters"

                                        type="text" value="{{$mixedBundle_offer->title}}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
                                        <div class="help-block">
                                            <small class="text-info">
                                                Title can not be more then 200 characters
                                            </small>
                                        </div>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$mixedBundle_offer->id}}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="internet">Internet:<small class="text-danger">*</small></label>
                                        <input
                                        required
                                        maxlength="50000"
                                        data-validation-maxlength-message = "Internet Volume can not be more then 50000 digits"
                                        data-validation-required-message="Internet Volume is required"
                                        type="number" min="0" value="{{$mixedBundle_offer->internet}}" id="internet" class="form-control @error('internet') is-invalid @enderror" placeholder="Enter volume...." name="internet">

                                        <div class="help-block">
                                            <small id="validity" class="form-text text-info">Enter volume in MB.</small>
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
                                        <label for="minutes">Minutes:<small class="text-danger">*</small></label>
                                        <input

                                        required
                                        maxlength="50000"
                                        data-validation-maxlength-message = "Minutes Volume can not be more then 50000 digits"
                                        data-validation-required-message="Minutes Volume is required"

                                        type="number" min="0" value="{{$mixedBundle_offer->minutes}}" id="minutes" class="form-control @error('minutes') is-invalid @enderror" placeholder="Enter volume...." name="minutes">

                                        <div class="help-block">
                                            <small id="validity" class="form-text text-info">Enter volume in minutes.</small>
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
                                        <label for="sms">SMS:<small class="text-danger">*</small></label>
                                        <input

                                        required
                                        maxlength="50000"
                                        data-validation-maxlength-message = "SMS Volume can not be more then 50000 digits"
                                        data-validation-required-message="SMS Volume is required"

                                        type="number" min="0" value="{{$mixedBundle_offer->sms}}" id="sms" class="form-control @error('sms') is-invalid @enderror" placeholder="Enter volume...." name="sms">

                                        <div class="help-block">
                                            <small id="validity" class="form-text text-info">Enter volume in amount of sms.</small>
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
                                        <label for="price">Price:<small class="text-danger">*</small></label>
                                        <input

                                        required
                                        maxlength="50"
                                        data-validation-maxlength-message = "Price can not be more then 50 digits"
                                        data-validation-required-message="Price is required"

                                        type="number" min="0" value="{{$mixedBundle_offer->price}}" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price.." name="price">
                                        <div class="help-block">
                                            <small id="validity" class="form-text text-info">Price can not be more then 50 digits</small>
                                        </div>
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
                                        <input
                                        required
                                        maxlength="50000"
                                        data-validation-maxlength-message = "Points can not be more then 50000 digits"
                                        data-validation-required-message="Points is required"
                                        type="number" min="0" value="{{$mixedBundle_offer->points}}" id="points" class="form-control @error('points') is-invalid @enderror" placeholder="Points.." name="points">
                                        <div class="help-block">
                                            <small id="validity" class="form-text text-info">Points can not be more then 50000 digits</small>
                                        </div>
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
                                        <input

                                        required
                                        data-validation-required-message="Offer Code is required"
                                        maxlength="200"
                                        data-validation-maxlength-message = "Offer Code cannot be more then 200 characters"

                                        type="text" value="{{$mixedBundle_offer->offer_code}}" id="offer_code" class="form-control @error('offer_code') is-invalid @enderror" placeholder="Offer code.." name="offer_code">
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
                                        <label for="tag">Tag:<small class="text-danger">*</small></label>
                                        <input
                                        maxlength="200"
                                        data-validation-maxlength-message = "Tag can not be more then 200 charecters"
                                        type="text" value="{{$mixedBundle_offer->tag}}" id="tag" class="form-control @error('tag') is-invalid @enderror" placeholder="Offer code.." name="tag">
                                        <div class="help-block">
                                            <small class="text-info">
                                                Tag can not be more then 200 charecters
                                            </small>
                                        </div>
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
                                        <input required type="number" min="0" value="{{$mixedBundle_offer->validity}}" id="validity" class="form-control @error('validity') is-invalid @enderror" placeholder="" name="validity">
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
