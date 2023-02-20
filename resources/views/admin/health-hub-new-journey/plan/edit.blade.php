@extends('layouts.admin')
@section('title', 'Edit Health Hub Plan')
@section('card_name', 'Edit Health Hub Plan')
@section('breadcrumb')
    <li class="breadcrumb-item active">Edit Health Hub Plan</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                        action="{{route('health-hub-feature-plan.update',$plan->id)}}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="title" class="required">Plan Title En</label>
                                        <input class="form-control"
                                               name="title_en"
                                               id="title_en"
                                               value = "{{ $plan->title_en }}"
                                               required>
                                        @if($errors->has('title_en'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title_en') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title_bn" class="required">Plan Title BN</label>
                                        <input class="form-control"
                                               name="title_bn"
                                               id="name_bn"
                                               value = "{{ $plan->title_bn }}"
                                               required>
                                        @if($errors->has('title_bn'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title_bn') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                <div class="col-md-6">
                                    <label for="slug" class="required">Slug</label>
                                    <input class="form-control"
                                           name="slug"
                                           id="slug"
                                           value = {{ $plan->slug }}
                                           required>
                                    @if($errors->has('slug'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('slug') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eventInput3">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1"{{$plan->status=='1' ? 'selected':''}} >Active</option>
                                            <option value="0"{{$plan->status=='0' ? 'selected':''}}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="content_div">
                                    <div class="form-group">
                                        <label class="required">Logo</label>
                                        <input type="file"
                                               name="logo"
                                                data-max-file-size="2M"
                                                data-default-file="{{ url('storage/' .$plan->logo) }}"
                                                data-allowed-file-extensions="jpeg png jpg"
                                               class="dropify"/>
                                    </div>
                                    @if($errors->has('content_div'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('content_div') }}</small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <h5 class="menu-title"><strong>Packages List For This Plan</strong></h5>
                            <hr>
                            <div class="card card-info mt-0" style="box-shadow: 0px 0px">
                                <div class="card-content">
                                    {{-- <div class="card-header">
                                    </div> --}}
                                    <div class="card-body card-dashboard">
                                        <table class="table table-striped table-bordered dataTable" id="Example1">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title English</th>
                                                <th>Plan</th>
                                                <th>Partner</th>
                                                <th>Status</th>
                                                 <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($plan->packages as $key => $package)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $package->title_en }}</td>
                                                    <td>{{ $package->plan->title_en }}</td>
                                                    <td>{{ $package->partner->name_en }}</td>
                                                    <td>{{ $package['status'] ? 'Active':'Inactive' }}</td>
                                                    <td>
                                                        <a href="{{ route('health-hub-feature-package.edit', $package->id) }}" role="button"
                                                            class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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

        $(function () {

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

            function initiatePurchaseImage() {
                let html = `<div class="form-group">
                                 <label class="required">Image</label>
                                 <input type="file"
                                               required
                                               name="content_data"
                                               data-allowed-formats="portrait square landscape"
                                               data-max-file-size="2M"
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

            product_html = ` <div class="form-group other-info-div">
                                        <label>Select a product</label>
                                        <select class="product-list form-control"  name="product_code" required></select>
                                        <div class="help-block"></div>
                                    </div>`;
            $('#Example1').DataTable({
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        })
    </script>
@endpush







