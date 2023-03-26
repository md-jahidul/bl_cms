@extends('layouts.admin')
@section('title', 'Edit Service')
@section('card_name', 'Edit Service')
@section('breadcrumb')
    <li class="breadcrumb-item active">Edit Service</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('digital-service.update', $service->id) }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="header_title_en" class="required">Header Title English</label>
                                    <input class="form-control"
                                           name="header_title_en"
                                           id="header_title_en"
                                           placeholder="Enter Header Title EN"
                                           value="{{ $service->header_title_en  ?? ""}}"
                                           required>
                                    @if($errors->has('header_title_en'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('header_title_en') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="header_title_bn" class="required">Header Title Bangla</label>
                                    <input class="form-control"
                                           name="header_title_bn"
                                           id="header_title_bn"
                                           value="{{ $service->header_title_bn  ?? ""}}"
                                           placeholder="Enter Header Title BN"
                                           required>
                                    @if($errors->has('header_title_bn'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('header_title_bn') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="header_sub_title_en" >Header Sub Title EN:</label>
                                    <textarea
                                        class="form-control @error('header_sub_title_en') is-invalid @enderror" placeholder="Enter Header Sub Title....." id="header_sub_title_en"
                                        name="header_sub_title_en" rows="5">{{ $service->header_sub_title_en  ?? ""}}</textarea>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('header_sub_title_en') {{ $message }} @enderror </small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="header_sub_title_bn" >Header Sub Title BN:</label>
                                    <textarea
                                        class="form-control @error('header_sub_title_bn') is-invalid @enderror" placeholder="Enter Header Sub Title....." id="header_sub_title_bn"
                                        name="header_sub_title_bn" rows="5">{{ $service->header_sub_title_bn  ?? ""}}</textarea>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('header_sub_title_bn') {{ $message }} @enderror </small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="body_title_en" class="required">Body Title English</label>
                                    <input class="form-control"
                                           name="body_title_en"
                                           id="body_title_en"
                                           value="{{ $service->body_title_en  ?? ""}}"
                                           placeholder="Enter Body Title EN"
                                           required>
                                    @if($errors->has('body_title_en'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('body_title_en') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="body_title_bn" class="required">Body Title Bangla</label>
                                    <input class="form-control"
                                           name="body_title_bn"
                                           id="body_title_bn"
                                           value="{{ $service->body_title_bn  ?? ""}}"
                                           placeholder="Enter Body Title BN"
                                           required>
                                    @if($errors->has('body_title_bn'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('body_title_bn') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label for="body_sub_title_en" >Body Sub Title EN:</label>
                                    <textarea
                                        class="form-control @error('body_sub_title_en') is-invalid @enderror" placeholder="Enter Body Sub Title....." id="header_sub_title_en"
                                        name="body_sub_title_en" rows="5">{{ $service->body_sub_title_en  ?? ""}}</textarea>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('body_sub_title_en') {{ $message }} @enderror </small>
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label for="body_sub_title_bn" >Body Sub Title BN:</label>
                                    <textarea
                                        class="form-control @error('body_sub_title_bn') is-invalid @enderror" placeholder="Enter Body Sub Title....." id="header_sub_title_bn"
                                        name="body_sub_title_bn" rows="5">{{ $service->body_sub_title_bn  ?? ""}}</textarea>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('body_sub_title_bn') {{ $message }} @enderror </small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="button_title_en" class="required">Button Title English</label>
                                    <input class="form-control"
                                           name="button_title_en"
                                           id="button_title_bn"
                                           value="{{ $service->button_title_bn ?? "" }}"
                                           placeholder="Enter Button Title EN"
                                           required>
                                    @if($errors->has('button_title_en'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('button_title_en') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="button_title_bn" class="required">Button Title Bangla</label>
                                    <input class="form-control"
                                           name="button_title_bn"
                                           id="button_title_bn"
                                           value="{{ $service->button_title_bn ?? "" }}"
                                           placeholder="Enter Body Title BN"
                                           required>
                                    @if($errors->has('button_title_bn'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('button_title_bn') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-6" id="action_div">
                                    @php
                                        $actionList = Helper::navigationActionList();
                                    @endphp

                                    <div class="form-group">
                                        <label>Component For</label>
                                        <select name="component_for" class="browser-default custom-select"
                                                id="component_for" required>
                                            <option value="">Select Component</option>
                                            @foreach ($actionList as $key => $value)
                                                <option
                                                    @if(isset($service->component_for) &&$service->component_for == $key)
                                                        selected
                                                    @endif
                                                    value="{{ $key }}">
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eventInput3">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1"{{$service->status=='1' ? 'selected':''}} >Active</option>
                                            <option value="0"{{$service->status=='0' ? 'selected':''}}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="ft-save"></i> Update
                                </button>
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
    <link rel="stylesheet" href="{{ asset('app-assets/css/weekday-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('app-assets/js/recurring-schedule/recurring.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    {{--    <script src="{{ asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>--}}
    {{--    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
    <script>
    </script>
@endpush
