@extends('layouts.admin')
@section('title', 'Contextual Card Icon')
@section('card_name', "Contextual Card Icon")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Create Contextual Card Icon
    </li>
@endsection

@section('content')
    <section>

        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form novalidate class="form" action="{{route('contextualcard.icons.store')}}"
                          enctype="multipart/form-data" method="POST" novalidate>
                        @csrf
                        @method('POST')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create Contextual Card Icon.</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('card_number') ? ' error' : '' }}">
                                        <label for="card_number" class="required">Card Number:</label>
                                        <input required value="{{ old("card_number") ? old("card_number") : '' }}"
                                               required
                                               maxlength="100"
                                               data-validation-required-message="Card number is required"
                                               type="number"
                                               value=""
                                               id="card_number"
                                               class="form-control @error('card_number') is-invalid @enderror"
                                               placeholder="Enter Card Number...."
                                               name="card_number">

                                        {{--                                        <div class="help-block">--}}
                                        {{--                                            <small class="text-info">--}}
                                        {{--                                                Title can not be more then 100 Characters--}}
                                        {{--                                            </small>--}}
                                        {{--                                        </div>--}}
                                        @if ($errors->has('card_number'))
                                            <div class="help-block">  {{ $errors->first('card_number') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('category') ? ' error' : '' }}">
                                        <label for="category" class="required">Category</label>
                                        <input
                                            required
                                            maxlength="100"
                                            data-validation-required-message="Category is required"
                                            data-validation-maxlength-message="Category can not be more then 100 Characters"

                                            type="text"
                                            value="{{ old("category") ? old("category") : '' }}"
                                            value="" id="second_action_text"
                                            class="form-control @error('category') is-invalid @enderror"
                                            placeholder="Enter Category" name="category">
                                        <div class="help-block">
                                            {{--                                            <small class="text-info">--}}
                                            {{--                                                Second Action Text can not be more then 100 Characters--}}
                                            {{--                                            </small>--}}
                                        </div>
                                        @error('second_action_text')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mb-1">
                                    <img style="height:100px;width:200px;display:none" id="imgDisplay" src="" alt=""
                                         srcset="">
                                    <input type="hidden" value="no" name="value_exist">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="image" class="required">Upload contextual Card Icon:</label>
{{--                                        <div class="input-group ">--}}
{{--                                            <div class="custom-file">--}}
                                                <input
                                                    required
                                                    data-validation-required-message="Card Icon is required"
                                                    accept="image/*"
                                                    onchange="
                                                    createImageBitmap(this.files[0]).then((bmp) => {

                                                        //console.log(this.files[0].name.split('.').pop())
                                                        if(bmp.width/bmp.height == 1/1){
                                                            console.log('yes')
                                                            // document.getElementById('addMore').disabled = false;
                                                            document.getElementById('submitForm').disabled = false;
                                                            this.style.border = 'none';
                                                            document.getElementById('massage').innerHTML = '';
                                                        }else{
                                                            console.log('no')
                                                            this.style.border = '1px solid red';
                                                            document.getElementById('massage').classList.add('text-danger');
                                                            document.getElementById('massage').innerHTML = '<b>Card Icon aspact ratio must be in 1:1(change the picture to enable button)</b>';
                                                            // document.getElementById('addMore').disabled = true;
                                                            document.getElementById('submitForm').disabled = true;
                                                        }
                                                    })"


                                                    value="{{ old("icon") ? old("icon") : '' }}"
                                                    name="icon" id="icon" type="file"
                                                    class="custom-file-input @error('icon') is-invalid @enderror dropify"
                                                >
{{--                                                <label class="custom-file-label" for="icon">Upload icon...</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="help-block">
                                            <small class="text-info">
                                                Card Icon aspact ratio must be in 1:1
                                            </small>
                                        </div>
                                        <div id="massage"></div>
                                        <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('remark') ? ' error' : '' }}">
                                        <label for="description" class="">Remark:</label>
                                        <textarea
                                            maxlength="100"
                                            data-validation-maxlength-message="Remark can not be more then 100 Characters"
                                            class="form-control" name="remark" placeholder="Enter remark..." id="remark"
                                            rows="2">{{ old("remark") ? old("remark") : '' }}</textarea>
                                        <small id="remark" class="form-text text-muted">Enter remark...</small>
                                        <div class="help-block"></div>
                                        @error('remark')
                                        <span class="help-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button id="submitForm" type="submit" class="btn btn-success round px-2">
                                    <i class="la la-check-square-o"></i> Submit
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>


    </section>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                ...
            </div>
        </div>
    </div>



@endsection


@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush


@push('style')

@endpush
@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $("#showApplyModel").click(function () {
            $('#').modal('show')
        });
        $(document).ready(function () {

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an image to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct image file'
                },
                error: {
                    'imageFormat': 'The image ratio must be 1:1.'
                }
            });
        });
    </script>
@endpush
