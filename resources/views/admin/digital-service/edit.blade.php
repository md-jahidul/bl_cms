@extends('layouts.master-layout')

@section('main-content')
    
    <div class="container py-5">
    <div class="row">
    <div class="col-md-8 offset-2">

    <div class="card">
        <div class="card-header">
            Edit {{$service->title}}
        </div>

        <div class="card-body">
            <form action="{{route('digital_service.update',$service->id)}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input value="{{$service->title}}" type="text" id="title" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="image">Image</label><br>
                    <img height="50" width="100" src="{{asset($service->image)}}" alt="" srcset="">
                    <input type="file" id="image" name="image" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="description">Example textarea</label>
                    <textarea name="description" class="form-control" id="description" rows="3">{{$service->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input value="{{$service->price}}" type="number" id="price" name="price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="google_play_logo">Google Play Logo</label><br>
                    <img height="50" width="100" src="{{asset($service->google_play_logo)}}" alt="" srcset="">
                    <input type="file" id="google_play_logo" name="google_play_logo" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="google_play_link">Google Play Link</label>
                    <input value="{{$service->google_play_link}}" type="text" id="google_play_link" name="google_play_link" class="form-control">
                </div>
                <div class="form-group">
                    <label for="apple_store_logo">Apple Store Logo</label><br>
                    <img height="50" width="100" src="{{asset($service->apple_store_logo)}}" alt="" srcset="">
                    <input type="file" id="apple_store_logo" name="apple_store_logo" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="apple_store_link">Apple Store Link</label>
                    <input value="{{$service->apple_store_link}}" type="text" id="apple_store_link" name="apple_store_link" class="form-control">
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
                </div>

                <button type="submit" class="btn btn-primary my-2">Submit</button>
            </form>
        </div>
    </div>


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
