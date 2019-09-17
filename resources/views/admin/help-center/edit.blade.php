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
                            <h4 class="form-section"><i class="la la-paperclip"></i>Edit Help Center.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">title:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{$helpCenter->title}}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
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
                                        <input required type="number" min="0" value="{{$helpCenter->sequence}}" id="sequence" class="form-control @error('sequence') is-invalid @enderror" placeholder="sequence." name="sequence">
                                        @error('sequence')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Redirect Link:<small class="text-danger">*</small></label>
                                        <input required type="text" value="{{$helpCenter->redirect_link}}" id="redirect_link" class="form-control @error('redirect_link') is-invalid @enderror" placeholder="Http.." name="redirect_link">
                                        <small id="price" class="form-text text-muted">Redirect Link.</small>
                                        @error('redirect_link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-1"> 
                                    <img style="height:100px;width:200px" id="imgDisplay" src="{{asset($helpCenter->icon)}}" alt="" srcset="">
                                    <input type="hidden" value="yes" name="value_exist">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="icon" id="image" type="file" class="custom-file-input @error('icon') is-invalid @enderror" id="icon">
                                                <label class="custom-file-label" for="icon">Upload icon...</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                        <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
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