@extends('layouts.admin')
@section('title', 'Feed| Youtube')
@section('card_name', 'Feed Edit- Youtube')
@section('action')
    <a href="{{route('feed.index')}}" class="btn btn-info btn-glow px-2">
        Back to list
    </a>
@endsection

@section('content')
    <section class="row-separator-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form form-horizontal"
                              id="feed_form"
                              method="POST"
                              action="{{route('feed.update', $feed)}}"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{ method_field('PUT') }}
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="category">Category</label>
                                    <div class="col-md-9">
                                        <select class="form-control"
                                                name="category_id"
                                                id="category"
                                                required
                                        >
                                            <option value="">Select category</option>
                                            @foreach($category as $cat)
                                                <option @if($feed->category_id == $cat->id) selected
                                                        @endif value="{{$cat->id}}"> {{ $cat->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="title">Title</label>
                                    <div class="col-md-9">
                                        <input type="text"
                                               id="title"
                                               class="form-control"
                                               value="{{ $feed->title }}"
                                               required
                                               name="title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="description">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control"
                                                  rows="4"
                                                  name="description"
                                                  id="description"
                                        >{{ $feed->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="video_url">Video URL</label>
                                    <div class="col-md-9">
                                        <input class="form-control"
                                               type="text"
                                               id="video_url"
                                               name="video_url"
                                               required
                                               value="{{ $feed->video_url }}"
                                        >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="preview_image">Preview Image</label>
                                    <div class="col-md-9">
                                        <input type="file"
                                               class="dropify"
                                               name="preview_image"
                                               data-height="80"
                                               @if($feed->preview_image)
                                               data-default-file="{{ url('storage/' .$feed->preview_image) }}"
                                               @endif
                                               data-allowed-file-extensions='["jpg", "jpeg" , "png"]'/>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-start">
                                <div class="offset-md-2 col-md-2">
                                    <button type="submit" class="btn btn-primary btn-sm btn-block">
                                        <i class="la la-check"></i> Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>


    <script>
        function validateYouTubeUrl(video_url) {
            let regExp;
            let match;
            let url = video_url;
            if (url != undefined || url != '') {
                regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                match = url.match(regExp);
                if (match && match[2].length == 11) {
                    return true;
                }
                return false;
            }
        }

        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            $(document).on('submit', 'form#feed_form', function () {
                let video_url;
                video_url = $('#video_url').val();
                if (!validateYouTubeUrl(video_url)) {
                    swal.fire({
                        title: 'Enter valid youtube video url',
                        type: 'error',
                    });
                    return false;
                }
            });
        });
    </script>
@endpush

