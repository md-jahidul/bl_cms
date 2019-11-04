@extends('layouts.admin')
@php $cardname = isset($config)? 'Edit OTP Config':'Create OTP Config' @endphp
@section('title', "OTP Config")
@section('card_name', "OTP Config")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        @if(isset($config))
            Edit OTP Config
            @else
            Create OTP Config
        @endif
    </li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">
                @if(isset($config))
                    Edit OTP Config
                    @else
                    Create OTP Config
                @endif
            </h1>
        </div>

        <!-- /.card-header -->
        <div class="card-body">

            @if(isset($config))
                <form novalidate action="{{ route('otp-config.update',$config->id) }}" method="post" enctype="multipart/form-data">
                @else
                <form novalidate action="{{ route('otp-config.store') }}" method="post" enctype="multipart/form-data">
            @endif 

            @csrf
            @if(isset($config))
                @method('put')
                @else
                @method('post')
            @endif 
           
            <div class="row">

                    <div class="col-6">

                        @php
                            $tokenLengthList = Helper::tokenLengthList();
                        @endphp


                        <div class="col-6">
                            <div class="form-group">
                                <label for="name" class="required">Token Length(number):</label>
                                <select name="token_length_number" class="browser-default custom-select">
                                    @foreach ($tokenLengthList as $key => $value)
                                        @if(isset($config))
                                            <option value="{{ $value }}" {{ ( $value == $config->token_length_number) ? 'selected' : '' }}>
                                        @else
                                            <option value="{{ $value }}">
                                                @endif
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="col-6">
                            <div class="form-group">
                                <label for="name" class="required">Token Length(String):</label>
                                <select name="token_length_string" class="browser-default custom-select">
                                    @foreach ($tokenLengthList as $key => $value)
                                        @if(isset($config))
                                        <option value="{{ $key }}" {{ ( $key == $config->token_length_string) ? 'selected' : '' }}>
                                        @else
                                        <option value="{{ $key }}">
                                        @endif
                                            {{ $key }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="code" class="required">Validation Time (Sec):</label>
                                <input required data-validation-required-message="Validation Time is required"  name="validation_time"
                                       value="@if(isset($config)){{$config->validation_time}} @elseif(old("validation_time")) {{old("validation_time")}} @endif"
                                       type="text"  class="form-control @error('current_version') is-invalid @enderror" placeholder="Enter Validation Time..">
                                <small class="text-danger"> @error('validation_time') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>

                        </div>


                        <div class="col-5 mb-2" >

                        <button type="submit" id="submitForm" style="width:100%" class="btn @if(isset($config)) btn-success @else btn-info @endif ">
                            @if(isset($config)) Update OTP Config @else Create OTP Config @endif
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