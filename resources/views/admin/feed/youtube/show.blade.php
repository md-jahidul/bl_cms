@extends('layouts.admin')
@section('title', 'Feed| Details')
{{--@section('action')
    <a href="" class="btn btn-info btn-glow px-2">
        Add Category
    </a>
@endsection--}}

@section('content')
    <section class="row-separator-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="media-list media-bordered">
                            <div class="media">
                                <span class="media-left">
                                        <iframe src="{{ \App\Helpers\Helper::getYoutubeEmbedUrl($feed->video_url) }}"
                                                width="560" height="315" frameborder="0" allowfullscreen></iframe>
                                </span>

                                <div class="media-body">
                                    <h3 class="media-heading info">
                                        {{ $feed->title }}
                                    </h3>
                                    <p class="mb-lg-5">
                                        {{ $feed->description }}
                                    </p>

                                    @if($feed->status == \App\Enums\FeedStatus::PENDING && $feed->created_by == auth()->id())
                                        <div class="form-group pull-right">
                                            <!-- Outline buttons -->
                                            <a type="button" href="{{ route('feed.edit', $feed) }}" class="btn btn-outline-info btn-min-width mr-1 mb-1">EDIT</a>
                                            <a type="button" class="btn btn-outline-success btn-min-width mr-1 mb-1">APPROVED</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
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
        /*        function validateYouTubeUrl(video_url) {
                    let regExp;
                    let match;
                    let url = video_url;
                    if (url != undefined || url != '') {
                        regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*!/;
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
                });*/
    </script>
@endpush

