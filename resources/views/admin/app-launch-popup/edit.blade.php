@extends('layouts.admin')
@section('title', 'App Launch Popup')
@section('card_name', 'App Launch Popup | Edit')

@section('action')
    <a href="{{ route('app-launch.index') }}" class="btn btn-info btn-sm btn-glow px-2">
        Back to List
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('app-launch.update', $pop_up->id)}}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group @if($errors->has('title')) error @endif">
                                        <label for="title" class="required">Title</label>
                                        <input class="form-control"
                                               name="title"
                                               id="title"
                                               value="{{old('title')? old('title') : $pop_up->title}}"
                                               required>
                                        @if($errors->has('title'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type" class="required">Popup Type</label>
                                        <select id="type" name="type" class="form-control" required>
                                            <option value="image" @if($pop_up->type == 'image') selected @endif > Image
                                            </option>
                                            <option value="html" @if($pop_up->type == 'html') selected @endif > HTML
                                                Content
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    //dd($pop_up->start_date, $pop_up->end_date);
                                    $time_period = \App\Helpers\Helper::formateDaterangeData($pop_up->start_date, $pop_up->end_date);
                                @endphp
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_date" class="required">Time Period</label>
                                        <div class='input-group'>
                                            <input type='text'
                                                   class="form-control datetime"
                                                   name="display_period"
                                                   value="{{ $time_period }}"
                                                   id="display_period"/>
                                        </div>
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('display_period'))
                                        <div class="help-block">{{ $errors->first('display_period') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-8" id="content_div">
                                    <div class="form-group">
                                        @if($pop_up->type == 'image')
                                            <label class="required">Image</label>
                                            <input type="file"
                                                   name="content_data"
                                                   data-max-file-size="2M"
                                                   data-allowed-formats="portrait square"
                                                   data-allowed-file-extensions="jpeg png jpg"
                                                   data-default-file="{{ url('storage/' .$pop_up->content) }}"
                                                   class="dropify"/>
                                        @else
                                            <label for="html_content" class="required">Content</label>
                                            <textarea id="html_content" name="content_data" required>
                                                {{ $pop_up->content }}
                                            </textarea>
                                        @endif
                                    </div>
                                </div>
                                @if($errors->has('content_div'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('content_div') }}</small>
                                    </p>
                                @endif
                                <input type="hidden" name="id" value="{{$pop_up->id}}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block mt-2">
                                            <i class="ft-save"></i> Update
                                        </button>
                                    </div>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    {{--    <script src="{{ asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>--}}
    {{--    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
    <script>
        $(function () {
            var new_start_date;
            var date;
            // Date & Time
            date = new Date();
            date.setDate(date.getDate());

            new_start_date = new Date('{{$pop_up->start_date}}');

            $('.datetime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 1,
                minDate: (new_start_date < date) ? new_start_date : date,
                locale: {
                    format: 'YYYY/MM/DD h:mm A'
                }
            });

            function initiateDropify(selector) {
                $(selector).dropify({
                    messages: {
                        'default': 'Browse for an Image to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct Image file'
                    }
                });
            }

            function initiateSummernote(selector) {
                $(selector).summernote({
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['table', ['table']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['fullscreen']]
                    ],
                    height: 300
                });
            }

            function initiateImage() {
                let html = `<div class="form-group">
                                 <label class="required">Image</label>
                                 <input type="file"
                                               required
                                               name="content_data"
                                               data-max-file-size="2M"
                                               data-allowed-formats="portrait square"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               class="dropify"/>
                              </div>`;
                $("#content_div").html(html);
                initiateDropify('.dropify');
            }

            function initiateTextEditor() {
                let html = `<div class="form-group">
                                    <label for="html_content" class="required">Content</label>
                                    <textarea id="html_content" name="content_data" required></textarea>
                             </div>`;
                $("#content_div").html(html);

                initiateSummernote('#html_content');
            }

            initiateDropify('.dropify');
            initiateSummernote('#html_content');

            $('#type').on('change', function () {
                let action = $(this).val();
                if (action == 'image') {
                    initiateImage();
                } else {
                    initiateTextEditor();
                }
            });
        })
    </script>
@endpush







