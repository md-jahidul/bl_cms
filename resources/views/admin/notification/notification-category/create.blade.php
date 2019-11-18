@extends('layouts.admin')
@section('title', 'Notification Category')
@section('card_name', 'Notification Category')
@section('breadcrumb')
    <li class="breadcrumb-item active">Notification Category List</li>
@endsection

@section('content')
    <div class="card mb-0 px-1" style="box-shadow:none;">
        <div class="card-content">
            <div class="card-body">
                <form class="form" method="POST" action="@if(isset($notificationCategory)) {{route('notificationCategory.update',$notificationCategory->id)}}
                @else {{route('notificationCategory.store')}} @endif" novalidate >
                    @csrf
                    @if(isset($notificationCategory))
                        @method('put')
                    @else
                        @method('post')
                    @endif
                    <div class="form-body">
                        <h4 class="form-section"><i class="la la-key"></i>
                            @if(isset($notificationCategory))
                                Edit "{{$notificationCategory->name}}" Category
                            @else
                                Create Notification Category
                            @endif
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="required">Category Name :</label>
                                <input type="text"
                                       required

                                       value="@if(isset($notificationCategory)) {{$notificationCategory->name}} @elseif(old("name")) {{old("name")}} @endif" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Notification Category..">
                                @if(isset($notificationCategory))
                                    <input type="hidden" name="id" value="{{$notificationCategory->id}}">
                                @endif
                                <small class="text-danger"> @error('name') {{ $message }} @enderror </small>

                            </div>

                            <div class="col-md-2">
                                <div class="form-group" style="margin-top:26px">
                                    <button class="btn btn-outline-success" style="width:100%;padding:7.5px 12px" type="submit">Submit</button>
                                </div>
                            </div>
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

@endpush
@push('page-js')


@endpush