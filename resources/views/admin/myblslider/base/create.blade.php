@extends('layouts.admin')
@section('title', 'Base Create')

@php
    $name = 'Create ';


@endphp

@section('card_name', "Base Msisdn")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        {{$name}} Base Msisdn
    </li>
@endsection

@section('action')
    <a href="{{route('myblslider.baseMsisdnList.index') }}" class="btn btn-info btn-glow px-2">
        Back
    </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form novalidate class="form" action="{{route('myblslider.base.msisdn.store')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title" class="required">Title:</label>
                                        <input
                                            required
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Title is required"
                                            data-validation-regex-message="Title must start with alphabets"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('title')) {{old('title')}} @endif" required id="title"
                                            type="text" class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Title" name="title">
                                        <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="is_active" class="required">Active Status:</label>
                                            <select class="form-control" id="status"
                                                    name="status">
                                                <option value="1"> Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12" id="CustomMsisdnSegmentDiv">
                                        <label><b>Msisdn for Banner segment</b></label>
                                        <div class="form-group">
                                            <input type="checkbox" name="segment_type" value="yes" id="input-radio-19">
                                            <label for="input-radio-19" class="mr-3">Individual</label>

                                        </div>
                                        <div class="form-group" id="customMsisdnExcel">
                                            <input type="file" class="dropify" name="msisdn_file" data-height="100"
                                                   data-allowed-file-extensions="xlsx csv"/>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('msisdn_file'))
                                            <div class="help-block">  {{ $errors->first('msisdn_file') }}</div>
                                        @endif
                                        <div class="form-group hidden" id="customMsisdn">
                                            <textarea class="form-control" name="custom_msisdn" cols="2"
                                                      placeholder="019000000000,01400000000"></textarea>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('custom_msisdn'))
                                            <div class="help-block">  {{ $errors->first('custom_msisdn') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success round px-2">
                                    <i class="la la-check-square-o"></i> Submit
                                </button>
                            </div>
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
    <script>
        $('input[name$="segment_type"]').click(function () {
            if ($('input[name$="segment_type"]').is(':checked')) {
                // alert("it's checked");
                $("#customMsisdnExcel").addClass('hidden');
                $("#customMsisdn").addClass('show').removeClass('hidden');
                // $("#Cars" + test).show();
            } else {
                $("#customMsisdnExcel").addClass('show').removeClass('hidden');
                $("#customMsisdn").addClass('hidden').removeClass('show');
            }
        });
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            $("#navigate_action").select2();


        })
    </script>
@endpush
