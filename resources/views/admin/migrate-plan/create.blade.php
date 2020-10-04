@extends('layouts.admin')
@section('title', 'Migrate Plan')
@section('card_name', 'Migrate Plan')
@section('breadcrumb')
    <li class="breadcrumb-item active">Migrate Plan</li>
@endsection


@section('content')
    <div class="card mb-0 px-1" style="box-shadow:none;">
        <div class="card-content">
            <div class="card-body">
                <form novalidate class="form"
                      action="@if(isset($plan)) {{route('migrate-plan.update',$plan->id)}} @else {{route('migrate-plan.store')}} @endif"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($plan)) @method('put') @else @method('post') @endif


                    <div class="form-body">
                        <h4 class="form-section col-md-12">
                            @if(isset($plan))
                                Update Migrate Plan
                            @else
                                Create Migrate Plan
                            @endif
                        </h4>

                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="id" value="@if(isset($plan)){{$plan->id}} @elseif(old("id")) {{old("id")}} @endif">
                                <div class="form-group">
                                    <label for="title" class="required">Title:</label>
                                    <input name="title"
                                           required
                                           maxlength="100"
                                           data-validation-required-message="Title is required"
                                           data-validation-maxlength-message="Title can not be more then 100 Characters"

                                           style="height:100%" type="text" value="@if(isset($plan)){{$plan->title}} @elseif(old("title")) {{old("title")}} @endif"
                                           class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title..">
                                    <div class="help-block">
                                        {{--<small class="text-info"> Title can not be more then 100 Characters</small><br>--}}
                                    </div>
                                    <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                </div>
                            </div>


                            <div class="col-md-4">
                                @php
                                    $actionList = Helper::migratePlanList();
                                @endphp

                                <div class="form-group">
                                    <label class="required">Migration Plan Code</label>
                                    <select name="code" class="browser-default custom-select"
                                            id="code" required>
                                        <option value="">Select Code</option>
                                        @foreach ($actionList as $key => $value)
                                            <option
                                                @if(isset($plan->code) && $plan->code == $key)
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

                           {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type" class="required">Store Type:</label>
                                    <select required class="form-control" value="" name="type" id="type">

                                        <option value="">Select Type</option>
                                        <option @if(isset($plan)) @if($plan->type=="app") selected
                                                @endif @endif value="app">App
                                        </option>
                                        <option @if(isset($plan)) @if($plan->type=='promotional') selected
                                                @endif @endif value="promotional">Promotional
                                        </option>
                                        <option @if(isset($plan)) @if($plan->type=='subcategory') selected
                                                @endif @endif value="subcategory">SubCategory
                                        </option>

                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('type') {{ $message }} @enderror </small>
                                </div>
                            </div>--}}



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="is_active">Active Status:</label>
                                    <select value="" class="form-control" id="is_active" name="is_active">
                                        <option value="1"
                                                @if(isset($plan)) @if($plan->is_active == "1") selected @endif @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if(isset($plan)) @if($plan->is_active == "0") selected @endif @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Description:</label>
                                    <textarea
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter body description....." id="description" name="description" rows="3">
                                        @if(isset($plan)){{$plan->description}} @elseif(old("description")) {{old("description")}} @endif
                                    </textarea>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('description') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Upload Image :</label>
                                    @if (isset($plan))
                                        <input type="file"
                                               id="image_url"
                                               class="dropify_image"
                                               name="image_url"
                                               data-height="150"
                                               data-default-file="{{ asset($plan->image_url) }}"
                                        />
                                    @else
                                        <input type="file" required
                                               id="image_url"
                                               name="image_url"
                                               data-height="150"
                                               class="dropify_image"/>
                                    @endif
                                    <div class="help-block">
                                        <small class="text-danger"> @error('image_url'){{ $message }} @enderror </small>
                                    </div>
                                    <small id="massage"></small>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <button type="submit" style="float: right" class="btn btn-success round px-2">
                                    <i class="la la-check-square-o"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">

    <style>


    </style>

@endpush


@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
    <script>

        $(function () {
            $('.delete').click(function () {
                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('setting/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('setting/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })


        $(function () {
            $("textarea#description").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']]
                ],
                height:100
            })
        })


        $(document).ready(function() {
            $('.category_select').select2({
                placeholder: 'Select Category',
                width: '100%',
                border: '1px solid #e4e5e7',
            });
        });

        $('.category_select').on("select2:select", function (e) {
            var data = e.params.data.text;
            if(data=='all'){
                $(".category_select > option").prop("selected","selected");
                $(".category_select").trigger("change");
            }
        });


        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
            });

            $('.dropify_icon').dropify({
                messages: {
                    'default': 'Browse for an Icon to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Icon file'
                },
                error: {
                    'imageFormat': 'The image ratio must be 1:1.'
                }
            });

            $('.dropify_image').dropify({
                messages: {
                    'default': 'Browse for an Image to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image file'
                },
                error: {
                    'imageFormat': 'The image must be valid format'
                }
            });
        });

    </script>
@endpush
