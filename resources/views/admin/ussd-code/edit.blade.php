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
                                        type="text" value="{{ old("provider") ? old("provider") : $ussd_code->title }}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title...." name="title">
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
                                        type="text" value="{{ old("provider") ? old("provider") : $ussd_code->code }}" id="volume" class="form-control @error('code') is-invalid @enderror" placeholder="Enter code...." name="code">
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
                                        type="text" value="{{ old("provider") ? old("provider") : $ussd_code->purpose }}" id="price" class="form-control @error('purpose') is-invalid @enderror" placeholder="purpose.." name="purpose">
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
                                        type="text" value="{{ old("provider") ? old("provider") : $ussd_code->provider }}" id="offer_code" class="form-control @error('provider') is-invalid @enderror" placeholder="provider.." name="provider">
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