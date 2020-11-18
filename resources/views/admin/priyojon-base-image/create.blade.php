@extends('layouts.admin')
@section('title', 'Priyojon Base Image upload')
@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form"
                          action="{{route('welcomeInfo.store')}}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-home"></i>Priyojon Base Image upload</h4>
                            <div class="row">
                                <div class="col-md-5 mb-1">
                                    <p class="text-left">Offer Id </p>
                                        <input type="text" class="form-control"  name="image"/>
                                </div>
                                <div class="col-md-7 mb-1">
                                    <p class="text-left">Remarks </p>
                                        <input type="text" class="form-control"  name="image"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <p class="text-left">Web image <br>
                                        <small class="warning text-muted"> * Image must be in ratio <code>
                                                8:3 </code></small>
                                    </p>
                                    @if ($welcomeInfo2)
                                        <input type="file"
                                               id="input-file-now-custom-1"
                                               class="dropify"
                                               name="image"
                                               data-default-file=""
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

                                <div class="col-md-4">
                                    <p class="text-left">Web image <br>
                                        <small class="warning text-muted"> * Image must be in ratio <code>
                                                8:3 </code></small>
                                    </p>
                                        <input type="file"
                                               id="input-file-now-custom-1"
                                               class="dropify"
                                               name="image"
                                               data-default-file=""
                                        />

                                </div>

                                <div class="col-md-3">
                                    <p class="text-left">Web image <br>
                                        <small class="warning text-muted"> * Image must be in ratio <code>
                                                8:3 </code></small>
                                    </p>
                                        <input type="file"
                                               id="input-file-now-custom-1"
                                               class="dropify"
                                               name="image"
                                               data-default-file=""
                                        />

                                </div>

                            </div>
                            <div class="row justify-content-lg-end mt-2">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-block btn-success px-2">
                                        <i class="la la-check-square-o"></i>Save
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

