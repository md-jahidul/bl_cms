@extends('layouts.admin')
@section('title', 'Internet Offer Category')
@section('card_name', "Internet Offer Category")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Create Internet Offer Category
    </li>
@endsection

@section('action')
    <a href="{{route('mybl-internet-offer-category')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-arrow-left"></i>
        Back to List
    </a>
@endsection
@section('content')
    <section>

        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form novalidate class="form" action="{{route('mybl-internet-offer-category.store')}}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create Internet Offer Category.</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="required">Name:</label>
                                        <input
                                        required
                                        data-validation-required-message="Name is required"
                                        maxlength="200"
                                        data-validation-maxlength-message = "Name can not be more then 200 characters"
                                        type="text" value="@if(old('name')){{old('name')}}@endif" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name...." name="name">
                                        <div class="help-block">
                                            <small class="text-info">Name can not be more then 200 characters</small>
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_bn">Name Bn:</label>
                                        <input
                                        maxlength="200"
                                        data-validation-maxlength-message = "Name Bn can not be more then 200 characters"
                                        type="text" value="@if(old('name_bn')){{old('name_bn')}}@endif" id="name_bn" class="form-control @error('name_bn') is-invalid @enderror" placeholder="Enter name Bn...." name="name_bn">
                                        <div class="help-block">
                                            <small class="text-info">Name Bn can not be more then 200 characters</small>
                                        </div>
                                        @error('name_bn')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category" class="required">Slug:</label>
                                        <input  class="form-control @error('slug') is-invalid @enderror" name="slug"  id="slug" placeholder="Enter Slug"  value="@if(old('slug')){{old('slug')}}@endif" required
                                        data-validation-required-message="Slug is required"
                                        maxlength="200"
                                        data-validation-maxlength-message = "Slug can not be more then 200 characters" />
                                        @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="sort">Sort:</label>
                                        <input
                                        required
                                        type="number" min="1" max="5120" value="@if(old('sort')){{old('sort')}}@endif" id="sort" class="form-control @error('sort') is-invalid @enderror" placeholder="Enter sort...." name="sort">

                                        @error('sort')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
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
                    <br>
                </div>
            </div>
        </div>

    </section>
@endsection

