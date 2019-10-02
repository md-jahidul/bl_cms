@extends('layouts.admin')
@section('title', 'Slider')
@section('card_name', $slider_information->title." Slider")
@section('breadcrumb')
    <li class="breadcrumb-item active">Edit Image Info</li>
@endsection
@section('action')
    <a href="{{route('myblsliderImage.index',$slider_information->id)}}" class="btn btn-info btn-glow px-2">
        Add Image
    </a>
    <a href="{{route('myblslider.index')}}" class="btn btn-primary btn-glow px-2">
        Slider list
    </a>
@endsection
@section('content')

    <section id="form-control-repeater">

    </section>

    @if($slider->sliderImages->count() == 0)
        <h1>
            No Image Added to "{{$slider_information->title}}" Slider
        </h1>
    @else
        <section id="collapsible">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-uppercase">
                        <small class="text-success"><b>Drag the list to change the sequence</b></small>
                    </h3>
                </div>
            </div>

            <div class="row">

                @foreach ($slider->sliderImages as $index=> $image)
                    <div class="col-lg-12 col-xl-12 col-md-12">
                        <div class="card collapse-icon accordion-icon-rotate mb-0 sortable"
                             style=" box-shadow: 0px 0px;">
                            <div data-position="{{$image->sequence}}" data-index="{{$image->id}}" class="list-item">
                                <div style="cursor:all-scroll" id="headingCollapse{{$image->id}}" class="card-header">
                                    <i class="icon-cursor-move icons"></i>
                                    <a data-toggle="collapse" href="#collapse11{{$image->id}}" aria-expanded="false"
                                       aria-controls="collapse11{{$image->id}}" class="card-title">
                                        <img style="height:50px;width:100px" class="" id="image_preview_{{$index}}"
                                             src="{{asset($image->image_url)}}"
                                             alt="" srcset=""><br>
                                    </a>
                                </div>
                                <div id="collapse11{{$image->id}}" role="tabpanel" aria-expanded="false"
                                     aria-labelledby="headingCollapse{{$image->id}}" class="collapse">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="d-flex flex-row-reverse">
                                                <div class="col-md-2">
                                                    <form action="{{route('myblsliderImage.destroy',$image->id)}}"
                                                          method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" style="width:100%"
                                                                class="btn btn-sm btn-icon btn-danger">Delete Image
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 mb-2 file-repeater">
                                                <form novalidate class="form row"
                                                      action="{{route('myblsliderImage.update',$image->id)}}"
                                                      enctype="multipart/form-data" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" hidden value="{{$slider_information->id}}"
                                                           name="slider_id">
                                                    <input type="hidden" hidden value="{{$image->id}}" name="id">
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
                                                            value="{{$image->title}}" required id="title"
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
                                                            value="{{$image->alt_text}}" id="alt_text" type="text"
                                                            class="form-control @error('alt_text') is-invalid @enderror"
                                                            placeholder="Alt text" name="alt_text">
                                                        <small
                                                            class="text-danger"> @error('alt_text') {{ $message }} @enderror </small>
                                                        <div class="help-block"></div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="is_active">Active Status:</label>
                                                            <select value="{{$image->is_active}}"
                                                                    class="form-control" id="is_active"
                                                                    name="is_active">
                                                                <option value="1"
                                                                        @if($image->is_active == "1") selected @endif>
                                                                    Active
                                                                </option>
                                                                <option value="0"
                                                                        @if($image->is_active == "0") selected @endif>
                                                                    De-Active
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mb-1">
                                                        <img style="height:100px;width:200px"
                                                             id="img_display_{{$index}}"
                                                             src="{{asset($image->image_url)}}" alt="" srcset="">
                                                    </div>
                                                    <div class="col-md-12">

                                                        <div class="form-group">
                                                            <label for="image">Upload Image :</label>
                                                            <div class="input-group" id="image_input_div_{{$index}}">
                                                                <div class="custom-file">
                                                                    <input accept="image/*"
                                                                           onchange="checkImageRatio(this,{{$index}})"
                                                                           id="image_{{$index}}" name="image_url"
                                                                           type="file"
                                                                           class="custom-file-input">
                                                                    <div class="help-block"></div>
                                                                    <label class="custom-file-label"
                                                                           for="image_url">Upload Image...</label>
                                                                </div>
                                                            </div>
                                                            <small class="text-info" id="ratio_info_{{$index}}">
                                                                Shortcut icon should be in
                                                                16:9 aspect ratio</small><br>
                                                            <small
                                                                class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                                            <small id="message_{{$index}}"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="submit" style="width:100%"
                                                                id="submitForm_{{$index}}"
                                                                class=" btn btn-success">Submit
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                @endforeach
            </div>
            </div>

            </div>

        </section>
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

        let checkImageRatio = function ($this, index) {
            createImageBitmap($this.files[0]).then((bmp) => {

                if (bmp.width / bmp.height == 16 / 9) {
                    document.getElementById('submitForm_' + index).disabled = false;
                    document.getElementById('message_' + index).innerHTML = '';
                    document.getElementById('image_input_div_' + index).style.border = 'none';

                    //change image preview
                    imageURL($this, 'img_display_' + index);

                } else {
                    document.getElementById('image_input_div_' + index).style.border = '1px solid red';
                    document.getElementById('message_' + index).innerHTML = '<b>image aspact ratio must 16:9(change the picture to enable button)</b>';
                    document.getElementById('ratio_info_' + index).innerHTML = '';
                    document.getElementById('message_' + index).classList.add('text-danger');
                    document.getElementById('submitForm_' + index).disabled = true;
                }
            })
        };

        $(document).ready(function () {
            $("#list").sortable({
                update: function (event, ui) {
                    $(this).children().each(function (index) {
                        if ($(this).attr('data-position') != (index + 1)) {
                            $(this).attr('data-position', index + 1).addClass('update');
                            console.log(index)
                        }
                    });
                    saveNewPosition();
                }
            });

            function saveNewPosition() {
                let position = [];
                $('.update').each(
                    function () {
                        position.push([$(this).attr('data-index'), $(this).attr('data-position')]);
                        //$this.removeClass('update');
                    })

                $.ajax({
                    url: "{{url('myblsliderImage/addImage/update-position')}}",
                    methoder: 'get',
                    dataType: 'text',
                    data: {
                        update: 1,
                        positions: position
                    },
                    success: function (data) {
                        console.log(data)
                    }
                })
            }
        });


    </script>
@endpush
