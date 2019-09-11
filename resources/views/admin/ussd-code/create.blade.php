@extends('layouts.admin')
@section('title', 'USSD')
@section('card_name', "USSD")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Create USSD
    </li>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" action="{{route('ussd.store')}}" method="POST">
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
                                        <label for="volume">code:<small class="text-danger">*</small></label>
                                        <input type="text" value="" id="volume" class="form-control @error('code') is-invalid @enderror" placeholder="Enter code...." name="code">
                                        <small id="volume" class="form-text text-muted">Enter volume in minute.</small>
                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price">purpose:<small class="text-danger">*</small></label>
                                        <input type="number" min="0" value="" id="price" class="form-control @error('purpose') is-invalid @enderror" placeholder="Price.." name="purpose">
                                        <small id="price" class="form-text text-muted">Enter price in BDT.</small>
                                        @error('purpose')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="offer_code">provider:<small class="text-danger">*</small></label>
                                        <input type="text" value="" id="offer_code" class="form-control @error('provider') is-invalid @enderror" placeholder="Offer code.." name="provider">
                                        <small id="validity" class="form-text text-muted">Offer Code must have *,# and number in it.</small>
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