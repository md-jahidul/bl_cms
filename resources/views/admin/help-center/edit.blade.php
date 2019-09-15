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
                    <form class="form" action="{{ route('helpCenter.update',$helpCenter->id)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create SMS offer.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">title:<small class="text-danger">*</small></label>
                                        <input type="text" value="{{$helpCenter->title}}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="offer_code">sequence:<small class="text-danger">*</small></label>
                                        <input type="number" value="{{$helpCenter->sequence}}" id="sequence" class="form-control @error('sequence') is-invalid @enderror" placeholder="Offer code.." name="sequence">
                                        <small id="validity" class="form-text text-muted">Offer Code must have *,# and number in it.</small>
                                        @error('sequence')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">redirect_link:<small class="text-danger">*</small></label>
                                        <input type="number" min="0" value="{{$helpCenter->redirect_link}}" id="redirect_link" class="form-control @error('redirect_link') is-invalid @enderror" placeholder="Price.." name="redirect_link">
                                        <small id="price" class="form-text text-muted">Enter price in BDT.</small>
                                        @error('redirect_link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12"> 
                                    <img style="height:100px;width:200px" id="imgDisplay" src="{{asset($helpCenter->icon)}}" alt="" srcset="">
                                    <input type="hidden" value="yes" name="value_exist">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">icon:<small class="text-danger">*</small></label><br>
                                        <input type="file" value="" id="image" class="@error('icon') is-invalid @enderror" placeholder="Enter volume...." name="icon">
                                        <small id="volume" class="form-text text-muted">Enter volume in minute.</small>
                                        @error('icon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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