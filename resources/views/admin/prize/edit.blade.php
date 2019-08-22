@extends('layouts.master-layout')

@section('main-content')
    
    <div class="container py-5">
    <div class="row">
    <div class="col-md-8 offset-2">


    <div class="card">
        <div class="card-header">
            Edit {{$prize->title}}
        </div>
        <div class="card-body">
            <form action="{{route('prize.update',$prize->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input value="{{$prize->title}}" type="text" id="title" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="campaign_id">Campaign</label>
                    <select id="campaign_id" name="campaign_id" class="form-control">
                        @foreach ($campaigns as $campaign)
                            <option @if($prize->campaign_id === $campaign->id) selected @endif value="{{$campaign->id}}">{{$campaign->title}}</option>
                        @endforeach
                    
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_id">Product</label>
                    <input value="{{$prize->product_id}}" type="text" id="product_id" name="product_id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="position">Position</label>
                    <input value="{{$prize->position}}" type="text" id="position" name="position" class="form-control">
                </div>
                <div class="form-group">
                    <label for="reword">Reword</label>
                    <input value="{{$prize->reword}}" type="text" id="reword" name="reword" class="form-control">
                </div>
                <div class="form-group">
                    <label for="validity">Validity</label>
                    <input value="{{$prize->validity}}" type="text" id="validity" name="validity" class="form-control">
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
