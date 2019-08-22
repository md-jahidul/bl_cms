@extends('layouts.master-layout')

@section('main-content')
    
    <div class="container py-5">
    <div class="row">
    <div class="col-md-8 offset-2">


    <div class="card">
        <div class="card-header">
            Create Campaign
        </div>
        <div class="card-body">
            <form action="{{route('campaign.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="quote">Quote</label>
                    <input type="text" id="quote" name="quote" class="form-control">
                </div>
                <div class="form-group">
                    <label for="start">Start date</label>
                    <input type="date" id="start" name="start_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="end">End date</label>
                    <input type="date" id="end" name="end_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <select name="tags[]" class="form-control" id="tag">
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->title}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="">Active Status:</label>
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
                        
                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#start");
        flatpickr("#end");
        $(document).ready(function() {
            $('#tag').select2();
        });
    </script>
@endpush
@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
