@extends('layouts.admin')
@section('title', 'USSD')
@section('card_name', "USSD")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Edit USSD
    </li>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" action="{{route('ussd.update',$ussd_code->id)}}" method="POST" novalidate>
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Edit USSD Code.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required">Title:</label>
                                        <input
                                        required 
                                        data-validation-required-message="Title is required" 
                                        maxlength="200" 
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9/.])*)*"
                                        data-validation-regex-message="Title must start with alphabets"
                                        data-validation-maxlength-message = "Title can not be more then 200 Characters"
                                        
                                        type="text" value="{{ old("provider") ? old("provider") : $ussd_code->title }}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
                                        <div class="help-block">
                                            <small class="text-info">Title length can not be more the 200 Characters</small>
                                        </div>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$ussd_code->id}}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="volume" class="required">Code:</label>
                                        <input 
                                        
                                        required 
                                        data-validation-required-message="Code is required" 
                                        maxlength="200" 
                                        data-validation-maxlength-message = "Code can not be more then 200 Characters"
                                        
                                        type="text" value="{{ old("provider") ? old("provider") : $ussd_code->code }}" id="volume" class="form-control @error('code') is-invalid @enderror" placeholder="Enter code...." name="code">
                                        <div class="help-block">
                                            <small class="text-info">Code length can not be more the 200 Characters</small><br>
                                            <small class="text-success">Code can contain *#</small>
                                        </div>
                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price" class="required">Purpose:</label>
                                        <input
                                        required
                                        maxlength="200"
                                        data-validation-required-message="Purpose is required" 
                                        data-validation-maxlength-message = "Purpose can not be more then 200 Characters"
                                        type="text" value="{{ old("provider") ? old("provider") : $ussd_code->purpose }}" id="price" class="form-control @error('purpose') is-invalid @enderror" placeholder="purpose.." name="purpose">
                                        <div class="help-block">
                                            <small class="text-info">Purpose length can not be more the 200 Characters</small>
                                        </div>
                                        @error('purpose')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="offer_code" class="required">Provider:</label>
                                        <input 
                                        required
                                        maxlength="200"
                                        data-validation-required-message="Provider is required" 
                                        data-validation-maxlength-message = "Provider can not be more then 200 Characters" 
                                        type="text" value="{{ old("provider") ? old("provider") : $ussd_code->provider }}" id="offer_code" class="form-control @error('provider') is-invalid @enderror" placeholder="provider.." name="provider">
                                        <div class="help-block">
                                            <small class="text-info">Provider length can not be more the 200 Characters</small><br>
                                        </div>
                                        @error('provider')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success round px-2">
                            <i class="la la-check-square-o"></i> Submit
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