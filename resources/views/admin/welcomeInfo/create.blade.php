@extends('layouts.admin')
@section('title', 'Welcome Information')
@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form"
                          action="@if(isset($welcomeInfo)) {{route('welcomeInfo.update',$welcomeInfo->id)}} @else {{route('welcomeInfo.store')}} @endif"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-home"></i>Welcome Message</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="message_en" class="required">Welcome Message (English):</label>
                                        <textarea
                                            required
                                            name="message_en"
                                            class="form-control"
                                            id="message_en"
                                            placeholder="Max 150 Characters"
                                            rows="3">@if(isset($welcomeInfo)){{$welcomeInfo->message_en}}@else{{old('message_en')}}@endif</textarea>
                                        @if($errors->has('message_en'))
                                            <p class="text-left">
                                                <small
                                                    class="danger text-muted">{{ $errors->first('message_en') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="message_bn" class="required">Welcome Message (Bangla) :</label>
                                        <textarea
                                            required
                                            name="message_bn"
                                            class="form-control"
                                            placeholder="Max 150 Characters"
                                            id="message_bn"
                                            rows="3">@if(isset($welcomeInfo)){{$welcomeInfo->message_bn}}@else{{old('message_bn')}}@endif</textarea>
                                        @if($errors->has('message_bn'))
                                            <p class="text-left">
                                                <small
                                                    class="danger text-muted">{{ $errors->first('message_bn') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="login_button_title" class="required">Login Button Title :</label>
                                        <input required
                                               name="login_button_title"
                                               placeholder="Max. 20 Character"
                                               class="form-control"
                                               id="login_button_title"
                                               value="@if(isset($welcomeInfo)){{$welcomeInfo->login_button_title}} @else{{old('login_button_title')}}@endif"
                                               max="30">
                                        @if($errors->has('login_button_title'))
                                            <p class="text-left">
                                                <small
                                                    class="danger text-muted">{{ $errors->first('login_button_title') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-left">
                                        <small class="warning text-muted"> * Image must be in ratio <code>
                                                8:3 </code></small>
                                    </p>
                                    @if ($welcomeInfo)
                                        <input type="file"
                                               id="input-file-now-custom-1"
                                               class="dropify"
                                               name="image"
                                               data-default-file="{{ url('storage/' .$welcomeInfo->image) }}"
                                        />
                                    @else
                                        <input type="file" id="input-file-now" name="image" class="dropify" required/>
                                    @endif
                                    @if($errors->has('image'))
                                        <p class="text-left">
                                            <small
                                                class="danger text-muted">{{ $errors->first('image') }}</small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-lg-end mt-2">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-block btn-success px-2">
                                        <i class="la la-check-square-o"></i> @if ($welcomeInfo) Update @else Save @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </section>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        // Translated
        $('.dropify').dropify({
            messages: {
                'default': 'Browse for an Image to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct Image file'
            }
        });
    </script>
@endpush

