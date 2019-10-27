@extends('layouts.admin')
@php $cardname = isset($version)? 'Edit-AppVersion':'Create-AppVersion' @endphp
@section('title', "AppVersion")
@section('card_name', "AppVersion")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        @if(isset($version))
            Edit App Version
            @else
            Create App Version
        @endif
    </li>
@endsection

dd($version);

@section('content')

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">
                @if(isset($version))
                    Edit App Version
                    @else
                    Create App Version
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
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name" class="required">Select Platform:</label>
                                <select name="platform" required data-validation-required-message="Platform is required"  class="browser-default custom-select">
                                    <option selected>Select Platform</option>
                                    @if(isset($version))
                                        <option value="ios" @if($version->platform == "ios") selected="selected" @endif>ios</option>
                                        <option value="android" @if($version->platform == "android") selected="selected" @endif>android</option>
                                        <option value="windows" @if($version->platform == "windows") selected="selected" @endif>windows</option>
                                        <option value="others"  @if($version->platform == "others") selected="selected" @endif>others</option>
                                    @else
                                        <option value="ios">ios</option>
                                        <option value="android">android</option>
                                        <option value="windows">windows</option>
                                        <option value="others">others</option>
                                    @endif

                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="code" class="required">Version:</label>
                                <input required data-validation-required-message="Version is required"  name="current_version"
                                       value="@if(isset($version)){{$version->current_version}} @elseif(old("current_version")) {{old("current_version")}} @endif"
                                       type="text"  class="form-control @error('current_version') is-invalid @enderror" placeholder="Enter app version..">
                                <small class="text-danger"> @error('current_version') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>

                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name" class="required">Force Update:</label>
                                <select name="force_update"  required data-validation-required-message="Platform is required"  class="browser-default custom-select">
                                    <option selected>Select force Update</option>
                                    @if(isset($version))
                                        <option value=1 @if($version->force_update == 1) selected="selected" @endif>true</option>
                                        <option value=0 @if($version->force_update == 0) selected="selected" @endif>false</option>
                                    @else
                                        <option value=1>true</option>
                                        <option value=0>false</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="code" class="required">Message:</label>
                                <input required data-validation-required-message="Message is required"  name="message"
                                       value="@if(isset($version)){{$version->message}} @elseif(old("message")) {{old("message")}} @endif"
                                       type="text"  class="form-control @error('message') is-invalid @enderror" placeholder="Enter message..">
                                <small class="text-danger"> @error('message') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>

                        </div>


                    <div class="col-4 mb-2" >

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