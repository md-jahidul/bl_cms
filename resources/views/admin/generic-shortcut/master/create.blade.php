@extends('layouts.admin')
@section('title', 'Generic Shortcut')

@section('card_name', "Generic Shortcut")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Slider
    </li>
@endsection

@section('action')
    <a href="{{route('generic-shortcut-master.index') }}" class="btn btn-info btn-glow px-2">
       Go Back
    </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form novalidate class="form" id="slider-form"
                          action="@if (isset($shortcut)) {{route('generic-shortcut-master.update',$shortcut->id)}} @else {{route('generic-shortcut-master.store')}} @endif"
                          method="POST">
                        @csrf
                        @if (isset($shortcut)) @method('put') @else @method('post') @endif
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Shortcut Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_en" class="required">Title EN:</label>
                                        <input required
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Name is required"
                                            data-validation-regex-message="Name must start with alphabets"
                                            data-validation-maxlength-message="Name can not be more then 200 Characters"
                                            type="text"
                                            value="@if(isset($shortcut)){{$shortcut->title_en}}@else{{old('title_en')}}@endif"
                                            id="title_en"
                                            class="form-control @error('title_en') is-invalid @enderror" placeholder="Write a title" name="title_en">
                                        <div class="help-block"></div>
                                        @error('title_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @if(isset($shortcut))
                                    <input type="hidden" name="id" value="{{$shortcut->id}}">
                                @endif

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_bn" class="required">Title BN:</label>
                                        <input required
                                               data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                               data-validation-required-message="Name is required"
                                               data-validation-regex-message="Name must start with alphabets"
                                               data-validation-maxlength-message="Name can not be more then 200 Characters"
                                               type="text"
                                               value="@if(isset($shortcut)){{$shortcut->title_bn}}@else{{old('title_bn')}}@endif"
                                               id="title_bn"
                                               class="form-control @error('title') is-invalid @enderror"
                                               placeholder="Write a title" name="title_bn">
                                        <div class="help-block"></div>
                                        @error('title_bn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="status_input">Component For: </label>
                                    <div class="form-group {{ $errors->has('component_for') ? ' error' : '' }}">
                                        <input type="radio"  name="component_for" value="commerce" id="campaignStatusActive"
                                            {{ (isset($shortcut->component_for) && $shortcut->component_for == 'commerce') ? 'checked' : '' }}
                                            {{ isset($shortcut) ? 'disabled' : ''}}>
                                        <label for="campaignStatusActive" class="mr-3">Commerce</label>
                                        <input type="radio" name="component_for" value="content" id="campaignStatusActive"
                                            {{ (isset($shortcut->component_for) && $shortcut->component_for == 'content') ? 'checked' : '' }}
                                            {{ isset($shortcut) ? 'disabled' : ''}}>
                                        <label for="campaignStatusActive" class="mr-3">Content</label>
                                        <input type="radio" name="component_for" value="home" id="campaignStatusInactive"
                                            {{ (isset($shortcut->component_for) && $shortcut->component_for == 'home') ? 'checked' : '' }}
                                            {{ isset($shortcut) ? 'disabled' : '' }}>
                                        <label for="campaignStatusInactive" class="mr-3">Home</label>
                                        <input type="radio" name="component_for" value="non_bl" id="campaignStatusInactive"
                                            {{ (isset($shortcut->component_for) && $shortcut->component_for == 'non_bl') ? 'checked' : '' }}
                                            {{ isset($shortcut) ? 'disabled' : '' }}>
                                        <label for="campaignStatusInactive" class="mr-3">Non BL</label>
                                        @if ($errors->has('component_for'))
                                            <div class="help-block">  {{ $errors->first('component_for') }}</div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Position Field--}}
                                <slot class="position">
                                    @if(isset($shortcut->component_id) && $shortcut->component_id == 18)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="companyName" class="required">Position:</label>
                                                <input required type="number"
                                                       class="form-control" placeholder="Enter position" name="position"
                                                       value="{{ $shortcut->position }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label></label>
                                            <button type="button" class="btn btn-info mt-2" data-toggle="modal"
                                                    data-target="#default"><i class="la la-image"></i> Position Example Image</button>
                                        </div>
                                    @endif
                                </slot>
                                <input type="hidden" name="platform" value="App">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success round px-2">
                                <i class="la la-check-square-o"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>


    <div class="col-lg-4 col-md-6 col-sm-12">
    <div class="form-group">
        <!-- Modal -->
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <img src="{{ asset('component-images/mybl-app-dashboard.png') }}">
{{--                    <div class="modal-header">--}}
{{--                        <h4 class="modal-title" id="myModalLabel1">Basic Modal</h4>--}}
{{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection




@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        .error {
            color: red !important;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(function () {
            $("#slider-form").validate();

            $('.slider_type').change(function () {
                let sliderType = $(this).val();
                if (sliderType == 18){
                    let data = `<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="companyName" class="required">Position:</label>
                                        <input required type="number"
                                               class="form-control" placeholder="Enter position" name="position">
                                        <div class="help-block"></div>
                                    </div>
                                 </div>
                                <div class="col-md-6">
                                    <label></label>
                                    <button type="button" class="btn btn-info mt-2" data-toggle="modal"
                                            data-target="#default"><i class="la la-image"></i> Position Example Image</button>
                                </div>`
                    $('.position').append(data)
                }else {
                    $('.position').empty()
                }
            })

            $('.delete').click(function () {
                let id = $(this).attr('data-id');
                alert(id)

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
                            url: "{{ url('slider/destroy') }}/" + id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)

                                function redirect() {
                                    window.location.href = "{{ url('slider/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })

    </script>
@endpush
