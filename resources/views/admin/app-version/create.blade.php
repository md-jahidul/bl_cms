@extends('layouts.admin')
@php $cardname = isset($version)? 'Edit-AppVersion':'Create-AppVersion' @endphp
@section('title', "AppVersion")
@section('card_name', "AppVersion-edit")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        @if(isset($version))
            Edit-Banner
            @else
            Create-Banner
        @endif
    </li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">
                @if(isset($version))
                    Edit-App Version
                    @else
                    Create-App Version
                @endif
            </h1>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">

            @if(isset($version))
                <form novalidate action="{{ route('app-version.update',$version->id) }}" method="post" enctype="multipart/form-data">
                @else
                <form novalidate action="{{ route('app-version.store') }}" method="post" enctype="multipart/form-data">
            @endif 

            @csrf
            @if(isset($version))
                @method('put')
                @else
                @method('post')
            @endif 
           
            <div class="row">

                    <div class="col-6">

                        <div class="form-group">
                            <label for="name" class="required">Select Platform:</label>
                            <input type="text"/>

                    </div>

                    <div class="col-6">

                        <div class="form-group">
                            <label for="code" class="required">Version:</label>
                            <input required data-validation-required-message="Code is required" id="code" value="@if(isset($version)){{$version->code}} @elseif(old("code")) {{old("code")}} @endif" type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Banner code..">
                            <small class="text-danger"> @error('code') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>

                    </div>



                    <div class="col-2 mb-2" >
                        
                        <button type="submit" id="submitForm" style="width:100%" class="btn @if(isset($version)) btn-success @else btn-info @endif ">
                            @if(isset($version)) Update Version @else Create Version @endif
                        </button>
                    </div>
                
                </div>
            </div>

        </form>
    </div>

</div>


@endsection

@section('content_right_side_bar')
    <h1>
        List
    </h1>
@endsection


@push('style')
   
@endpush
@push('page-js')

    
@endpush