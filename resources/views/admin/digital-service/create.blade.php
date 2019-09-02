@extends('layouts.master-layout')

@section('main-content')


    <div class="col-md-6 offset-md-3 pt-3 py-4">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Digital Service</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
                <form action="{{route('digital_service.store')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="description">Example textarea</label>
                        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="google_play_logo">Google Play Logo</label>
                        <input type="file" id="google_play_logo" name="google_play_logo" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="google_play_link">Google Play Link</label>
                        <input type="text" id="google_play_link" name="google_play_link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="apple_store_logo">Apple Store Logo</label>
                        <input type="file" id="apple_store_logo" name="apple_store_logo" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="apple_store_link">Apple Store Link</label>
                        <input type="text" id="apple_store_link" name="apple_store_link" class="form-control">
                    </div>

                    {{-- <label for="">Active Status:</label>
                    <div class="row">

                        <div class="col-md-2">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_enable" id="active" value="1" checked>
                                <label class="form-check-label" for="active">
                                    Active
                                </label>
                            </div>

                        </div>
                        <div class="col-md-2">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_enable" id="deactive" value="0">
                                <label class="form-check-label" for="deactive">
                                    Deactive
                                </label>
                            </div>

                        </div> --}}
                    {{--</div>--}}

                    <button type="submit" class="btn btn-primary my-2">Submit</button>
                </form>
            </div>
        </div>
    </div>




@stop
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script>
        flatpickr("#start_date");
        flatpickr("#end_date");
        $(document).ready(function() {
            $('#campaign_id').select2();
        });
    </script>
@endpush
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    
@endpush
