@extends('layouts.admin')
@section('title', 'Slider')
@section('card_name', 'Edit Image Info')

@section('action')
    <a href="{{route('myblslider.images.index',$imageInfo->slider_id)}}" class="btn btn-info btn-glow px-2">
       Back
    </a>
@endsection
@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form novalidate class="form row"
                              action="{{ route("myblslider.images.update",$imageInfo->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" hidden value="{{$imageInfo->id}}" name="id">
                            <div class="form-group col-md-12 mb-2">
                                <label for="title">Title: <small
                                        class="text-danger">*</small> </label>
                                <input
                                    required
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-required-message="Title is required"
                                    data-validation-regex-message="Title must start with alphabets"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('title')?old('title'):$imageInfo->title}}" required id="title"
                                    type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Title" name="title">
                                <small
                                    class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="alt_text">Alt Text: </label>
                                <input
                                    required
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-required-message="Alt Text is required"
                                    data-validation-regex-message="Alt Text must start with alphabets"
                                    data-validation-maxlength-message="Alt Text can not be more then 200 Characters"
                                    value="{{$imageInfo->alt_text}}" id="alt_text" type="text"
                                    class="form-control @error('alt_text') is-invalid @enderror"
                                    placeholder="Alt text" name="alt_text">
                                <small
                                    class="text-danger"> @error('alt_text') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="is_active">Active Status:</label>
                                    <select value="{{$imageInfo->is_active}}"
                                            class="form-control" id="is_active"
                                            name="is_active">
                                        <option value="1"
                                                @if($imageInfo->is_active == "1") selected @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if($imageInfo->is_active == "0") selected @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mb-1">
                                <img style="height:100px;width:200px"
                                     id="img_display"
                                     src="{{asset($imageInfo->image_url)}}" alt="" srcset="">
                            </div>
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="image">Upload Image :</label>
                                    <div class="input-group" id="image_input_div">
                                        <div class="custom-file">
                                            <input accept="image/*"
                                                   onchange="checkImageRatio(this)"
                                                   id="image" name="image_url"
                                                   type="file"
                                                   class="custom-file-input">
                                            <div class="help-block"></div>
                                            <label class="custom-file-label"
                                                   for="image_url">Upload Image...</label>
                                        </div>
                                    </div>
                                    <small class="text-info" id="ratio_info">
                                        Shortcut icon should be in
                                        16:9 aspect ratio</small><br>
                                    <small
                                        class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                    <small id="message"></small>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" style="width:100%"
                                        id="submitForm"
                                        class=" btn btn-success">Submit
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!$imageInfo)
        <h1>
            No Image Available with this ID
        </h1>
    @else


    @endif

@endsection




@push('style')

@endpush
@push('page-js')

    <script>

        let imageURL = function (input, id) {
            if (input.files && input.files[0]) {
                console.log(id);
                let reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById(id).src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        let checkImageRatio = function ($this) {
            createImageBitmap($this.files[0]).then((bmp) => {

                if (bmp.width / bmp.height == 16 / 9) {
                    document.getElementById('submitForm').disabled = false;
                    document.getElementById('message').innerHTML = '';
                    document.getElementById('image_input_div').style.border = 'none';

                    //change image preview
                    imageURL($this, 'img_display');

                } else {
                    document.getElementById('image_input_div').style.border = '1px solid red';
                    document.getElementById('message').innerHTML = '<b>image aspact ratio must 16:9(change the picture to enable button)</b>';
                    document.getElementById('ratio_info').innerHTML = '';
                    document.getElementById('message').classList.add('text-danger');
                    document.getElementById('submitForm').disabled = true;
                }
            })
        };
    </script>
@endpush
