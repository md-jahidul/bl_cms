@extends('layouts.admin')
@section('title', 'Store Sub Category')
@section('card_name', 'Store Sub Category')
@section('breadcrumb')

    @if(isset($storeSubCategory))
        <li class="breadcrumb-item active">Update Store Sub Category</li>
    @else
        <li class="breadcrumb-item active">Create Store Sub Category</li>
    @endif

@endsection

@section('action')
    <a href="{{route('subStore.index')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Store Sub Category List
    </a>
@endsection

@section('content')
    <div class="card mb-0 px-1" style="box-shadow:none;">
        <div class="card-content">
            <div class="card-body">
                <form class="form" method="POST" action="@if(isset($storeSubCategory)) {{route('subStore.update',$storeSubCategory->id)}}
                @else {{route('subStore.store')}} @endif" novalidate enctype="multipart/form-data">
                    @csrf
                    @if(isset($storeSubCategory))
                        @method('put')
                    @else
                        @method('post')
                    @endif
                    <div class="form-body">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id" class="required">
                                  Select  Category Name :
                                </label>
                                <div class="controls">
                                    <select name="category_id" id="category_id"  class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option @if(old("category_id")) {{ (old("category_id") == $category->id ? "selected":"") }}
                                                    @elseif(isset($storeSubCategory) && ($category->id == $storeSubCategory->category_id)) selected  @endif
                                                    value="{{$category->id}}" {{ (old("category_id") == $category->id ? "selected":"") }}>{{$category->name_en}}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('category_id') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name_en" class="required">Enter Sub Category Name (English):</label>
                                <input type="text"
                                       required
                                       value="@if(isset($storeSubCategory)) {{$storeSubCategory->name_en}} @elseif(old("name_en")) {{old("name_en")}} @endif"
                                       name="name_en" class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="Enter Store Sub Category..">
                                @if(isset($storeSubCategory))
                                    <input type="hidden" name="id" value="{{$storeSubCategory->id}}">
                                @endif
                                <small class="text-danger"> @error('name_en') {{ $message }} @enderror </small>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name_bn" class="required">Enter Sub Category Name (Bangla):</label>
                                <input type="text"
                                       required
                                       value="@if(isset($storeSubCategory)) {{$storeSubCategory->name_bn}} @elseif(old("name_bn")) {{old("name_bn")}} @endif"
                                       name="name_bn" class="form-control @error('name_bn') is-invalid @enderror" id="name_bn" placeholder="Enter Store Sub Category..">
                                @if(isset($storeSubCategory))
                                    <input type="hidden" name="id" value="{{$storeSubCategory->id}}">
                                @endif
                                <small class="text-danger"> @error('name_bn') {{ $message }} @enderror </small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Upload Icon :</label>
                                @if (isset($storeSubCategory))
                                    <input type="file"
                                           id="icon"
                                           class="dropify"
                                           name="icon"
                                           data-height="70"
                                           data-allowed-formats="square"
                                           data-allowed-file-extensions="png"
                                           data-default-file="{{ asset($storeSubCategory->icon) }}"
                                    />
                                @else
                                    <input type="file" required
                                           id="icon"
                                           name="icon"
                                           class="dropify"
                                           data-allowed-formats="square"
                                           data-allowed-file-extensions="png"
                                           data-height="70"/>
                                @endif
                                <div class="help-block">
                                    <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                    <small class="text-info"> Shortcut icon should be in 1:1 aspect ratio</small>
                                </div>
                                <small id="massage"></small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" id="submitForm" style="float: right" class="btn @if(isset($storeSubCategory)) btn-success @else btn-info @endif ">
                                @if(isset($storeSubCategory)) Update Store Sub Category @else Create Store Sub Category @endif
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('content_right_side_bar')
    <h1>
        List
    </h1>
@endsection


@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>

        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                "pageLength": 10,
                paging: true,
                searching: true,
                "bDestroy": true,
            });

            $('.dropify').dropify({
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
        });

    </script>
@endpush

