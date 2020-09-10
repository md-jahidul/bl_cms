@extends('layouts.admin')
@section('title', 'Create Business Packages')
@section('card_name', 'Create Packages')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('lead-product-permission') }}"> User List</a></li>
    <li class="breadcrumb-item active"> Package Create</li>
@endsection
@section('action')
    <a href="{{ url('business-package') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <form method="POST" action="{{ route('permission.save')}}" class="form home_news_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                @foreach($categories as $category)
                                    <div class="form-group mb-3">
{{--                                        {{ dd($category) }}--}}
                                        <h4><strong class="text-primary">{{ $category['category']['title'] }}</strong></h4>
                                        <hr class="mt-0">
                                        <div class="row">
                                            @foreach($category['products'] as $product)
                                                <div class="col-md-3 col-xs-12">
                                                    <label class="text-bold-600 cursor-pointer">
                                                        <input type="checkbox" value="{{ $product->id }}" name="{{ $category['category']['slug'] }}[]">
                                                        {{$product->name}}
                                                    </label>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <div class="form-group text-right">
                                    <button class="btn btn-info news_submit" type="submit">Save</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">

@endpush
@push('page-js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

    <script>
        $(function () {

            //success and error msg
            <?php
            if (Session::has('sussess')) {
            ?>
            swal.fire({
                title: "{{ Session::get('sussess') }}",
                type: 'success',
                timer: 2000,
                showConfirmButton: false
            });
            <?php
            }
            if (Session::has('error')) {
            ?>

            swal.fire({
                title: "{{ Session::get('error') }}",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });

            <?php } ?>

            //show dropify for package photo
            $('.dropify_package').dropify({
                messages: {
                    'default': 'Browse for banner photo',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });


            //text editor for package details
            // $("textarea.package_details").summernote({
            //     toolbar: [
            //         ['style', ['bold', 'italic', 'underline', 'clear']],
            //         ['font', ['strikethrough', 'superscript', 'subscript']],
            //         ['fontsize', ['fontsize']],
            //         ['color', ['color']],
            //         // ['table', ['table']],
            //         ['para', ['ul', 'ol', 'paragraph']],
            //         ['view', ['codeview']]
            //     ],
            //     height: 200
            // });

        });


    </script>
@endpush




