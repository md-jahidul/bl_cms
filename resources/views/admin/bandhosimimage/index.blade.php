@extends('layouts.admin')
@section('title', 'Bandho Sim Image')
@section('card_name', 'Bandho Sim Image')
@section('breadcrumb')
    <li class="breadcrumb-item active">Bandho Sim Image</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    @if(isset($image))
                <form novalidate action="{{ route('mybl.settings.bandho.sim.image.update',$image->id) }}" method="POST" enctype="multipart/form-data">
                @else
                    <form action="{{ route('mybl.settings.bandho.sim.image.store')}}" class="form" method="POST" id="sendNotificationForm" enctype="multipart/form-data">
                 @endif
                        @csrf

                        <div class="form-group">

                            <label for="message">Bandho Sim Image</label></br>
                            <input type="file" class="dropify" name="image" data-height="80"
                                   data-allowed-file-extensions="jpg png PNG jpeg JPG" required/>

                        </div>

                        <div class="col-md-12" >
                            <div class="form-group float-right" style="margin-top:15px;">
                                <button class="btn btn-success" style="width:100%;padding:7.5px 12px" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>


                    <div class="col-md-12">
                        @if(isset($image->image_url))
                        <img src="{{ asset($image->image_url) }}" alt="Slider Image"
                                         height="100" width="200"/>
@endif
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection


@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <style>

        .multiselect-container{
            width: 250px;
        }
        .multiselect-container > li > a > label {
            padding: 3px 5px 3px 10px;
        }
    </style>
@endpush


@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>


    <script>
        $(function () {
            $('#user-multiple-selected').multiselect({
                    includeSelectAllOption: true
                }
            );

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });


        });

    </script>
@endpush


