@extends('layouts.admin')
@section('title', 'Product Category')
@section('card_name', "Product Category")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Edit Product Category
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
                    <form novalidate class="form" action="{{route('mybl.internetOffer.category.update',$internet_offer->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$internet_offer->id}}">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Edit Product Category</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Name:<small class="text-danger">*</small></label>
                                        <input
                                        required
                                        data-validation-required-message="Name is required"
                                        maxlength="40"
                                        data-validation-maxlength-message = "Name can not be more then 200 characters"
                                        type="text" value="{{$internet_offer->name}}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name...." name="name">
                                        <div class="help-block">
                                            <small class="text-info">Name can not be more then 200 characters</small>
                                        </div>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_bn">Name Bn:<small class="text-danger">*</small></label>
                                        <input
                                        maxlength="40"
                                        type="text" value="{{$internet_offer->name_bn}}" id="name_bn" class="form-control @error('name_bn') is-invalid @enderror" placeholder="Enter name Bn...." name="name_bn">
                                        <div class="help-block">
                                            <small class="text-info">Name can not be more then 200 characters</small>
                                        </div>
                                        @error('title_bn')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category" class="required">Slug:</label>
                                        <input  class="form-control @error('slug') is-invalid @enderror" name="slug"  id="slug" placeholder="Enter Slug"  value="{{$internet_offer->slug}}" required
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
                                        type="number" min="1" max="5120" value="{{$internet_offer->sort}}" id="sort" class="form-control @error('sort') is-invalid @enderror" placeholder="Enter sort...." name="sort">

                                        @error('sort')
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
