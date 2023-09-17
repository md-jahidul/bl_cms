@extends('layouts.admin')
@section('title', "Edit Gamification")
@section('card_name', "Edit Gamification")
@section('action')
    <a href="{{route('gamification.index')}}" class="btn btn-primary btn-glow px-2">
        Back To Gamification list
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">
                Edit Gamification
            </h1>
        </div>

        <!-- /.card-header -->
        <div class="card-body">

            <!-- /short cut add form -->
            <form novalidate action="{{route('gamification.update', $trivia->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="row">
                    <!-- Type Label -->
                    <div class="form-group col-md-4 mb-2">
                        <label for="type" class="required">Type:</label>
                        <select name="type" class="browser-default custom-select" required>
                                <option value="trivia" @if ($trivia->type == 'trivia') selected @endif> Trivia </option>
                                <option value="spin_wheel" @if ($trivia->type == 'spin_wheel') selected @endif> Spin Wheel </option>
                        </select>
                        <div class="help-block"></div>
                    </div>

                    <!-- Rule Name -->
                    <div class="col-4">
                        <div class="form-group">
                            <label for="rule_name" class="required">Rule Name:</label>
                            <input
                            required
                            maxlength="200"
                            data-validation-required-message="The field is required"
                            data-validation-maxlength-message = "Max Character: 200"
                            value="@if(isset($trivia)) {{$trivia->rule_name}} @elseif(old("rule_name")) {{ old("rule_name") }} @endif"
                            type="text"
                            name="rule_name"
                            class="form-control @error('rule_name') is-invalid @enderror"
                            id="rule_name"
                            placeholder="Enter Rule Name..">
                            <small class="text-danger"> @error('rule_name') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <!-- Content For -->
                    <div class="col-md-4">
                        <label for="status_input">Component For: </label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox"
                                            class=""
                                            id="home"
                                            name="home"
                                            value="true"
                                            @if(isset($trivia->content_for->home)) @if($trivia->content_for->home) checked @endif @endif
                                            />
                                    <label for="home">Home</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <input type="checkbox"
                                            id="non_bl"
                                            name="non_bl"
                                            value="true"
                                            @if(isset($trivia->content_for->non_bl)) @if($trivia->content_for->non_bl) checked @endif @endif/>
                                    <label for="non_bl">Non Bl</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Label -->
                    <div class="col-6">
                        <div class="form-group">
                            <label for="pending_bottom_label_en" class="required">Pending Bottom Label EN:</label>
                            <input
                            required
                            maxlength="200"
                            data-validation-required-message="The field is required"
                            data-validation-maxlength-message = "Max Character: 200"
                            value="@if(isset($trivia)) {{$trivia->pending_bottom_label_en}} @elseif(old("pending_bottom_label_en")) {{ old("pending_bottom_label_en") }} @endif"
                            type="text"
                            name="pending_bottom_label_en"
                            class="form-control @error('pending_bottom_label_en') is-invalid @enderror"
                            id="pending_bottom_label_en"
                            placeholder="Enter Label Name..">
                            <small class="text-danger"> @error('pending_bottom_label_en') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                        {{-- <input type="hidden" name="id" value="1"> <!-- as this is single row, we pass ID statically to updateOrCreate --> --}}
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="pending_bottom_label_bn" class="required">Pending Bottom Label BN:</label>
                            <input
                                required
                                maxlength="200"
                                data-validation-required-message="The field is required"
                                data-validation-maxlength-message = "Max Character: 200"
                                id="pending_bottom_label_bn"
                                value="@if(isset($trivia)) {{$trivia->pending_bottom_label_bn}} @elseif(old("pending_bottom_label_bn")) {{ old("pending_bottom_label_bn") }} @endif"
                                type="text"
                                name="pending_bottom_label_bn"
                                class="form-control
                                @error('pending_bottom_label_bn') is-invalid @enderror"
                                placeholder="Enter Label Name..">
                            <small class="text-danger"> @error('pending_bottom_label_bn') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <!-- Completed Label -->
                    <div class="col-6">
                        <div class="form-group">
                            <label for="completed_bottom_label_en" class="required">Completed Bottom Label EN:</label>
                            <input
                            required
                            maxlength="200"
                            data-validation-required-message="The field is required"
                            data-validation-maxlength-message = "Max Character: 200"
                            id="completed_bottom_label_en"
                            value="@if(isset($trivia)) {{$trivia->completed_bottom_label_en}} @elseif(old("completed_bottom_label_en")) {{old("completed_bottom_label_en")}} @endif"
                            type="text"
                            name="completed_bottom_label_en"
                            class="form-control
                            @error('completed_bottom_label_en') is-invalid @enderror"
                            placeholder="Enter Label Name..">
                            <small class="text-danger"> @error('completed_bottom_label_en') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="col-6">
                    <div class="form-group">
                        <label for="completed_bottom_label_bn" class="required">Completed Bottom Label BN:</label>
                        <input
                            required
                            maxlength="200"
                            data-validation-required-message="The field is required"
                            data-validation-maxlength-message = "Max Character: 200"
                            id="completed_bottom_label_bn"
                            value="@if(isset($trivia)) {{$trivia->completed_bottom_label_bn}} @elseif(old("completed_bottom_label_bn")) {{old("completed_bottom_label_bn")}} @endif"
                            type="text"
                            name="completed_bottom_label_bn"
                            class="form-control
                            @error('completed_bottom_label_bn') is-invalid @enderror"
                            placeholder="Enter Label Name..">
                        <small class="text-danger"> @error('completed_bottom_label_bn') {{ $message }} @enderror </small>
                        <div class="help-block"></div>
                    </div>
                </div>

                    <!-- Success Left Button -->
                    <div class="col-4">
                        <div class="form-group">
                            <label for="success_left_btn_en" class="required">Success Left Button EN:</label>
                            <input required
                                   data-validation-required-message="The field is required"
                                   id="success_left_btn_en"
                                   value="@if(isset($trivia)) {{$trivia->success_left_btn_en}} @elseif(old("success_left_btn_en")) {{old("success_left_btn_en")}} @endif"
                                   type="text"
                                   name="success_left_btn_en"
                                   class="form-control
                                   @error('success_left_btn_en') is-invalid @enderror"
                                   placeholder="Enter Success Button Label..">
                            <small class="text-danger"> @error('success_left_btn_en') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                        <label for="success_left_btn_bn" class="required">Success Left Button BN:</label>
                        <input required
                               data-validation-required-message="The field is required"
                               id="success_left_btn_bn"
                               value="@if(isset($trivia)) {{$trivia->success_left_btn_bn}} @elseif(old("success_left_btn_bn")) {{old("success_left_btn_bn")}} @endif"
                               type="text"
                               name="success_left_btn_bn"
                               class="form-control
                               @error('success_left_btn_bn') is-invalid @enderror"
                               placeholder="Enter Success Button Label..">
                        <small class="text-danger"> @error('success_left_btn_bn') {{ $message }} @enderror </small>
                        <div class="help-block"></div>
                    </div>
                </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="success_left_btn_deeplink" class="required">Success Left Button Deeplink:</label>
                            <input required
                                   data-validation-required-message="The field is required"
                                   id="success_left_btn_deeplink"
                                   value="@if(isset($trivia)) {{$trivia->success_left_btn_deeplink}} @elseif(old("success_left_btn_deeplink")) {{old("success_left_btn_deeplink")}} @endif"
                                   type="text"
                                   name="success_left_btn_deeplink"
                                   class="form-control
                                   @error('success_left_btn_deeplink') is-invalid @enderror"
                                   placeholder="Enter Deeplink..">
                            <small class="text-danger"> @error('success_left_btn_deeplink') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <!-- Success Right Button -->
                    <div class="col-4">
                        <div class="form-group">
                            <label for="success_right_btn_en" class="required">Success Right Button EN:</label>
                            <input required
                                   data-validation-required-message="The field is required"
                                   id="success_right_btn_en"
                                   value="@if(isset($trivia)) {{$trivia->success_right_btn_en}} @elseif(old("success_right_btn_en")) {{old("success_right_btn_en")}} @endif"
                                   type="text"
                                   name="success_right_btn_en"
                                   class="form-control
                                   @error('success_right_btn_en') is-invalid @enderror"
                                   placeholder="Enter Success Button Label..">
                            <small class="text-danger"> @error('success_right_btn_en') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                        <label for="success_right_btn_bn" class="required">Success Right Button BN:</label>
                        <input required
                               data-validation-required-message="The field is required"
                               id="success_right_btn_bn"
                               value="@if(isset($trivia)) {{$trivia->success_right_btn_bn}} @elseif(old("success_right_btn_bn")) {{old("success_right_btn_bn")}} @endif"
                               type="text"
                               name="success_right_btn_bn"
                               class="form-control
                                   @error('success_right_btn_bn') is-invalid @enderror"
                               placeholder="Enter Success Button Label..">
                         <small class="text-danger"> @error('success_right_btn_bn') {{ $message }} @enderror</small>
                        <div class="help-block"></div>
                    </div>
                </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="success_right_btn_deeplink" class="required">Success Right Button Deeplink:</label>
                            <input required
                                   data-validation-required-message="The field is required"
                                   id="success_right_btn_deeplink"
                                   value="@if(isset($trivia)) {{$trivia->success_right_btn_deeplink}} @elseif(old("success_right_btn_deeplink")) {{old("success_right_btn_deeplink")}} @endif"
                                   type="text"
                                   name="success_right_btn_deeplink"
                                   class="form-control
                                   @error('success_right_btn_deeplink') is-invalid @enderror"
                                   placeholder="Enter Deeplink..">
                              <small class="text-danger"> @error('code') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <!-- Failed Left Button -->
                    <div class="col-4">
                        <div class="form-group">
                            <label for="failed_left_btn_en" class="required">Failed Left Button EN:</label>
                            <input required
                                   data-validation-required-message="The field is required"
                                   id="failed_left_btn_en"
                                   value="@if(isset($trivia)) {{$trivia->failed_left_btn_en}} @elseif(old("failed_left_btn_en")) {{old("failed_left_btn_en")}} @endif"
                                   type="text"
                                   name="failed_left_btn_en"
                                   class="form-control
                                   @error('failed_left_btn_en') is-invalid @enderror"
                                   placeholder="Enter Failed Button Label..">
                            <small class="text-danger"> @error('failed_left_btn_en') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                        <label for="failed_left_btn_bn" class="required">Failed Left Button BN:</label>
                        <input required
                               data-validation-required-message="The field is required"
                               id="failed_left_btn_bn"
                               value="@if(isset($trivia)) {{$trivia->failed_left_btn_bn}} @elseif(old("failed_left_btn_bn")) {{old("failed_left_btn_bn")}} @endif"
                               type="text"
                               name="failed_left_btn_bn"
                               class="form-control
                                   @error('failed_left_btn_bn') is-invalid @enderror"
                               placeholder="Enter Failed Button Label..">
                         <small class="text-danger"> @error('failed_left_btn_bn') {{ $message }} @enderror </small>
                        <div class="help-block"></div>
                    </div>
                </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="failed_left_btn_deeplink" class="required">Failed Left Button Deeplink:</label>
                            <input required
                                   data-validation-required-message="The field is required"
                                   id="failed_left_btn_deeplink"
                                   value="@if(isset($trivia)) {{$trivia->failed_left_btn_deeplink}} @elseif(old("failed_left_btn_deeplink")) {{old("failed_left_btn_deeplink")}} @endif"
                                   type="text"
                                   name="failed_left_btn_deeplink"
                                   class="form-control
                                   @error('failed_left_btn_deeplink') is-invalid @enderror"
                                   placeholder="Enter Deeplink..">
                            <small class="text-danger"> @error('failed_left_btn_deeplink') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <!-- Failed Right Button -->
                    <div class="col-4">
                        <div class="form-group">
                            <label for="failed_right_btn_en" class="required">Failed Right Button EN:</label>
                            <input required
                                   data-validation-required-message="The field is required"
                                   id="failed_right_btn_en"
                                   value="@if(isset($trivia)) {{$trivia->failed_right_btn_en}} @elseif(old("failed_right_btn_en")) {{old("failed_right_btn_en")}} @endif"
                                   type="text"
                                   name="failed_right_btn_en"
                                   class="form-control
                                   @error('failed_right_btn_en') is-invalid @enderror"
                                   placeholder="Enter Failed Button Label..">
                             <small class="text-danger"> @error('failed_right_btn_en') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                        <label for="failed_right_btn_bn" class="required">Failed Right Button BN:</label>
                        <input required
                               data-validation-required-message="The field is required"
                               id="failed_right_btn_bn"
                               value="@if(isset($trivia)) {{$trivia->failed_right_btn_bn}} @elseif(old("failed_right_btn_bn")) {{old("failed_right_btn_bn")}} @endif"
                               type="text"
                               name="failed_right_btn_bn"
                               class="form-control
                                   @error('failed_right_btn_bn') is-invalid @enderror"
                               placeholder="Enter Failed Button Label..">
                        <small class="text-danger"> @error('failed_right_btn_bn') {{ $message }} @enderror </small>
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="failed_right_btn_deeplink" class="required">Failed Right Button Deeplink:</label>
                        <input required
                               data-validation-required-message="The field is required"
                               id="failed_right_btn_deeplink"
                               value="@if(isset($trivia)) {{$trivia->failed_right_btn_deeplink}} @elseif(old("failed_right_btn_deeplink")) {{old("failed_right_btn_deeplink")}} @endif"
                               type="text"
                               name="failed_right_btn_deeplink"
                               class="form-control
                                   @error('failed_right_btn_deeplink') is-invalid @enderror"
                               placeholder="Enter Deeplink..">
                         <small class="text-danger"> @error('failed_right_btn_deeplink') {{ $message }} @enderror</small>
                        <div class="help-block"></div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="success_message_en" class="required">Success Message EN:</label>
                        <input required
                               data-validation-required-message="The field is required"
                               id="success_message_en"
                               value="@if(isset($trivia)){{$trivia->success_message_en}}@elseif(old("success_message_en")){{old("success_message_en")}}@endif"
                               type="text"
                               name="success_message_en"
                               class="form-control
                                   @error('success_message_en') is-invalid @enderror"
                               placeholder="write success message">
                        <small class="text-danger"> @error('success_message_en') {{ $message }} @enderror</small>
                        <div class="help-block"></div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="success_message_bn" class="required">Success Message BN:</label>
                        <input required
                               data-validation-required-message="The field is required"
                               id="success_message_bn"
                               value="@if(isset($trivia)){{$trivia->success_message_bn}}@elseif(old("success_message_bn")){{old("success_message_bn")}}@endif"
                               type="text"
                               name="success_message_bn"
                               class="form-control
                                   @error('success_message_bn') is-invalid @enderror"
                               placeholder="write success message">
                        <small class="text-danger"> @error('success_message_bn') {{ $message }} @enderror</small>
                        <div class="help-block"></div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="failed_message_en" class="required">Failed Message EN:</label>
                        <input required
                               data-validation-required-message="The field is required"
                               id="failed_message_en"
                               value="@if(isset($trivia)){{$trivia->failed_message_en}}@elseif(old("failed_message_en")){{old("failed_message_en")}}@endif"
                               type="text"
                               name="failed_message_en"
                               class="form-control
                                   @error('failed_message_en') is-invalid @enderror"
                               placeholder="write failed message">
                        <small class="text-danger"> @error('failed_message_en') {{ $message }} @enderror</small>
                        <div class="help-block"></div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="failed_message_bn" class="required">Failed Message BN:</label>
                        <input required
                               data-validation-required-message="The field is required"
                               id="failed_message_bn"
                               value="@if(isset($trivia)){{$trivia->failed_message_bn}}@elseif(old("failed_message_bn")){{old("failed_message_bn")}}@endif"
                               type="text"
                               name="failed_message_bn"
                               class="form-control
                                   @error('failed_message_bn') is-invalid @enderror"
                               placeholder="write failed message">
                        <small class="text-danger"> @error('failed_message_bn') {{ $message }} @enderror</small>
                        <div class="help-block"></div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="show_answer_btn_en" class="required">Show Answer Button EN:</label>
                        <input required
                               data-validation-required-message="The field is required"
                               id="show_answer_btn_en"
                               value="@if(isset($trivia)){{$trivia->show_answer_btn_en}}@elseif(old("show_answer_btn_en")){{old("show_answer_btn_en")}}@endif"
                               type="text"
                               name="show_answer_btn_en"
                               class="form-control
                                   @error('show_answer_btn_en') is-invalid @enderror"
                               placeholder="Enter Show Answer Button Label">
                        <small class="text-danger"> @error('show_answer_btn_en') {{ $message }} @enderror</small>
                        <div class="help-block"></div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="show_answer_btn_bn" class="required">Show Answer Button BN:</label>
                        <input required
                               data-validation-required-message="The field is required"
                               id="show_answer_btn_bn"
                               value="@if(isset($trivia)){{$trivia->show_answer_btn_bn}}@elseif(old("show_answer_btn_bn")){{old("show_answer_btn_bn")}}@endif"
                               type="text"
                               name="show_answer_btn_bn"
                               class="form-control
                                   @error('show_answer_btn_en') is-invalid @enderror"
                               placeholder="Enter Show Answer Button Label">
                        <small class="text-danger"> @error('show_answer_btn_bn') {{ $message }} @enderror</small>
                        <div class="help-block"></div>
                    </div>
                </div>

                    <!-- Banner -->
                    <div class="col-12">
                        @if(isset($trivia))
                            <img style="height:100px;width:200px;" id="imgDisplay" src="{{ asset($trivia->banner) }}"/>
                            @else
                            <img src="" style="height:100px;width:200px;display:none" id="imgDisplay"/>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="banner" id="bor" class="required">Banner :</label>
                            <div id="banner" class="input-group">
                                <div class="custom-file">
                                    <input
                                    accept="image/*"
                                    @if(!isset($trivia))
                                        required
                                        data-validation-required-message="Image is required"
                                    @endif
                                    accept="image/*"
                                    onchange="
                                    createImageBitmap(this.files[0]).then((bmp) => {
                                        if(Math.floor(bmp.width/bmp.height).toFixed(2) == Math.floor(16/9).toFixed(2)){
                                            document.getElementById('submitForm').disabled = false;
                                            document.getElementById('massage').innerHTML = '';
                                            this.style.border = 'none';
                                        }else{
                                            this.style.border = '1px solid red';
                                            document.getElementById('massage').innerHTML = '<b>image aspact ratio must 16:9(change the picture to enable button)</b>';
                                            document.getElementById('massage').classList.add('text-danger');
                                            document.getElementById('submitForm').disabled = true;
                                        }
                                    })"

                                    name="banner"
                                    type="file"
                                    id="image"
                                    class="custom-file-input @error('image_path') is-invalid @enderror">
                                    <label class="custom-file-label" for="imgInp">Upload Banner...</label>
                                </div>
                            </div>
                            <div class="help-block">
                                <small class="text-danger" id="msg"> @error('image_path') {{ $message }} @enderror </small>
                                <small class="text-info">image aspact ratio must be in 16:9</small>
                            </div>
                            <div id="massage"></div>
                        </div>

                    </div>

                    <div class="col-2 mb-2" >
                        <button type="submit" id="submitForm" style="width:100%" class="btn @if(isset($banner_info)) btn-success @else btn-info @endif ">
                            Save
                        </button>
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
