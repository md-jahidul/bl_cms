@extends('layouts.admin')
@section('title', 'Feed| List')
@section('card_name', 'Feeds')
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
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Category</th>
                                <th>Source</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feeds as $key=>$feed)
                                <tr>
                                    <td> {{ ($feeds->currentpage()-1) * $feeds->perpage() + $key + 1 }}</td>
                                    <td>
                                        <div class="badge badge-glow badge-pill badge-border border-primary primary">
                                            <span>{{ $feed->category->title }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $feed->source }}</td>
                                    <td>{{ $feed->title }}</td>
                                    <td>
                                        <div class="badge badge-glow badge-pill badge-border border-info info">
                                            <span>{{ strtoupper($feed->status) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row ">
                                            <div class="col-md-3 col-sm-6">
                                                <a role="button" title="View" href="{{route('feed.show' , $feed->id)}}"
                                                   class="btn btn-sm btn-outline-info">
                                                    <i class="la la-eye"></i>
                                                </a>
                                            </div>
                                            @if(auth()->id() == $feed->created_by)
                                                <div class="col-md-3 col-sm-6">
                                                    <a role="button" title="Edit" href="#"
                                                       class=" btn btn-sm btn-outline-primary">
                                                        <i class="la la-pencil"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $feeds->links() }}
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

