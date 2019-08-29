@extends('layouts.master-layout')


@section('main-content')

    <!-- general form elements -->
    <div class="col-md-6 offset-md-3 pt-4">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Slider Image</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('slider_image.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="q_name">Title</label>
                        <input type="text" name="title" class="form-control" id="q_name" placeholder="Enter question">
                    </div>
                    <div class="form-group">
                        <label>Slider</label>
                        <select class="form-control" name="slider_id">
                            <option>--Select Slider--</option>
                            @if(isset($sliders))
                                @foreach($sliders as $slider)
                                    <option value="{{ $slider->id }}">{{ $slider->title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea name="description" class="form-control" id="exampleInputPassword1" placeholder="Enter description"></textarea>
                    </div>

                    <div class="form-group mb-0">
                        <label for="exampleInputPassword1">Slider Image</label>
                    </div>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image_url" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleInputPassword1">Slider button label</label>
                        <input type="text" name="url_btn_label" class="form-control" id="exampleInputPassword1" placeholder="Enter button label">
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleInputPassword1">Alt Text</label>
                        <input type="text" name="alt_text" class="form-control" id="exampleInputPassword1" placeholder="Enter alt text">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Url</label>
                        <input type="text" name="url" class="form-control" id="exampleInputPassword1" placeholder="Enter url">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card -->
@stop






