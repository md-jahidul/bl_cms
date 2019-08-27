@extends('layouts.master-layout')

@section('main-content')
    
    <div class="container py-5">
    <div class="row">
    <div class="col-md-8 offset-2">


    <div class="card">
        <div class="card-header">
            Edit Campaign
        </div>
        <div class="card-body">
            <form action="{{route('campaign.update',$campaign->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input value="{{$campaign->title}}" type="text" id="title" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="quote">Quote</label>
                    <input value="{{$campaign->motivational_quote}}" type="text" id="quote" name="motivational_quote" class="form-control">
                </div>
                <div class="form-group">
                    <label for="start_date">Start date</label>
                    <input type="text" value="{{$campaign->start_date}}" id="start_date" name="start_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="end_date">End date</label>
                    <input type="text" value="{{$campaign->end_date}}" id="end_date" name="end_date" class="form-control">
                </div>

                 {{--<div class="form-group">--}}
                    {{--<label for="tag">Tag</label>--}}
                    {{--<select name="tags" class="form-control" id="tag">--}}
                        {{--@foreach ($tags as $tag)--}}
                            {{--<option value="{{$tag->id}}">{{$tag->title}}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                
                <label for="">Active Status:</label>
                <div class="row">

                    <div class="col-md-2">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_enable" id="active" value="1" 
                            @if ($campaign->is_enable == '1')
                                checked
                            @endif 
                            >
                            <label class="form-check-label" for="active">
                                Active
                            </label>
                        </div>

                    </div>
                    <div class="col-md-2">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_enable" id="deactive" value="0"
                            @if ($campaign->is_enable == '0')
                                checked
                            @endif 
                            >
                            <label class="form-check-label" for="deactive">
                                Inactive
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
        flatpickr("#start_date");
        flatpickr("#end_date");
        $(document).ready(function() {
            $('#tag').select2();
        });
    </script>
@endpush
@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
@endpush
